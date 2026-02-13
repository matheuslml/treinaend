<?php

namespace App\Http\Controllers;


use App\Models\SupportMaterial;
use Illuminate\Http\Request;
use App\Http\Requests\SupportMaterialRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Models\Discipline;
use App\Services\SupportMaterialService;
use App\Services\SupportMaterialCreateService;
use App\Services\SupportMaterialUpdateService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class SupportMaterialController extends Controller
{


    public function __construct(
        protected SupportMaterialService $supportMaterialService,
        protected SupportMaterialCreateService $supportMaterialCreateService,
        protected SupportMaterialUpdateService $supportMaterialUpdateService,
    ){}

    public function index()
    {
        if (! Gate::allows('Ver e Listar Materiais de Apoio')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $disciplines = Discipline::orderBy('name', 'asc')->get();
            $support_materials = SupportMaterial::latest()->get();
            return view('admin.support_material.index', ['pageConfigs' => $pageConfigs], compact('support_materials', 'unit', 'copyright', 'disciplines'));
        } catch (\Throwable $throwable) {
            dd($throwable);
            flash('Erro ao procurar as Material de Apoios Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        SupportMaterialRequest $request
    ){
        if (! Gate::allows('Editar Materiais de Apoio')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->supportMaterialCreateService->create($request->toArray());

            flash('Material de Suporte criado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro Cadastrar o Material de Suporte!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($support_material_id)
    {
        if (! Gate::allows('Editar Materiais de Apoio')) {
            return view('pages.not-authorized');
        }

        try{
            $disciplines = Discipline::orderBy('name', 'asc')->get();
            $support_material_selected = $this->supportMaterialService->show($support_material_id);
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            return view('admin.support_material.show', compact('support_material_selected', 'disciplines', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        SupportMaterialRequest $request, $supportMaterial_id
    ){
        if (! Gate::allows('Editar Materiais de Apoio')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->supportMaterialUpdateService->update($request->toArray(), $supportMaterial_id);

            flash('Material de Apoio editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($support_material_id)
    {
        if (! Gate::allows('Editar Materiais de Apoio')) {
            return view('pages.not-authorized');
        }

        try{
            DB::beginTransaction();

                $for_delete = SupportMaterial::find($support_material_id);
                $old_path = storage_path() . '/app/public/files/material_apoio/' . str_replace("material_apoio/", "", $for_delete->link);
                $for_delete->delete();
                unlink($old_path);

                flash('Material de Apoio deletado com sucesso!')->success();
            DB::commit();
            return redirect('/materiais_de_apoio');
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao deletar o Material de Apoio!')->error();
            return redirect()->back()->withInput();
        }
    }
}
