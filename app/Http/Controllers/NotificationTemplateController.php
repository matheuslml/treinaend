<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\NotificationTemplateRequest;
use App\Models\Banner;
use App\Models\BlankPage;
use App\Models\NotificationTemplate;
use App\Models\Gallery;
use App\Models\Leadership;
use App\Models\News;
use App\Models\Project;
use App\Models\Unit;
use App\Models\Course;
use App\Models\Copyright;
use App\Models\ProjectCategory;
use App\Services\NotificationTemplateService;
use App\Services\NotificationTemplateCreateService;
use App\Services\NotificationTemplateUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class NotificationTemplateController extends Controller
{
    public function __construct(
        protected NotificationTemplateService $notificationTemplateService,
        protected NotificationTemplateCreateService $notificationTemplateCreateService,
        protected NotificationTemplateUpdateService $notificationTemplateUpdateService,
    ){}

    public function index()
    {
        /*if (! Gate::allows('Ver e Listar NotificationTemplates')) {
            return view('pages.not-authorized');
        }*/

        try{
            $pageConfigs = ['pageHeader' => false];
            $courses_nav = Course::where('status', 'PUBLISHED')->get();

            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $notificationTemplates = NotificationTemplate::all();
            return view('admin.notification.index', ['pageConfigs' => $pageConfigs], compact('notificationTemplates', 'unit', 'copyright', 'courses_nav'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as NotificationTemplates Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        NotificationTemplateRequest $request
    ){
        /*if (! Gate::allows('Criar NotificationTemplates')) {
            return view('pages.not-authorized');
        }*/
        try {
            DB::beginTransaction();
            $this->notificationTemplateCreateService->create($request->toArray());

            flash('notificationTemplate criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao adicionar nova NotificationTemplate!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($notificationTemplate_id)
    {
        /*if (! Gate::allows('Ver e Listar NotificationTemplates')) {
            return view('pages.not-authorized');
        }*/

        try{
            $notificationTemplate = NotificationTemplate::find($notificationTemplate_id);
            $notificationTemplates = NotificationTemplate::all();
            $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
            return view('admin.notification.show', compact('notificationTemplate', 'notificationTemplates', 'unit', 'copyright', 'courses_nav'));

        } catch (\Throwable $throwable) {
            flash('Erro ao buscar registro!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        NotificationTemplateRequest $request, $notificationTemplate_id
    ){
        /*if (! Gate::allows('Editar NotificationTemplates')) {
            return view('pages.not-authorized');
        }*/

        try {
            DB::beginTransaction();
            $this->notificationTemplateUpdateService->update($request->toArray(), $notificationTemplate_id);

            flash('notificationTemplate editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar o NotificationTemplate!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($notificationTemplate)
    {
        /*if (! Gate::allows('Deletar NotificationTemplates')) {
            return view('pages.not-authorized');
        }*/

        try{
            $notificationTemplate = NotificationTemplate::find($notificationTemplate);
            $notificationTemplate->delete();
            flash('notificationTemplate deletado com sucesso!')->success();
            return redirect('/NotificationTemplates');
        } catch (\Exception $exception) {
            flash('Erro ao deletar o NotificationTemplate!')->error();
            return redirect()->back()->withInput();
        }
    }
}
