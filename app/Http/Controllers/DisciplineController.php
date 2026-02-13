<?php

namespace App\Http\Controllers;


use App\Models\Discipline;
use Illuminate\Http\Request;
use App\Http\Requests\DisciplineRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Models\Exercise;
use App\Services\DisciplineService;
use App\Services\DisciplineCreateService;
use App\Services\DisciplineUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DisciplineController extends Controller
{


    public function __construct(
        protected DisciplineService $disciplineService,
        protected DisciplineCreateService $disciplineCreateService,
        protected DisciplineUpdateService $disciplineUpdateService,
    ){}

    public function index()
    {
        if (! Gate::allows('Ver e Listar Disciplinas')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $disciplines = Discipline::latest()->get();
            return view('admin.discipline.index', ['pageConfigs' => $pageConfigs], compact('disciplines', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Categorias Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        DisciplineRequest $request
    ){
        if (! Gate::allows('Editar Disciplinas')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

            $this->disciplineCreateService->create($request->toArray());

            flash('Disciplina criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($discipline_id)
    {
        if (! Gate::allows('Editar Disciplinas')) {
            return view('pages.not-authorized');
        }

        try{
            $discipline_selected = $this->disciplineService->show($discipline_id);
            $exercises = Exercise::where('discipline_id',$discipline_id)->latest()->get();
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            return view('admin.discipline.show', compact('discipline_selected', 'unit', 'copyright', 'exercises'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar a Disciplina!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        DisciplineRequest $request, $discipline_id
    ){
        if (! Gate::allows('Editar Disciplinas')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->disciplineUpdateService->update($request->toArray(), $discipline_id);

            flash('Disciplina editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($discipline)
    {
        if (! Gate::allows('Editar Disciplinas')) {
            return view('pages.not-authorized');
        }

        try{
            $for_delete = Discipline::find($discipline);
            $for_delete->delete();
            flash('Disciplina deletada com sucesso!')->success();
            return redirect('/disciplinas');
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao deletar a Categoria!')->error();
            return redirect()->back()->withInput();
        }
    }
}
