<?php

namespace App\Http\Controllers;


use App\Models\Registration;
use Illuminate\Http\Request;
use App\Http\Requests\RegistrationRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Models\Person;
use App\Models\User;
use App\Services\RegistrationService;
use App\Services\RegistrationCreateService;
use App\Services\RegistrationUpdateService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class RegistrationController extends Controller
{


    public function __construct(
        protected RegistrationService $registrationService,
        protected RegistrationCreateService $registrationCreateService,
        protected RegistrationUpdateService $registrationUpdateService,
    ){}

    public function index()
    {
        if (! Gate::allows('Ver e Listar Matrículas')) {
            return view('pages.not-authorized');
        }

        try{
            $pageConfigs = ['pageHeader' => false];
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $registrations = Registration::latest()->get();
            $people = Person::latest()->get();
            return view('admin.registration.index', ['pageConfigs' => $pageConfigs], compact('registrations', 'unit', 'copyright', 'people'));
        } catch (\Throwable $throwable) {
            dd($throwable);
            flash('Erro ao procurar as Matrículas Cadastras!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        RegistrationRequest $request
    ){
        if (! Gate::allows('Editar Matrículas')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();

            $this->registrationCreateService->create($request->toArray());

            flash('Matrícula criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro Cadastrar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($registration_id)
    {
        if (! Gate::allows('Editar Matrículas')) {
            return view('pages.not-authorized');
        }

        try{
            $people = Person::latest()->get();
            $registration_selected = $this->registrationService->show($registration_id);
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            return view('admin.registration.show', compact('registration_selected', 'people', 'unit', 'copyright'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar o Tipo de Acesso!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        RegistrationRequest $request, $registration_id
    ){
        if (! Gate::allows('Editar Matrículas')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->registrationUpdateService->update($request->toArray(), $registration_id);

            flash('Categoria editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();

            flash('Erro ao editar!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($registration)
    {
        if (! Gate::allows('Editar Matrículas')) {
            return view('pages.not-authorized');
        }

        try{
            $for_delete = Registration::find($registration);
            $for_delete->delete();
            flash('Categoria deletada com sucesso!')->success();
            return redirect('/noticia_Matrículas');
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao deletar a Categoria!')->error();
            return redirect()->back()->withInput();
        }
    }
}
