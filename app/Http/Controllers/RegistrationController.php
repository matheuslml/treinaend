<?php

namespace App\Http\Controllers;


use App\Models\Registration;
use Illuminate\Http\Request;
use App\Http\Requests\RegistrationRequest;
use App\Models\Unit;
use App\Models\Course;
use App\Models\Copyright;
use App\Models\Document;
use App\Models\Person;
use App\Models\User;
use App\Services\RegistrationService;
use App\Services\RegistrationCreateService;
use App\Services\RegistrationUpdateService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\Label\Font\OpenSans;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use App\Actions\Discipline\NewStudent;
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
$courses_nav = Course::where('status', 'PUBLISHED')->get();
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $registrations = Registration::latest()->get();
            $people = Person::latest()->get();
            return view('admin.registration.index', ['pageConfigs' => $pageConfigs], compact('registrations', 'unit', 'copyright', 'courses_nav', 'people'));
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
            $courses_nav = Course::where('status', 'PUBLISHED')->get();
            return view('admin.registration.show', compact('registration_selected', 'people', 'unit', 'copyright', 'courses_nav'));
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
            flash('Matrícula deletada com sucesso!')->success();
            return redirect('/matriculas');
        } catch (\Exception $exception) {
            flash('Erro ao deletar a Matrícula!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function certificate($registration_id)
    {
        try{
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $registration = Registration::where('id', $registration_id)->first();


            $builder = new Builder(
                writer: new PngWriter(),
                writerOptions: [],
                validateResult: false,
                data: 'http://localhost:8000/consulta',
                encoding: new Encoding('UTF-8'),
                errorCorrectionLevel: ErrorCorrectionLevel::High,
                size: 300,
                margin: 20,
                roundBlockSizeMode: RoundBlockSizeMode::Margin,
            );
            
            $result = $builder->build();

            // gera data URI pronto para usar em <img>
            $qrcode = $result->getDataUri();



            $pdf = FacadePdf::loadView('pages.cetificate', compact('copyright', 'unit', 'registration', 'qrcode'));
            
            $pdf->setPAper('a4', 'landscape');

            return $pdf->stream('certificate.pdf');

        } catch (\Throwable $throwable) {
            flash('Erro ao buscar registro!')->error();
            dd($throwable);
            return redirect()->back()->withInput();
        }
    }

    public function web_store(Request $request)
    {
        try {
            DB::beginTransaction();

            $cpf = preg_replace('/\D/', '', $request->cpf);
            $cpf = ltrim($cpf, '0');    

            $document = Document::whereRaw("
                            TRIM(LEADING '0' FROM REPLACE(REPLACE(REPLACE(document, '.', ''), '-', ''), ' ', '')) = ?
                            ", [$cpf])->first();    

            if ($document) {
                flash('Cadastro já Existente tente fazer Login ou alterar Senha!')->error();
            }else{
                $person = Person::create([
                    'full_name' => $request['name']
                ]);

                User::create([
                    'person_id' => $person->id,
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password'])
                ]);

                Document::create([
                    'person_id' => $person->id,
                    'document' => $cpf,
                    'document_type_id' => 1
                ]);

                $new_student = resolve(NewStudent::class);
                $new_student->handle($person->id, $request['course_id']);
                flash('Matrícula criada com sucesso!')->success();
            }

            DB::commit();
            return redirect('/login');
        } catch (\Throwable $throwable) {
            DB::rollBack();
            flash('Erro Criar a Matrícula, entre em contato!')->error();
            return redirect()->back()->withInput();
        }
    }


    public function get_registration(Request $request)
    {
        try {
            $registration = null;

            if ($request->filled('cpf')) {
                // Normaliza CPF (remove pontos e traços)
                $cpf = preg_replace('/\D/', '', $request->cpf);
                $cpf = ltrim($cpf, '0'); // remove zeros à esquerda

                $registration = Registration::with(['person.documents', 'course'])
                    ->whereHas('person.documents', function ($query) use ($cpf) {
                        $query->whereRaw("
                            TRIM(LEADING '0' FROM REPLACE(REPLACE(REPLACE(document, '.', ''), '-', ''), ' ', '')) = ?
                        ", [$cpf]);
                    })
                    ->when($request->filled('course_id'), function ($query) use ($request) {
                        $query->where('course_id', $request->course_id);
                    })
                    ->first();

            } else {
                $registration = Registration::with(['person.documents', 'course'])
                    ->where('code', $request->code)
                    ->first();
            }

            if (!$registration) {
                return response()->json([
                    'success' => false,
                    'message' => 'Nenhum registro encontrado.'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'code' => $registration->code,
                    'qualification' => $registration->qualification,
                    'person' => [
                        'full_name' => $registration->person->full_name ?? null,
                        'documents' => $registration->person->documents->map(function ($doc) {
                            return [
                                'number' => $doc->document ?? null,
                            ];
                        })
                    ],
                    'course' => [
                        'name' => $registration->course->name ?? null,
                    ]
                ]
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 500);
        }
    }

}
