<?php

namespace App\Http\Controllers;

use App\Models\Copyright;
use App\Models\Discipline;
use App\Models\Exercise;
use App\Models\ExerciseUser;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $disciplines = Discipline::orderBy('name', 'asc')->get();
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
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $discipline = Discipline::find($discipline_id);
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

            /*foreach ($exercises_dones as $done){
                $answer = $exercise->users->first()->pivot->answer ?? null;
                echo "Exercise {$exercise->id} - Answer: {$answer}";
            }*/
            return view('admin.student_painel.exercises', ['pageConfigs' => $pageConfigs], compact('discipline', 'unit', 'copyright', 'exercises', 'exercises_dones'));
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
}

