<?php

namespace App\Http\Controllers;


use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Requests\LessonRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Services\LessonService;
use App\Services\LessonCreateService;
use App\Services\LessonUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class LessonController extends Controller
{


    public function __construct(
        protected LessonService $lessonService,
        protected LessonCreateService $lessonCreateService,
        protected LessonUpdateService $lessonUpdateService,
    ){}

    public function index(): View
    {
        if (! Gate::allows('Ver e Listar Lições')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $categories = Lesson::with('news')->latest()->get();
            return view('admin.news.Lesson_index', ['pageConfigs' => $pageConfigs], compact('categories', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {

            flash('Erro ao procurar as Categorias Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        LessonRequest $request
    ){
        if (! Gate::allows('Editar Lições')) {
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
            $this->lessonCreateService->create($fileData);

            flash('Categoria criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($lesson_id)
    {
        if (! Gate::allows('Editar Lições')) {
            return view('pages.not-authorized');
        }

        try{
            $categories = Lesson::with('news')->latest()->get();
            $lesson_selected = $this->lessonService->show($lesson_id);
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            return view('admin.news.Lesson_show', compact('Lesson_selected', 'categories', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        LessonRequest $request, $lesson_id
    ){
        if (! Gate::allows('Editar Lições')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->lessonUpdateService->update($request->toArray(), $lesson_id);

            flash('Categoria editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($lesson)
    {
        if (! Gate::allows('Editar Lições')) {
            return view('pages.not-authorized');
        }

        try{
            $for_delete = Lesson::find($lesson);
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
