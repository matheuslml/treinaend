<?php

namespace App\Http\Controllers;

use App\Actions\Discipline\NewStudent;
use App\Models\Copyright;
use App\Models\Discipline;
use App\Models\DisciplinePeople;
use App\Models\Exercise;
use App\Models\ExerciseUser;
use App\Models\Lesson;
use App\Models\Person;
use App\Models\SupportMaterial;
use App\Models\Unit;
use App\Models\Course;
use App\Models\DisciplinePeopleExercise;
use App\Models\Registration;
use App\Models\User;
use Carbon\Carbon;
use Detection\MobileDetect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentPainel extends Controller
{

    public function disciplines_student_index($course_id)
    {
        /*if (! Gate::allows('Ver Menu do Aluno')) {
            return view('pages.not-authorized');
        }*/

        try{

            $pageConfigs = ['pageHeader' => false];
            $courses_nav = Course::where('status', 'PUBLISHED')->get();
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $userId = Auth::id();
            $user = User::find($userId);
            $person_id = $user->person_id;

            //fazer a verificação se o curso está pago
            $course = Course::find($course_id);
            /*$new_student = resolve(NewStudent::class);
            $new_student->handle($person_id, $course_id, '');*/

            $disciplines = Discipline::where('course_id', $course_id)->orderBy('order', 'asc')
                ->with(['person' => function ($query) use ($person_id) {
                    $query->where('person_id', $person_id);
                }])
                ->get();

            $discipline_atual = Discipline::where('course_id', $course_id)->orderBy('order', 'desc')
                ->whereHas('person', function ($query) use ($person_id) {
                    $query->where('person_id', $person_id)
                        ->where(function ($q) {
                            $q->where('discipline_people.score', '<=', 7)
                                ->orWhereNull('discipline_people.finished_at');
                        });
                })
                ->with(['person' => function ($query) use ($person_id) {
                    $query->where('person_id', $person_id)
                        ->where(function ($q) {
                            $q->where('discipline_people.score', '<=', 7)
                                ->orWhereNull('discipline_people.finished_at');
                        });
                }])
                ->first();
                if($discipline_atual == null){
                    $discipline_atual = $disciplines->first();
                }


            $disciplines_person = Discipline::where('course_id', $course_id)
                ->orderBy('order', 'desc')
                ->whereHas('person', function ($query) use ($person_id) {
                    $query->where('person_id', $person_id)
                        ->where(function ($q) {
                            $q->where('discipline_people.score', '>=', 7)
                                ->orWhereNotNull('discipline_people.finished_at'); // agora só pega finished_at preenchido
                        });
                })
                ->with(['person' => function ($query) use ($person_id) {
                    $query->where('person_id', $person_id)
                        ->where(function ($q) {
                            $q->where('discipline_people.score', '>=', 7)
                                ->orWhereNotNull('discipline_people.finished_at'); // mesma lógica no eager loading
                        });
                }])
                ->get();

            return view('admin.student_painel.disciplines', ['pageConfigs' => $pageConfigs], compact('disciplines_person', 'course', 'disciplines', 'unit', 'copyright', 'courses_nav', 'discipline_atual'));
        } catch (\Throwable $throwable) {
            dd($throwable);
            flash('Erro ao procurar as Matrículas Cadastras!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function exercises_student_index($discipline_id)
    {
        /*if (! Gate::allows('Ver Menu do Aluno')) {
            return view('pages.not-authorized');
        }*/

        try{

            $userId = Auth::id();
            $user = User::find($userId);
            $pageConfigs = ['pageHeader' => false];
            $courses_nav = Course::where('status', 'PUBLISHED')->get();
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $discipline = Discipline::find($discipline_id);
            $discipline_person = DisciplinePeople::where('discipline_id', $discipline_id)->where('person_id', $user->person_id)->first();
            $examDate = Carbon::parse($discipline_person->exam_date);
            $examDateFormated = Carbon::parse($examDate)->format('d/m/Y');
            $today = Carbon::today();
            $exam_date = false;
            if ($examDate->lessThanOrEqualTo($today)) $exam_date = true;

            $lessons = Lesson::where('discipline_id', $discipline_id)
                                    ->orderBy('order', 'asc')
                                    ->get();

            $exercises = Exercise::where('discipline_id', $discipline_id)
                                    ->whereIn('type', ['E', 'A'])
                                    ->whereDoesntHave('users', function($q) use ($userId) {
                                        $q->where('user_id', $userId);
                                    })
                                    ->get();

            $exercises_dones = Exercise::where('discipline_id', $discipline_id)
                                    ->whereIn('type', ['E', 'A'])
                                    ->whereHas('users', function($q) use ($userId) { $q->where('user_id', $userId); })
                                    ->with(['users' => function($q) use ($userId) { $q->where('user_id', $userId); }])
                                    ->get();

            $support_materials = SupportMaterial::where('discipline_id', $discipline_id)
                                    ->orderBy('order', 'asc')
                                    ->get();

            $exam_questions = Exercise::where('discipline_id', $discipline_id)
                                    ->whereIn('type', ['P', 'A'])
                                    ->inRandomOrder()
                                    ->limit(10)
                                    ->get();

            return view('admin.student_painel.exercises', ['pageConfigs' => $pageConfigs], compact('discipline_person','exam_date', 'examDateFormated', 'discipline', 'unit', 'copyright', 'courses_nav', 'exercises', 'exercises_dones', 'support_materials', 'exam_questions', 'lessons'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Matrículas Cadastras!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function student_answer_exercise(Request $request)
    {
        /*if (! Gate::allows('Ver Menu do Aluno')) {
            return view('pages.not-authorized');
        }*/

        try{
            $userId = Auth::id();

            ExerciseUser::create([
                'user_id' => $userId,
                'exercise_id' => $request['exercise_id'],
                'answer' => $request['answer']
            ]);

            return redirect()->back()->with('success', 'Alterações salvas com sucesso!');

        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Matrículas Cadastras!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function download_support_material($support_material_id)
    {
        /*if (! Gate::allows('Ver Menu do Aluno')) {
            return view('pages.not-authorized');
        }*/

        try{
            $detect = new MobileDetect();
            $isMobile = $detect->isMobile();
            $support_material = SupportMaterial::find($support_material_id);
            if($isMobile){
                return response()->download('storage/files/material_apoio/' . $support_material->url, 'file.pdf');
            }else{
                $url_redirect = asset('storage/files/material_apoio/' . $support_material->url);
                return redirect()->to($url_redirect);
            }

        } catch (\Throwable $throwable) {
            flash('Erro ao fazer o Download!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function student_save_discipline(Request $request)
    {
        try{
            $processed = [];
            $answers = $request->input('answers');
            if (is_array($answers)) {
                foreach ($answers as $index => $answer) {
                    $processed[] = [ 'question' => $index + 1, 'answer' => $answer ];
                    //salvar aqui cada quest~]ao feita
                }

                    //salvar discipline user tbm
                return response()->json([ 'status' => 'ok', 'answers' => $processed ]);
            }else{
                return response()->json([ 'status' => 'not ok', 'answers' => "Nenhuma resposta recebida." ]);
            }
            echo $request;
        } catch (\Throwable $throwable) {
            echo "Erro: " . $throwable->getMessage();
        }
    }

    public function exam_start($discipline_id)
    {
        try{
            //fazer o exame verificar tempo, salvar cada questão feita

            $userId = Auth::id();
            $user = User::find($userId);
            $pageConfigs = ['pageHeader' => false];
            $courses_nav = Course::where('status', 'PUBLISHED')->get();
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $discipline = Discipline::find($discipline_id);
            $discipline_person = DisciplinePeople::where('discipline_id', $discipline_id)->where('person_id', $user->person_id)->first();

            $examDate = Carbon::parse($discipline_person->exam_date);
            $examDateFormated = Carbon::parse($examDate)->format('d/m/Y');

            $today = Carbon::today();
            $exam_date = false;

            if ($examDate->lessThanOrEqualTo($today)) $exam_date = true;

            $lessons = Lesson::where('discipline_id', $discipline_id)
                                    ->orderBy('order', 'asc')
                                    ->get();

            //primeira tentativa
            if(count($discipline_person->discipline_people_exercises) == 0 ){
                $exercises = Exercise::where('discipline_id', $discipline_id)
                                        ->whereIn('type', ['P', 'A'])
                                        ->inRandomOrder()
                                        ->limit(10)
                                        ->get();

                foreach($exercises as $exercise){
                    DisciplinePeopleExercise::updateOrCreate(
                        [
                            'discipline_people_id' => $discipline_person->id,
                            'exercise_id' => $exercise->id
                        ],
                        [
                            'answer' => 0
                        ]
                    );
                }
            }

            $exam_questions = DisciplinePeopleExercise::where('discipline_people_id', $discipline_person->id)->get();


            //dd($exam_questions->exercise);

            return view('admin.student_painel.exam', ['pageConfigs' => $pageConfigs], compact('discipline_person','exam_date', 'examDateFormated', 'discipline', 'unit', 'copyright', 'courses_nav', 'exam_questions', 'lessons'));
        } catch (\Throwable $throwable) {
            dd($throwable);
            flash('Erro ao procurar as Matrículas Cadastras!')->error();
            return redirect()->back()->withInput();
        }
    }


// Controller
    public function saveLesson(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|integer',
            'answer'   => 'required|string',
        ]);

        // Busca o exercício vinculado ao aluno
        $disciplinePeopleExercise = DisciplinePeopleExercise::findOrFail($validated['question']);

        // Calcula o próximo order
        $nextOrder = $disciplinePeopleExercise->order;
        if (empty($nextOrder)) {
            $maxOrder = DisciplinePeopleExercise::where('discipline_people_id', $disciplinePeopleExercise->discipline_people_id)
                ->max('order');
            $nextOrder = $maxOrder ? $maxOrder + 1 : 1;
        } else {
            $nextOrder = $nextOrder + 1;
        }

        // Atualiza a resposta do exercício
        $disciplinePeopleExercise->update([
            'answer'  => $validated['answer'],
            'correct' => $validated['answer'] == $disciplinePeopleExercise->exercise->correct_answer,
            'order'   => $nextOrder,
        ]);

        // Atualiza a questão atual do aluno
        $disciplinePeople = $disciplinePeopleExercise->discipline_person;
        if ($disciplinePeople) {
            $disciplinePeople->update([
                'current_question' => $nextOrder
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Resposta salva com sucesso!',
            'next_question' => $disciplinePeople->current_question ?? null
        ]);

    }



    public function getCurrentQuestion()
    {
        $userId = Auth::id();
        $personId = User::findOrFail($userId)->person->id;

        $disciplinePeople = DisciplinePeople::where('person_id', $personId)->first();

        return response()->json([
            'current_question' => $disciplinePeople->current_question ?? null
        ]);
    }



    public function saveExam(Request $request)
    {
        //aainda n terminei
        try{
            $validated = $request->validate([
                'last_question' => 'required|integer',
            ]);
            $score = 0;

            $disciplinePeopleExercise = DisciplinePeopleExercise::findOrFail($validated['last_question']);


            $today = Carbon::today();
            $days = $disciplinePeopleExercise->discipline_person->discipline->days ?? 0;

            $exercises = $disciplinePeopleExercise->discipline_person->discipline_people_exercises;

            foreach($exercises as $exercise){
                $score += $exercise->correct ? 1 : 0;
            }

            if($score >= $disciplinePeopleExercise->exercise->discipline->course->grade){
                DisciplinePeople::updateOrCreate(
                    [
                        'discipline_id' => $disciplinePeopleExercise->discipline_person->discipline->id,
                        'person_id' => $disciplinePeopleExercise->discipline_person->person->id
                    ],
                    [
                        'finished_at' => $today,
                        'score' => $score,
                        'exam_nr' => $disciplinePeopleExercise->discipline_person->exam_nr + 1
                    ]
                );
                DisciplinePeople::updateOrCreate(
                    [
                        'discipline_id' => $disciplinePeopleExercise->discipline_person->discipline->order + 1,
                        'person_id' => $disciplinePeopleExercise->discipline_person->person->id
                    ],
                    [
                        'exam_date' => $today->copy()->addDays($days),
                        'started_at' => $today,
                        'exam_nr' => 0
                    ]
                );
            }else{
                DisciplinePeople::updateOrCreate(
                    [
                        'discipline_id' => $disciplinePeopleExercise->discipline_person->discipline->id,
                        'person_id' => $disciplinePeopleExercise->discipline_person->person->id
                    ],
                    [
                        'current_question' => null,
                        'exam_date' => $today->copy()->addDays($days),
                        'exam_nr' => $disciplinePeopleExercise->discipline_person->exam_nr + 1
                    ]
                );
                foreach ($exercises as $exercise) {
                    // faz soft delete do exercício
                    $exercise->delete();
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Prova realizada com sucesso!'
            ]);
        } catch (\Throwable $throwable) {
            return response()->json([ 'status' => 'error', 'errors' => $throwable->getMessage() ]);
        }

    }

    public function oldsaveExam(Request $request)
    {
        try{
            //ok testar e ver se a interface está fechando e indo pra próxima
            $userId = Auth::id();
            $user = User::find($userId);
            $person = Person::find($user->person_id);
            $today = Carbon::today();
            $processed = [];
            $answers = $request->input('answers', []);
            $questions = $request->input('questions', []);
            $score = 0;
            $discipline_person_id = 0;
            $exam_nr = 0;
            $days = 0;
            if (is_array($answers) && is_array($questions)) {
                //Salvar exercícios feitos
                foreach ($answers as $index => $answer) {
                    $question_id = $questions[$index];
                    $exercise = Exercise::find($question_id);
                    if($discipline_person_id == 0){
                        $discipline_person = DisciplinePeople::where('discipline_id', $exercise->discipline_id)->where('person_id', $person->id)->first();
                        $discipline_person_id = $discipline_person->id ?? 0;
                        $exam_nr = $discipline_person->exam_nr ?? 0;
                        $days = $discipline_person->discipline->days ?? 0;
                    }
                    if ($exercise->correct_answer == $answer) $score++;

                    ExerciseUser::create([
                        'user_id' => $userId,
                        'exercise_id' => $question_id,
                        'answer' => $answer
                    ]);
                }
                if($score >= $exercise->discipline->course->grade){
                //Salvar dados da prova não está coreto
                    DisciplinePeople::updateOrCreate(
                        [
                            'discipline_id' => $exercise->discipline_id,
                            'person_id' => $person->id
                        ],
                        [
                            'finished_at' => $today,
                            'score' => $score,
                            'exam_nr' => $exam_nr+1
                        ]
                    );

                //criar proxima disciplina
                    $registration = Registration::where('person_id', $person->id)->where('course_id', $exercise->discipline->course->id)->first();
                    if(($exercise->discipline->order < count($exercise->discipline->course->disciplines)) && ($registration->qualification == "S")){
                        DisciplinePeople::updateOrCreate(
                            [
                                'discipline_id' => $exercise->discipline->order + 1,
                                'person_id' => $person->id
                            ],
                            [
                                'exam_date' => $today->copy()->addDays($days),
                                'started_at' => $today,
                                'exam_nr' => 0
                            ]
                        );
                    }
                }else{
                    DisciplinePeople::updateOrCreate(
                        [
                            'discipline_id' => $exercise->discipline_id,
                            'person_id' => $person->id
                        ],
                        [
                            'exam_date' => $today->copy()->addDays($days),
                            'exam_nr' => $exam_nr+1
                        ]
                    );
                }

                return response()->json([ 'status' => 'ok', 'answers' => $processed ]);
            }else{
                return response()->json([ 'status' => 'error', 'answers' => "Nenhuma resposta recebida." ]);
            }
        } catch (\Throwable $throwable) {
            return response()->json([ 'status' => 'error', 'errors' => $throwable->getMessage() ]);
        }
    }

}



