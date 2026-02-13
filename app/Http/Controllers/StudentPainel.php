<?php

namespace App\Http\Controllers;

use App\Models\Copyright;
use App\Models\Discipline;
use App\Models\Exercise;
use App\Models\Unit;
use Illuminate\Http\Request;

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
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $discipline = Discipline::find($discipline_id);
            $exercises = Exercise::where('discipline_id', $discipline_id) ->whereIn('type', ['E', 'A']) ->get();
            return view('admin.student_painel.exercises', ['pageConfigs' => $pageConfigs], compact('discipline', 'unit', 'copyright', 'exercises'));
        } catch (\Throwable $throwable) {
            dd($throwable);
            flash('Erro ao procurar as Matrículas Cadastras!')->error();
            return redirect()->back()->withInput();
        }
    }
}
