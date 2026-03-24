<?php

namespace App\Http\Controllers;


use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Requests\CourseRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Models\Discipline;
use App\Services\CourseService;
use App\Services\CourseCreateService;
use App\Services\CourseUpdateService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{


    public function __construct(
        protected CourseService $courseService,
        protected CourseCreateService $courseCreateService,
        protected CourseUpdateService $courseUpdateService,
    ){}

    public function index()
    {
        if (! Gate::allows('Ver e Listar Cursos')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $courses = Course::latest()->get();
            return view('admin.course.index', ['pageConfigs' => $pageConfigs], compact('courses', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Categorias Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        CourseRequest $request
    ){
        if (! Gate::allows('Editar Cursos')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

            $courseArrayData = $request->toArray();

            if(isset($request['image_certificate'])){

                $request->validate([
                    'image_certificate' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);

                $path = Storage::disk('courses')->put('certificates', $request->file( key:'image_certificate'));

                $courseArrayData = array_merge(
                    $request->toArray(),
                    [
                        'path'  => $path
                    ]
                );
            }

            $this->courseCreateService->create($courseArrayData);

            flash('Curso criado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            dd($throwable);
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($course_id)
    {
        if (! Gate::allows('Editar Cursos')) {
            return view('pages.not-authorized');
        }

        try{
            $course_selected = $this->courseService->show($course_id);
            $disciplines = Discipline::where('Course_id',$course_id)->latest()->get();
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            return view('admin.course.show', compact('course_selected', 'unit', 'copyright', 'disciplines'));
        } catch (\Exception $exception) {
            flash('Erro ao buscar a Curso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        CourseRequest $request, $course_id
    ){
        if (! Gate::allows('Editar Cursos')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

                if(isset($request['image_certificate'])){

                    $request->validate([
                        'image_certificate' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                    ]);

                    $path = Storage::disk('courses')->put('certificates', $request->file( key:'image_certificate'));

                    $courseArrayData = array_merge(
                        $request->toArray(),
                        [
                            'path'  => $path
                        ]
                    );
                    $this->courseUpdateService->update($courseArrayData, $course_id);
                }
                else{
                    $this->courseUpdateService->update($request->toArray(), $course_id);
                }


            flash('Curso editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            dd($throwable);
            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($course)
    {
        if (! Gate::allows('Deletar Cursos')) {
            return view('pages.not-authorized');
        }

        try{
            $for_delete = Course::find($course);
            $for_delete->delete();
            flash('Curso deletado com sucesso!')->success();
            return redirect('/Cursos');
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao deletar a Categoria!')->error();
            return redirect()->back()->withInput();
        }
    }
}
