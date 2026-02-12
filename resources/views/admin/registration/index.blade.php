@extends('admin/layouts/contentLayoutMaster')

@section('title', 'matriculas do Site')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
<!-- Advanced Search -->
<section id="advanced-search-datatable">
  <div class="row">
    <div class="col-md-4 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Cadastrar Nova Matrícula</h4>
        </div>
        <div class="card-body">
          @include('flash::message')
          @if ($errors->any())
            <div class="alert alert-danger pb-2" role="alert">
                <h4 class="alert-heading">Erros:</h4>
                <div class="alert-body">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
          @endif
          <form class="form form-horizontal" method="POST" action="{{ route('matriculas.store') }}" enctype="multipart/form-data">
            @csrf()
            <div class="row">
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="users">Alunos <tag data-bs-toggle="tooltip" title="Não obrigatório, não aparece se não colocar"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                      <select class="select2 form-select" id="users" name="users[]" multiple>
                        <optgroup label="Selecione">
                          @foreach($users as  $user)
                            <option value="{{ $user->id }}" >{{ $user->name }}</option>
                          @endforeach
                        </optgroup>
                      </select>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="payment_form">Forma de Pagamento<tag data-bs-toggle="tooltip" title="Forma de Pagamento"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                    <select class="form-select" id="payment_form" name="payment_form" required >
                      <option value="" class="">Selecione</option>
                      <option value="Não Pago"  >Não Pago</option>
                      <option value="Depósito/Cheque"  >Depósito/Cheque</option>
                      <option value="PagSeguro" selected >Pagseguro</option>
                      <option value="Transferência"  >Transferência</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="payment_status">Status do Pagamento<tag data-bs-toggle="tooltip" title="Status do Pagamento"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                    <select class="form-select" id="payment_status" name="payment_status" required >
                      <option value="" class="">Selecione</option>
                      <option value="S"  >Pago</option>
                      <option value="N" selected >Não Pago</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="payment_value">Valor Pago<tag data-bs-toggle="tooltip" title="Valor do Pagamento em Real"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                      <input type="text" class="form-control current-balance" placeholder="10,000.00" id="payment_value" name="payment_value" />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="qualification">Qualificação<strong>*</strong></label>
                  </div>
                  <div class="col-sm-9">
                    <select class="form-select" id="qualification" name="qualification" required >
                      <option value="" class="">Selecione</option>
                      <option value="S" selected >Sim</option>
                      <option value="N"  >Não</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="information">Observação <tag data-bs-toggle="tooltip" title="Breve descrição, não obrigatória."><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                    <textarea id="information" class="form-control" name="information"  ></textarea>
                  </div>
                </div>
              </div>
              <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary me-1">Salvar</button>
                <button type="reset" class="btn btn-outline-secondary">Resetar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-8 col-12">
      <div class="card">
        <div class="card-header border-bottom">
          <h4 class="card-title">Matriculas Cadastradas - Busca Avançada</h4>
        </div>
        <hr class="my-0" />
        <div class="card-datatable">
        @if (count($registrations) >= 1)
          <table class="dt-advanced-search table">
            <thead>
              <tr>
                <th></th>
                <th>Aluno</th>
                <th>Código</th>
                <th>Status do Pagamento</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Aluno</th>
                <th>Código</th>
                <th>Status do Pagamento</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </tfoot>
            <tbody>
              @php $i = 0; @endphp
              @foreach($registrations as $registration)
                @if($i == 0)
                  @php $i = 1; @endphp
                  <tr class="odd">
                @else
                  @php $i = 0; @endphp
                  <tr class="even">
                @endif
                    <td class="control sorting_1" tabindex="0" ></td>
                    <td style="display: none;">{{ $registration->person_id }}</td>
                    <td style="display: none;">{{ $registration->code }}</td>
                    <td style="display: none;">{{ $registration->payment_status == "S" ? 'Pago' : ($registration->payment_status == "N" ? 'Não Pago' : $registration->payment_status)  }}</td>
                    <td style="display: none;">{{isset($registration->created_at) ? (($registration->created_at)->format('d/m/Y H:m:s')) : ''}}</td>
                    <td style="display: none;">
                      <a href="{{ route('matriculas.show', $registration->id) }}" title="Editar" class="btn btn-info btn-sm" style="color: white; "><i data-feather="edit" class="font-small-4"></i></a>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
          @else
            <div class="alert alert-warning" role="alert">
              <h4 class="alert-heading">Aviso</h4>
              <div class="alert-body">
                Não existem Matrículas Armazenadas.
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
<!-- users list ends -->
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
<script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
<script src="{{asset(mix('vendors/js/forms/cleave/cleave.min.js'))}}"></script>
<script src="{{asset(mix('vendors/js/forms/cleave/addons/cleave-phone.br.js'))}}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/tables/registrations.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{asset(mix('js/scripts/components/components-alerts.js'))}}"></script>
<script src="{{ asset(mix('js/scripts/forms/expense-input-mask.js')) }}"></script>
@endsection
