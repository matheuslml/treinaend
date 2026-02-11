<?php

namespace App\Http\Controllers;


use App\Models\SupportMaterial;
use Illuminate\Http\Request;
use App\Http\Requests\SupportMaterialRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Services\SupportMaterialService;
use App\Services\SupportMaterialCreateService;
use App\Services\SupportMaterialUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class SupportMaterialController extends Controller
{


    public function __construct(
        protected SupportMaterialService $supportMaterialService,
        protected SupportMaterialCreateService $supportMaterialCreateService,
        protected SupportMaterialUpdateService $supportMaterialUpdateService,
    ){}

    public function index(): View
    {
        if (! Gate::allows('Editar Certificado')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $categories = SupportMaterial::with('news')->latest()->get();
            return view('admin.news.SupportMaterial_index', ['pageConfigs' => $pageConfigs], compact('categories', 'unit', 'copyright'));
        } catch (\Throwable $throwable) {

            flash('Erro ao procurar as Categorias Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        SupportMaterialRequest $request
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
            $this->supportMaterialCreateService->create($fileData);

            flash('Categoria criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($supportMaterial_id)
    {
        if (! Gate::allows('Editar Certificado')) {
            return view('pages.not-authorized');
        }

        try{
            $categories = SupportMaterial::with('news')->latest()->get();
            $supportMaterial_selected = $this->supportMaterialService->show($supportMaterial_id);
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            return view('admin.news.SupportMaterial_show', compact('SupportMaterial_selected', 'categories', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        SupportMaterialRequest $request, $supportMaterial_id
    ){
        if (! Gate::allows('Editar Certificado')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->supportMaterialUpdateService->update($request->toArray(), $supportMaterial_id);

            flash('Categoria editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($supportMaterial)
    {
        if (! Gate::allows('Editar Certificado')) {
            return view('pages.not-authorized');
        }

        try{
            $for_delete = SupportMaterial::find($supportMaterial);
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
