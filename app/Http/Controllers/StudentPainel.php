<?php

namespace App\Http\Controllers;

use App\Models\Copyright;
use App\Models\Discipline;
use App\Models\DisciplinePeople;
use App\Models\Exercise;
use App\Models\ExerciseUser;
use App\Models\Lesson;
use App\Models\Person;
use App\Models\SupportMaterial;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use Detection\MobileDetect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentPainel extends Controller
{

    public function disciplines_student_index()
    {
        /*if (! Gate::allows('Ver e Listar Matrículas')) {
            return view('pages.not-authorized');
        }*/

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $disciplines = Discipline::orderBy('order', 'asc')->get();
            return view('admin.student_painel.disciplines', ['pageConfigs' => $pageConfigs], compact('disciplines', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Matrículas Cadastras!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function exercises_student_index($discipline_id)
    {
        /*if (! Gate::allows('Ver e Listar Matrículas')) {
            return view('pages.not-authorized');
        }*/

        try{
            $userId = Auth::id();
            //$person = Person::find($userId);
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $discipline = Discipline::find($discipline_id);
            //mudar parar $userId depois dos testes
            $discipline_person = DisciplinePeople::where('discipline_id', $discipline_id)->where('person_id',2)->first();
            $examDate = Carbon::parse($discipline_person->exam_date);
            $today = Carbon::today();
            $exam_date = true;//mudar para false depois dos testes
            if ($examDate->greaterThanOrEqualTo($today)) $exam_date = true;

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

            return view('admin.student_painel.exercises', ['pageConfigs' => $pageConfigs], compact('discipline_person','exam_date','discipline', 'unit', 'copyright', 'exercises', 'exercises_dones', 'support_materials', 'exam_questions', 'lessons'));
        } catch (\Throwable $throwable) {
            dd($throwable);
            flash('Erro ao procurar as Matrículas Cadastras!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function student_answer_exercise(Request $request)
    {
        /*if (! Gate::allows('Ver e Listar Matrículas')) {
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
            dd($throwable);
            flash('Erro ao procurar as Matrículas Cadastras!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function download_support_material($support_material_id)
    {
        /*if (! Gate::allows('Ver e Listar Matrículas')) {
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

    public function student_save_lesson(Request $request)
    {
        try{
            //está salvando, mas não trava a disciplina depois de feita e tem que ir para um a página de conclusão da prova
            $userId = Auth::id();
            $person = Person::find($userId);
            $today = Carbon::today();
            $processed = [];
            $answers = $request->input('answers', []);
            $questions = $request->input('questions', []);
            $score = 0;
            $discipline_person_id = 0;
            $exam_nr = 0;
            $days = 0;
            if (is_array($answers) && is_array($questions)) {
                foreach ($answers as $index => $answer) {
                    $question_id = $questions[$index] ?? null;
                    $exercise = Exercise::find($question_id);
                    if($discipline_person_id == 0){
                        $discipline_person = DisciplinePeople::where('discipline_id', $exercise->discipline_id)->where('person_id', $person->id)->first();
                        $discipline_person_id = $discipline_person->id;
                        $exam_nr = $discipline_person->exam_nr;
                        $days = $discipline_person->discipline->days;
                    }
                    if ($exercise->correct_answer == $answer) $score++;

                    ExerciseUser::create([
                        'user_id' => $userId,
                        'exercise_id' => $question_id,
                        'answer' => $answer
                    ]);
                }
                if($score >=7){
                    DisciplinePeople::updateOrCreate(
                        [
                            'discipline_id' => $exercise->discipline_id,
                            'person_id' => $person->id
                        ],
                        [
                            'finished_at' => $today,
                            'score' => $score
                        ]
                    );
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



