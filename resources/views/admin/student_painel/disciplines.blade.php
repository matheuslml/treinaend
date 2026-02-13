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
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-faq.css')) }}">
@endsection

@section('content')
<!-- searcha header -->
<section id="faq-search-filter">
  <div class="card " >
    <div class="card-body text-left">
      <!-- main title -->
      <h2 class="text-primary">Desciplinas da TreinaEnd</h2>

      <!-- subtitle -->
      <p class="card-text ">bons estudos</p>
    </div>
  </div>
</section>
<!-- /search header -->

<!-- frequently asked questions tabs pills -->
<section id="faq-tabs">
  <!-- vertical tab pill -->
  <div class="row">
    @foreach ($disciplines as $discipline)
        <div class="col-md-6 col-lg-4">
            <div class="card text-center">
                <div class="card-header">'status do estudo'</div>
                <div class="card-body">
                <h4 class="card-title">{{ $discipline->name }}</h4>
                <a href="{{ route('exercises_student_index', ['disciplineId' => $discipline->id]) }}" class="btn btn-outline-primary">Acessar</a>
                </div>
                <div class="card-footer text-muted">{{ $discipline->days . ($discipline->days == 1 ? ' dia para realizar' : ' dias para realizar')  }}</div>
            </div>
        </div>
    @endforeach
  </div>
</section>
<!-- / frequently asked questions tabs pills -->

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
  <script src="{{ asset(mix('js/scripts/tables/disciplines.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{asset(mix('js/scripts/components/components-alerts.js'))}}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-number-input.js'))}}"></script>
@endsection

