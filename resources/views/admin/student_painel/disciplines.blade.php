@extends('admin/layouts/contentLayoutMaster')

@section('title', 'matriculas do Site')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" href="{{asset(mix('vendors/css/charts/apexcharts.css'))}}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-faq.css')) }}">
<link rel="stylesheet" href="{{asset(mix('css/base/pages/app-chat-list.css'))}}">
@endsection

@section('content')
<!-- searcha header -->
<section id="faq-search-filter">
  <div class="card " >
    <div class="card-body text-left">
      <!-- main title -->
      <h2 class="text-primary">Desciplinas da TreinaEnd</h2>

      <!-- subtitle -->
      <p class="card-text ">conhecimento que abre caminhos</p>
    </div>
  </div>
</section>
<!-- /search header -->

<!-- frequently asked questions tabs pills -->
<section id="faq-tabs">
  <!-- vertical tab pill -->
  <div class="row">
        @php
            $pivot = $discipline_atual->person->first()?->pivot;
        @endphp
        <div class="col-md-8 col-lg-8 " >
            <div class="card text-center card-congratulations">
                <div class="card-header">
                    <div class="avatar avatar-xl bg-primary shadow">
                        <div class="avatar-content">
                            <i data-feather="{{ ($discipline_atual->person->first()?->pivot?->score >= 7) ? "award" : (($discipline_atual->person->first()?->pivot?->exam_date ? "play-circle" : "x-circle" )) }}" class="font-large-1"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h4 class="card-title mb-1 text-white">{{ $discipline_atual->name }}</h4>
                    <a href="{{ route('exercises_student_index', ['disciplineId' => $discipline_atual->id]) }}" class="btn btn-outline-primary  text-white" >Acessar</a>
                </div>
                <div class="card-footer text-muted ">
                    <p class="card-text m-auto w-75 text-white">
                        Prova: {{ $discipline_atual->person->first()?->pivot?->exam_date ? \Carbon\Carbon::parse($discipline_atual->person->first()?->pivot->exam_date)->format('d/m/Y') : null ?? 'Disciplina Bloqueada' }}
                    </p>
                </div>
            </div>
        </div>
    @foreach ($disciplines as $discipline)
        @php
            $pivot = $discipline->person->first()?->pivot;
        @endphp
        @if ($discipline->id != $discipline_atual->id)
            <div class="col-md-6 col-lg-4">
                <div class="card text-center">
                    <div class="card-header">
                        <div class="avatar avatar-lg bg-primary shadow">
                            <div class="avatar-content">
                                <i data-feather="{{ ($pivot?->score >= 7) ? "award" : (($pivot?->exam_date ? "play-circle" : "x-circle" )) }}" class="font-large-1"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    <h4 class="card-title">{{ $discipline->name }}</h4>
                    <a href="{{ route('exercises_student_index', ['disciplineId' => $discipline->id]) }}" class="btn btn-outline-primary {{ $pivot?->exam_date ? \Carbon\Carbon::parse($pivot->exam_date)->format('d/m/Y') : null ?? 'disabled' }}">Acessar</a>
                    </div>
                    <div class="card-footer text-muted">Prova: {{ $pivot?->exam_date ? \Carbon\Carbon::parse($pivot->exam_date)->format('d/m/Y') : null ?? 'Disciplina Bloqueada' }}</div>
                </div>
            </div>
        @endif
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
<script src="{{asset(mix('vendors/js/charts/apexcharts.min.js'))}}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/tables/disciplines.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{asset(mix('js/scripts/components/components-alerts.js'))}}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-number-input.js'))}}"></script>
  <script src="{{ asset(mix('js/scripts/cards/card-advance.js')) }}"></script>
@endsection

