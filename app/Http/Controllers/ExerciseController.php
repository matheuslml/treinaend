<?php

namespace App\Http\Controllers;


use App\Models\Exercise;
use Illuminate\Http\Request;
use App\Http\Requests\ExerciseRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Models\Discipline;
use App\Services\ExerciseService;
use App\Services\ExerciseCreateService;
use App\Services\ExerciseUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ExerciseController extends Controller
{


    public function __construct(
        protected ExerciseService $exerciseService,
        protected ExerciseCreateService $exerciseCreateService,
        protected ExerciseUpdateService $exerciseUpdateService,
    ){}

    public function index()
    {
        if (! Gate::allows('Ver e Listar Exercícios')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $disciplines = Discipline::orderBy('name', 'asc')->get();
            $exercises = Exercise::latest()->get();
            return view('admin.exercise.index', ['pageConfigs' => $pageConfigs], compact('exercises', 'unit', 'copyright', 'disciplines'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Categorias Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        ExerciseRequest $request
    ){
        if (! Gate::allows('Editar Exercícios')) {
            return view('pages.not-authorized');
        }
        if(!isset($request->file)){
            flash('Escolha uma Imagem para o Exercício!')->error();
            return redirect()->back()->withInput();
        }
        try {
            DB::beginTransaction();
            $this->exerciseCreateService->create($request->toArray());

            flash('Categoria criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
dd($throwable);
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($exercise_id)
    {
        if (! Gate::allows('Editar Exercícios')) {
            return view('pages.not-authorized');
        }

        try{
            $categories = Exercise::with('news')->latest()->get();
            $exercise_selected = $this->exerciseService->show($exercise_id);
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            return view('admin.news.Exercise_show', compact('Exercise_selected', 'categories', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        ExerciseRequest $request, $exercise_id
    ){
        if (! Gate::allows('Editar Exercícios')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->exerciseUpdateService->update($request->toArray(), $exercise_id);

            flash('Categoria editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($exercise)
    {
        if (! Gate::allows('Editar Exercícios')) {
            return view('pages.not-authorized');
        }

        try{
            $for_delete = Exercise::find($exercise);
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
