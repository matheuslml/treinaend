<?php

namespace App\Http\Controllers;


use App\Models\Discipline;
use Illuminate\Http\Request;
use App\Http\Requests\DisciplineRequest;
use App\Models\Unit;
use App\Models\Copyright;
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

    public function index(): View
    {
        if (! Gate::allows('Ver e Listar Disciplinas')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $categories = Discipline::with('news')->latest()->get();
            return view('admin.news.Discipline_index', ['pageConfigs' => $pageConfigs], compact('categories', 'unit', 'copyright'));
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
            $fileData = array_merge(
                $request->toArray(),
                [
                    'active'  => 1
                ]
            );
            $this->disciplineCreateService->create($fileData);

            flash('Categoria criada com sucesso!')->success();
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
            $categories = Discipline::with('news')->latest()->get();
            $discipline_selected = $this->disciplineService->show($discipline_id);
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            return view('admin.news.Discipline_show', compact('Discipline_selected', 'categories', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar o Tipo de Acesso!')->error();
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

            flash('Categoria editada com sucesso!')->success();
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
            flash('Categoria deletada com sucesso!')->success();
            return redirect('/noticia_categorias');
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao deletar a Categoria!')->error();
            return redirect()->back()->withInput();
        }
    }
}
