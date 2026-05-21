<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\CourseRequest;
use App\Models\Unit;
use App\Models\Course;
use App\Models\Copyright;
use App\Models\Discipline;
use App\Models\WebFooter;
use App\Services\CourseService;
use App\Services\CourseCreateService;
use App\Services\CourseUpdateService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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
            $courses_nav = Course::where('status', 'PUBLISHED')->get();
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $courses = Course::latest()->get();
            return view('admin.course.index', ['pageConfigs' => $pageConfigs], compact('courses', 'unit', 'copyright', 'courses_nav'));
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

            if(isset($request['image_card']) && isset($request['image_conclusion'])){

                $request->validate([
                    'image_card' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'image_conclusion' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'certificate_file' => 'required|mimes:pdf|max:2048'
                ]);

                $path = Storage::disk('courses')->put('cards', $request->file( key:'image_card'));
                $path_image_conclusion = Storage::disk('courses')->put('cards', $request->file( key:'image_conclusion'));
                $path_file = Storage::disk('courses_files')->put('certificates', $request->file( key:'certificate_file'));

                $courseArrayData = array_merge(
                    $request->toArray(),
                    [
                        'path'  => $path,
                        'path_image_conclusion' => $path_image_conclusion,
                        'path_file'  => $path_file
                    ]
                );
            }elseif(isset($request['image_card']) && !isset($request['image_conclusion'])){

                $request->validate([
                    'image_card' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'certificate_file' => 'required|mimes:pdf|max:2048'
                ]);

                $path = Storage::disk('courses')->put('cards', $request->file( key:'image_card'));
                $path_file = Storage::disk('courses_files')->put('certificates', $request->file( key:'certificate_file'));

                $courseArrayData = array_merge(
                    $request->toArray(),
                    [
                        'path'  => $path,
                        'path_file'  => $path_file
                    ]
                );

            }else{
                
                $request->validate([
                    'image_conclusion' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'certificate_file' => 'required|mimes:pdf|max:2048'
                ]);

                $path_image_conclusion = Storage::disk('courses')->put('cards', $request->file( key:'image_conclusion'));
                $path_file = Storage::disk('courses_files')->put('certificates', $request->file( key:'certificate_file'));

                $courseArrayData = array_merge(
                    $request->toArray(),
                    [
                        'path_image_conclusion' => $path_image_conclusion,
                        'path_file'  => $path_file
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
            $courses_nav = Course::where('status', 'PUBLISHED')->get();
            return view('admin.course.show', compact('course_selected', 'unit', 'copyright', 'courses_nav', 'disciplines'));
        } catch (\Exception $exception) {
            flash('Erro ao buscar a Curso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        Request $request, $course_id
    ){
        if (! Gate::allows('Editar Cursos')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
                if($request['type'] != null){
                    if(isset($request['image_card']) && isset($request['certificate_file'])){//pega os dois
                        $request->validate([
                            'image_card' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                            'certificate_file' => 'required|mimes:pdf|max:2048'
                        ]);

                        $path = Storage::disk('courses')->put('cards', $request->file( key:'image_card'));
                        $path_file = Storage::disk('courses_files')->put('certificates', $request->file( key:'certificate_file'));

                        $courseArrayData = array_merge(
                            $request->toArray(),
                            [
                                'path'  => $path,
                                'path_file'  => $path_file
                            ]
                        );
                        $this->courseUpdateService->update($courseArrayData, $course_id);
                    }elseif(isset($request['image_card']) && !isset($request['certificate_file'])){//pega image_card

                        $request->validate([
                            'image_card' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                        ]);

                        $path = Storage::disk('courses')->put('cards', $request->file( key:'image_card'));

                        $courseArrayData = array_merge(
                            $request->toArray(),
                            [
                                'path'  => $path
                            ]
                        );
                        $this->courseUpdateService->update($courseArrayData, $course_id);

                    }elseif(!isset($request['image_card']) && isset($request['certificate_file'])){//pega certificate_file

                        $request->validate([
                            'certificate_file' => 'required|mimes:pdf|max:2048'
                        ]);

                        $path_file = Storage::disk('courses_files')->put('certificates', $request->file( key:'certificate_file'));

                        $courseArrayData = array_merge(
                            $request->toArray(),
                            [
                                'path_file'  => $path_file
                            ]
                        );
                        $this->courseUpdateService->update($courseArrayData, $course_id);
                    }else{//não pega nenhum dos dois
                        $this->courseUpdateService->update($request->toArray(), $course_id);
                    }
                    flash('Curso editado com sucesso!')->success();
                }else{
                    $course = Course::find($course_id);
                    //for server and local unlink
                    //$old_path = array("https://arraial.rj.gov.br/storage/images/courses/");
                    $old_path = array("http://localhost:8000/storage/images/courses/");
                    $currentuuid = Auth::user()->id;

                    if(isset($request['image_banner'])){

                        $request->validate([
                            'image_banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                        ]);

                        $path = Storage::disk('courses')->put('banner', $request->file( key:'image_banner'));

                        $courseData = array_merge(
                            $request->toArray(),
                            [
                                'path'  => $path
                            ]
                        );
                    }
                    else{

                        $courseData = $request->toArray();

                    }

                    if($request['content'] != null){
                        //unlinking old images
                        $detail_old = $course->body == null ? 'a' : $course->body;
                        $dom_old = new \domdocument();
                        $searchPageOld = mb_convert_encoding($detail_old, 'HTML-ENTITIES', "UTF-8");
                        $dom_old->loadHtml($searchPageOld);
                        $images_old = $dom_old->getelementsbytagname('img');


                        //saving new images
                        $detail = $request->content;

                        $dom = new \domdocument();
                        $searchPage = mb_convert_encoding($detail, 'HTML-ENTITIES', "UTF-8");
                        $dom->loadHtml($searchPage);
                        $images = $dom->getelementsbytagname('img');

                        foreach($images_old as $k => $img_old){
                            $path_for_unlink = $img_old->getattribute('src');
                            $path_for_unlink = str_replace($old_path, "", $path_for_unlink);
                            $verification = true;
                            foreach($images as $k => $img){
                                $data = $img->getattribute('src');
                                $data = str_replace($old_path, "", $data);
                                if($path_for_unlink == $data){
                                    $verification = false;
                                    break;
                                }
                            }
                            if($verification){
                                Storage::disk('courses')->delete($path_for_unlink);
                            }
                        }

                        foreach($images as $k => $img){
                            $data = $img->getattribute('src');
                            $path_for_update = str_replace($old_path, "", $data);
                            if (!(Storage::disk('courses')->exists($path_for_update))) {
                                list($type, $data) = explode(';', $data);
                                list($type, $data)      = explode(',', $data);

                                $data = base64_decode($data);
                                $image_name= time().$k.'.png';
                                $path_img = 'content/'. $image_name;
                                Storage::disk('courses')->put('content/'. $image_name, $data);
                                //todo ----- arrumar os .env dos servidores
                                $img->removeattribute('src');
                                //production
                                //$src_path = env('APP_URL') . '/storage/images/courses/'. $path_img;
                                //local test
                                $src_path = env('APP_URL') . '/storage/images/courses/'. $path_img;
                                $img->setattribute('src', $src_path);
                            }
                            $img->setattribute('class', 'img-content');
                        }

                        $detail = $dom->savehtml();

                        $courseData['content'] = $detail;
                    }else{
                        $courseData['content'] = '';
                    }

                    $old_path = $course->image_banner;

                    $course->image_banner = isset($courseData['path']) ? $courseData['path']  : $old_path;
                    $course->excerpt = $courseData['content'];
                    $course->body = $courseData['content'];
                    $course->meta_description = $courseData['content'];
                    $course->meta_keywords = $courseData['meta_keywords'];
                    $course->save();

                    if(isset($request['image_banner']) && ($old_path != null)){
                        Storage::disk('courses')->delete($old_path);
                    }

                    flash('Página do Curso editada com sucesso!')->success();
                }



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
            return redirect('/cursos');
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao deletar a Categoria!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function pagina_web_course($course_slug)
    {
        $courses = Course::where('status', 'PUBLISHED')->orderBy('name', 'asc')->get();
        $course_selected = Course::where('slug', $course_slug)->first();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
        $header_title = $course_selected->name;

        return view('web.course.show', compact('course_selected', 'unit', 'copyright', 'web_footer', 'courses', 'header_title'));
    }
    
    public function getInfo($id)
    {
        $course = Course::findOrFail($id);

        return response()->json([
            'name' => $course->name,
            'payment_value' => $course->payment_value,
        ]);
    }
    public function viewCertificate($id)
    {
        $course = Course::findOrFail($id);

        $path = storage_path('app/public/files/courses/certificates/' . str_replace("certificates/", "", $course->certificate_file));

        if (!file_exists($path)) {
            abort(404, 'Arquivo não encontrado');
        }

        return response()->file($path); // abre o PDF direto no navegador
    }

}
