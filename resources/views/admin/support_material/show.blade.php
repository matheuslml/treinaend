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
          <h4 class="card-title">Editar Materia de Apoio</h4>
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
          <form class="form form-horizontal" method="POST" action="{{ route('materiais_de_apoio.update', $support_material_selected->id) }}" enctype="multipart/form-data">
            @csrf()
              @method('PUT')
            <div class="row">
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="title">Título <tag data-bs-toggle="tooltip" title="Não obrigatório, não aparece se não colocar"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                      <select class="select2 form-select" id="discipline_id" name="discipline_id">
                        <optgroup label="Selecione">
                          @foreach($disciplines as  $discipline)
                            <option value="{{ $discipline->id }}" {{ (in_array($discipline->id, old('discipline', [])) || isset($disciplines) && $support_material_selected->discipline->id == $discipline->id) ? 'selected' : '' }} >{{ $discipline->name }}</option>
                          @endforeach
                        </optgroup>
                      </select>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="title">Título<tag data-bs-toggle="tooltip" title="Nome do Material de Apoio"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="title" name="title" value="{{ $support_material_selected->title }}" />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="icon">Ícone<tag data-bs-toggle="tooltip" title="Ícone"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                    <label class="form-label" for="select2-icons">Icons</label>
                    <select data-placeholder="Select a state..." class="select2-icons form-select" id="select2-icons" name="icon">
                        <option value="reader" data-icon="file-text" {{ $support_material_selected->icon == "reader" ? 'selected' : '' }} >Texto</option>
                        <option value="powerpoint" data-icon="image" {{ $support_material_selected->icon == "powerpoint" ? 'selected' : '' }} >Slides</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="payment_status">Subir novo Arquivo<tag data-bs-toggle="tooltip" title="link"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                      <input type="file" class="form-control" id="link" name="link" >
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="order">Ordem<tag data-bs-toggle="tooltip" title="Valor do Pagamento em Real"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                    <div class="input-group input-group-lg">
                        <input type="number" class="touchspin" value="{{ $support_material_selected->order }}" id="order" name="order" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 mt-2">
                <button type="submit" class="btn btn-primary me-1" style="position: relative; float: left;">Editar</button>
                </form>
                <form method="POST" name="form-delete" action="{{ route('materiais_de_apoio.destroy', $support_material_selected->id) }}">
                    @csrf()
                    @method('delete')
                    <button type="submit" class="btn btn-danger" style="position: relative; float: left;"
                      onclick="return confirm('Tem certeza que deseja deletar a Materia de Apoio?');">Deletar
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
  <script src="{{ asset(mix('vendors/js/forms/spinner/jquery.bootstrap-touchspin.js'))}}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{asset(mix('js/scripts/components/components-alerts.js'))}}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-number-input.js'))}}"></script>
@endsection
