<?php

namespace App\Http\Controllers;


use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Requests\LessonRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Models\Discipline;
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

    public function index()
    {
        /*if (! Gate::allows('Ver e Listar Aulas')) {
            return view('pages.not-authorized');
        }*/

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $disciplines = Discipline::orderBy('name', 'asc')->get();
            $lessons = Lesson::latest()->get();
            return view('admin.lesson.index', ['pageConfigs' => $pageConfigs], compact('lessons', 'unit', 'copyright', 'disciplines'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Aulas Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        LessonRequest $request
    ){
        /*if (! Gate::allows('Editar Aulas')) {
            return view('pages.not-authorized');
        }*/
        try {
            DB::beginTransaction();
            $this->lessonCreateService->create($request->toArray());

            flash('Aula criada com sucesso!')->success();
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
        /*if (! Gate::allows('Editar Aulas')) {
            return view('pages.not-authorized');
        }*/

        try{
            $disciplines = Discipline::orderBy('name', 'asc')->get();
            $lesson_selected = $this->lessonService->show($lesson_id);
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            return view('admin.lesson.show', compact('lesson_selected', 'disciplines', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        LessonRequest $request, $lesson_id
    ){
        /*if (! Gate::allows('Editar Aulas')) {
            return view('pages.not-authorized');
        }*/
        try {
            DB::beginTransaction();
            $this->lessonUpdateService->update($request->toArray(), $lesson_id);

            flash('Aula editada com sucesso!')->success();
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
        /*if (! Gate::allows('Editar Aulas')) {
            return view('pages.not-authorized');
        }*/

        try{
            DB::beginTransaction();

                $for_delete = Lesson::find($lesson);
                $for_delete->delete();

                flash('Aula deletado com sucesso!')->success();
            DB::commit();
            return redirect('/aulas');
        } catch (\Exception $exception) {
            flash('Erro ao deletar o Aula!')->error();
            return redirect()->back()->withInput();
        }
    }
}
