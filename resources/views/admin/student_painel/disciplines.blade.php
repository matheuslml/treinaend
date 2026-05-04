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
      <h2 class="text-primary">Curso: {{ $course->name }}</h2>

      <!-- subtitle -->
      <p class="card-text ">Disciplinas Realizadas: {{ count($disciplines_person) . ' / ' . count($course->disciplines) }} </p>
    </div>
  </div>
</section>
<!-- /search header -->

<!-- frequently asked questions tabs pillss -->
<section id="faq-tabs">
  <!-- vertical tab pill -->
  @if (count($disciplines) > 0)
    <div class="row">
            @php
                $pivot = $discipline_atual->person->first()?->pivot;
            @endphp
            <div class="col-md-8 col-lg-7">
                <div class="card text-center card-congratulations">
                    <div class="card-header">
                        <div class="avatar avatar-xl bg-success shadow"> <!-- fundo verde -->
                            <div class="avatar-content">
                                <i data-feather="{{ ($discipline_atual->person->first()?->pivot?->score >= 7) ? 'award' : (($discipline_atual->person->first()?->pivot?->exam_date ? 'play-circle' : 'x-circle')) }}" class="font-large-1"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title mb-1 text-white">
                            {{ $discipline_atual->order . ' - ' .  $discipline_atual->name }}
                        </h4>
                        <a href="{{ route('exercises_student_index', ['disciplineId' => $discipline_atual->id]) }}" 
                        class="btn btn-success text-white"> <!-- botão verde -->
                            Acessar
                        </a>
                    </div>
                    <div class="card-footer text-muted">
                        <p class="card-text m-auto w-75 text-white">
                            Prova: {{ $discipline_atual->person->first()?->pivot?->exam_date 
                                ? \Carbon\Carbon::parse($discipline_atual->person->first()?->pivot->exam_date)->format('d/m/Y') 
                                : null ?? 'Disciplina Bloqueada' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-5">
                @foreach ($disciplines as $discipline)
                    @php
                        $pivot = $discipline->person->first()?->pivot;
                        $icon = ($pivot?->score >= 7) ? 'award' : (($pivot?->exam_date ? 'play-circle' : 'x-circle'));
                        $cardClass = ($pivot?->score < 7) ? 'bg-light' : ''; // fundo cinza claro se score < 7
                        $iconBgClass = ($pivot?->score < 7) ? 'bg-warning' : 'bg-primary'; // ícone amarelo se score < 7
                    @endphp

                    @if ($discipline->id != $discipline_atual->id)
                        <a href="{{ route('exercises_student_index', ['disciplineId' => $discipline->id]) }}">
                            <div class="card text-center {{ $cardClass }}">
                                <div class="card-header d-flex align-items-center">
                                    <div class="avatar avatar-lg {{ $iconBgClass }} shadow">
                                        <div class="avatar-content">
                                            <i data-feather="{{ $icon }}" class="font-large-1"></i>
                                        </div>
                                    </div>
                                    <h4 class="text-left ml-2">
                                        {{ $discipline->name . ' - ' .  $discipline->order }}
                                    </h4>
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
    </div>
  @endif
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

