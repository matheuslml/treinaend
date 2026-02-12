<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Http\Requests\CertificateRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Services\CertificateService;
use App\Services\CertificateCreateService;
use App\Services\CertificateUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CertificateController extends Controller
{


    public function __construct(
        protected CertificateService $certificateService,
        protected CertificateCreateService $certificateCreateService,
        protected CertificateUpdateService $certificateUpdateService,
    ){}

    public function index()
    {
        if (! Gate::allows('Ver e Listar Certificados')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $certificates = Certificate::with('news')->latest()->get();
            dd($certificates);
            return view('admin.certificate.index', ['pageConfigs' => $pageConfigs], compact('certificates', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {
            dd($throwable);
            flash('Erro ao procurar as Certificados Cadastrados!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        CertificateRequest $request
    ){
        if (! Gate::allows('Editar Certificado')) {
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
            $this->certificateCreateService->create($fileData);

            flash('Categoria criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($certificate_id)
    {
        if (! Gate::allows('Editar Certificado')) {
            return view('pages.not-authorized');
        }

        try{
            $categories = Certificate::with('news')->latest()->get();
            $certificate_selected = $this->certificateService->show($certificate_id);
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            return view('admin.news.Certificate_show', compact('Certificate_selected', 'categories', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        CertificateRequest $request, $certificate_id
    ){
        if (! Gate::allows('Editar Certificado')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->certificateUpdateService->update($request->toArray(), $certificate_id);

            flash('Categoria editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($certificate)
    {
        if (! Gate::allows('Editar Certificado')) {
            return view('pages.not-authorized');
        }

        try{
            $for_delete = Certificate::find($certificate);
            $for_delete->delete();
            flash('Categoria deletada com sucesso!')->success();
            return redirect('/noticia_Certificados');
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao deletar a Categoria!')->error();
            return redirect()->back()->withInput();
        }
    }
}
