@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Notificações')

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
    <div class="col-md-6 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">{{ 'Editar Modelo de Notificação - ' . ($notificationTemplate->type == 'discipline_notification' ?
                    'Pagamento' : 'Fim de Curso') }}</h4>
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
          <form class="form form-horizontal" method="POST" action="{{ route('notificacao_modelos.update', $notificationTemplate->id) }}">
            @csrf()
              @method('PUT')
            <div class="row">

              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="title">Título</label>
                  </div>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="title" name="title" value="{{ $notificationTemplate->title }}" />
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="content">Conteúdo</label>
                  </div>
                  <div class="col-sm-9">
                      <textarea  name="content" id="content" class="form-control" >{{ $notificationTemplate->content }}</textarea>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="description">Descrição Interna</label>
                  </div>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="description" name="description" value="{{ $notificationTemplate->description }}" />
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="phone_number">Telefone (55 + DDD + número)</label>
                  </div>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $notificationTemplate->phone_number }}" />
                  </div>
                </div>
              </div>

              <div class="col-12 mt-2">
                <button type="submit" class="btn btn-primary me-1" style="position: relative; float: right;">Editar</button>
              </div>
            </div>
          </form>
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
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection