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
    <div class="col-md-8 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Editar Matrícula</h4>
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
          <form class="form form-horizontal" method="POST" action="{{ route('matriculas.update', $registration_selected->id) }}" enctype="multipart/form-data">
            @csrf()
              @method('PUT')
            <div class="row">
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="title">Título <tag data-bs-toggle="tooltip" title="Não obrigatório, não aparece se não colocar"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                      <select class="select2 form-select" id="person_id" name="person_id">
                        <optgroup label="Selecione">
                          @foreach($people as  $person)
                            <option value="{{ $person->id }}" {{ (in_array($person->id, old('person', [])) || isset($people) && $registration_selected->person->id == $person->id) ? 'selected' : '' }} >{{ $person->full_name }}</option>
                          @endforeach
                        </optgroup>
                      </select>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="payment_form">Forma de Pagamento<tag data-bs-toggle="tooltip" title="Não obrigatório, não aparece se não colocar"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                    <select class="form-select" id="payment_form" name="payment_form" required >
                      <option value="" class="">Selecione</option>
                      <option value="Não Pago" {{ $registration_selected->payment_form == "Não Pago" ? 'selected' : '' }}  >Não Pago</option>
                      <option value="Depósito/Cheque" {{ $registration_selected->payment_form == "Depósito/Cheque" ? 'selected' : '' }} >Depósito/Cheque</option>
                      <option value="PagSeguro" {{ $registration_selected->payment_form == "PagSeguro" ? 'selected' : '' }} >Pagseguro</option>
                      <option value="Transferência" {{ $registration_selected->payment_form == "Transferência" ? 'selected' : '' }} >Transferência</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="order">Status do Pagamento <tag data-bs-toggle="tooltip" title="Status do Pagamento"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                    <select class="form-select" id="payment_status" name="payment_status" required >
                      <option value="" class="">Selecione</option>
                      <option value="S" {{ $registration_selected->payment_status == "S" ? 'selected' : '' }} >Pago</option>
                      <option value="N" {{ $registration_selected->payment_status == "N" ? 'selected' : '' }} >Não Pago</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="payment_value">Valor Pago <tag data-bs-toggle="tooltip" title="Não obrigatório, não aparece se não colocar"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                      <input type="text" class="form-control payment_value" placeholder="10,000.00" id="payment_value" name="payment_value" value="{{ str_replace('.',',', $registration_selected->payment_value)  }}" />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="qualification">Qualificação <tag data-bs-toggle="tooltip" title=" "><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                    <select class="form-select" id="qualification" name="qualification" required >
                      <option value="" class="">Selecione</option>
                      <option value="S" {{ $registration_selected->qualification == "S" ? 'selected' : '' }} >Sim</option>
                      <option value="N" {{ $registration_selected->qualification == "N" ? 'selected' : '' }} >Não</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="link">Informação <tag data-bs-toggle="tooltip" title=" "><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                    <textarea id="information" class="form-control" name="information"  >{{ $registration_selected->information }}</textarea>
                  </div>
                </div>
              </div>
              <div class="col-12 mt-2">
                <button type="submit" class="btn btn-primary me-1" style="position: relative; float: left;">Editar</button>
                </form>
                <form method="POST" name="form-delete" action="{{ route('matriculas.destroy', $registration_selected->id) }}">
                    @csrf()
                    @method('delete')
                    <button type="submit" class="btn btn-danger" style="position: relative; float: left;"
                      onclick="return confirm('Tem certeza que deseja deletar a Matrícula?');">Deletar
                    </button>
                </form>
              </div>
            </div>
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
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{asset(mix('js/scripts/components/components-alerts.js'))}}"></script>
<script src="{{ asset(mix('js/scripts/forms/registration-input-mask.js')) }}"></script>
@endsection
