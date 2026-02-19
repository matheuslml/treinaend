@extends('admin/layouts/contentLayoutMaster')

@section('title', 'matriculas do Site')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/plyr.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-faq.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-media-player.css')) }}">
@endsection

@section('content')
<!-- searcha header -->
<section id="faq-search-filter">
  <div class="card " >
    <div class="card-body text-left">
      <!-- main title -->
      <h2 class="text-primary">{{ $discipline->name }}</h2>

      <!-- subtitle -->
      <p class="card-text ">escrever texto</p>
    </div>
  </div>
</section>
<!-- /search header -->

<!-- frequently asked questions tabs pills -->
<section id="faq-tabs">
  <!-- vertical tab pill -->
  <div class="row">
    <div class="col-lg-3 col-md-4 col-sm-12">
      <div class="faq-navigation d-flex justify-content-between flex-column mb-2 mb-md-0">
        <!-- pill tabs navigation -->
        <ul class="nav nav-pills nav-left flex-column" role="tablist">
          <!-- open exercise -->
          <li class="nav-item">
            <a
              class="nav-link active"
              id="lesson"
              data-bs-toggle="pill"
              href="#faq-lesson"
              aria-expanded="true"
              role="tab"
            >
              <i data-feather="book-open" class="font-medium-3 me-1"></i>
              <span class="fw-bold">Aulas</span>
            </a>
          </li>

          <li class="nav-item">
            <a
              class="nav-link"
              id="exercise"
              data-bs-toggle="pill"
              href="#faq-exercise"
              aria-expanded="true"
              role="tab"
            >
              <i data-feather="book-open" class="font-medium-3 me-1"></i>
              <span class="fw-bold">Exercício em Aberto</span>
            </a>
          </li>

          <!-- exercise done -->
          <li class="nav-item">
            <a
              class="nav-link"
              id="exercise-done"
              data-bs-toggle="pill"
              href="#faq-exercise-done"
              aria-expanded="false"
              role="tab"
            >
              <i data-feather="check-circle" class="font-medium-3 me-1"></i>
              <span class="fw-bold">Exercício Realizado</span>
            </a>
          </li>

          <!-- Support-material -->
          <li class="nav-item">
            <a
              class="nav-link"
              id="Support-material"
              data-bs-toggle="pill"
              href="#faq-Support-material"
              aria-expanded="false"
              role="tab"
            >
              <i data-feather="file-text" class="font-medium-3 me-1"></i>
              <span class="fw-bold">Material de Apoio</span>
            </a>
          </li>

          <!-- cancellation and return -->
          <li class="nav-item">
            <a
              class="nav-link"
              id="exam"
              data-bs-toggle="pill"
              href="#faq-exam"
              aria-expanded="false"
              role="tab"
            >
              <i data-feather="clock" class="font-medium-3 me-1"></i>
              <span class="fw-bold">Prova</span>
            </a>
          </li>
        </ul>

        <!-- FAQ image -->
        <img
          src="{{asset('images/illustration/faq-illustrations.svg')}}"
          class="img-fluid d-none d-md-block"
          alt="demand img"
        />
      </div>
    </div>

    <div class="col-lg-9 col-md-8 col-sm-12">
      <!-- pill tabs tab content -->
      <div class="tab-content">

        <!-- lesson panel -->
        <div role="tabpanel" class="tab-pane active" id="faq-lesson" aria-labelledby="lesson" aria-expanded="true">
          <!-- icon and header -->
            <div class="row match-height">
                @php
                    $i=0;
                @endphp
                @foreach ($lessons as $lesson)
                    @php
                        $i++;
                    @endphp
                    <div class="col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">Aula {{ $i }}: </h4>
                                <div class="video-player" id="">
                                    <iframe src="{{ $lesson->link_video }}" allowfullscreen allow="autoplay"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- exercise panel -->
        <div role="tabpanel" class="tab-pane" id="faq-exercise" aria-labelledby="exercise" aria-expanded="false">
          <!-- icon and header -->
            <div class="row match-height">
                @foreach ($exercises as $exercise)
                    <div class="col-md-6 col-lg-6">
                        <div class="card">
                            <img
                                src="{{ asset('storage/files/' . $exercise->file) }}"
                                class="card-img-top"
                            />
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST" action="{{ route('student_answer_exercise') }}">
                                    @csrf()
                                    <input type="text"  id="exercise_id" name="exercise_id" value="{{ $exercise->id }}" hidden />
                                    <div class="row">
                                        <label class="" for="type">Selecione<tag data-bs-toggle="tooltip" title="Escolha a Sua Resposta"><i data-feather='info'></i></tag></label>
                                        <div class="col-sm-8">
                                            @php
                                                $quantity = $exercise->answers;
                                                $i = 0;
                                            @endphp
                                            <select class="form-select" id="answer" name="answer" required >
                                                <option value="" class="">Respostas</option>
                                                @while ($quantity > 0)
                                                    @php
                                                        $i++;
                                                        $quantity--;
                                                    @endphp
                                                    <option value="{{ $i }}"  >{{ $i }}</option>
                                                @endwhile
                                            </select>
                                        </div>
                                        <div class="col-sm-4 ">
                                            <button type="submit" class="btn btn-primary me-1">Salvar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- exercise done panel -->
        <div role="tabpanel" class="tab-pane" id="faq-exercise-done" aria-labelledby="exercise-done" aria-expanded="false">
          <!-- icon and header -->
            <div class="row match-height">
                @foreach ($exercises_dones as $exercise_done)
                        <div class="col-md-6 col-lg-6">
                            <div class="card {{ $exercise_done->correct_answer == $exercise_done->users->first()->pivot->answer ? 'bg-success' : 'bg-danger' }} text-white">
                                <img
                                    src="{{ asset('storage/files/' . $exercise_done->file) }}"
                                    class="card-img-top"
                                />
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 text-start">
                                            <p class="card-text text-white">{{ 'Resposta Correta: ' . $exercise_done->correct_answer }}</p>
                                        </div>
                                        <div class="col-sm-6 col-md-6 text-end">
                                            <h4 class="card-title text-white">{{ 'Selecionada: ' . $exercise_done->users->first()->pivot->answer }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>

        <!-- Support-material panel -->
        <div class="tab-pane" id="faq-Support-material" role="tabpanel" aria-labelledby="Support-material" aria-expanded="false">
          <!-- icon and header -->
            <!-- Transaction card -->
            <div class="col-lg-8 col-md-8 col-12">
                <div class="card card-transaction">
                    <div class="card-header">
                        <h4 class="card-title">Materiais de Apoio</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($support_materials as $support_material)
                            <div class="transaction-item">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-primary rounded">
                                        <div class="avatar-content">
                                            <i data-feather="{{ $support_material->icon == "reader" ? 'file-text' : 'image' }}" class="avatar-icon font-medium-3"></i>
                                        </div>
                                    </div>
                                    <div class="transaction-info">
                                        <h6 class="transaction-title">{{ $support_material->title }}</h6>
                                        <small>{{ $support_material->icon == "reader" ? 'Arquivo de Texto' : 'Slides em PowerPoint' }}</small>
                                    </div>
                                </div>
                                <div class="fw-bolder text-danger">
                                    <a href="{{ route('download_support_material', $support_material->id) }}" class="btn-sm btn-primary me-1">
                                        <i data-feather="download" class="avatar-icon font-medium-3"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!--/ Transaction card -->
        </div>

        <!-- exam  -->
        <div class="tab-pane" id="faq-exam" role="tabpanel" aria-labelledby="exam" aria-expanded="false" >
          <!-- icon and header exam_questions -->
          <div class="d-flex align-items-center col-12">
            <div class="bs-stepper vertical vertical-wizard-example">
                <div class="bs-stepper-header">
                    <div class="step" data-target="#question-0-vertical" role="tab" id="question-0-vertical-trigger">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">0</span>
                        </button>
                    </div>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($exam_questions as $question)
                        @php
                            $i++;
                        @endphp
                        <div class="step" data-target="#question-{{ $i }}-vertical" role="tab" id="question-{{ $i }}-vertical-trigger">
                            <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">{{ $i }}</span>
                            </button>
                        </div>
                    @endforeach
                </div>
                <div class="bs-stepper-content">
                <div
                    id="question-0-vertical"
                    class="content"
                    role="tabpanel"
                    aria-labelledby="question-0-vertical-trigger"
                >
                    <div class="content-header">
                        <h5 class="mb-0">Prova </h5>
                        <small class="text-muted">texto prova.</small>
                    </div>
                    <div class="row">
                    <div class="mb-1 col-md-6">
                        <label class="form-label" for="vertical-username">Duração Máxima (Dias)</label>
                        <input type="text" class="form-control" value="{{ $discipline->days }}" disabled />
                    </div>
                    <div class="mb-1 col-md-6">
                        <label class="form-label" for="vertical-email">Data de Início</label>
                        <input type="text" class="form-control" value="" disabled />
                    </div>
                    </div>
                    <div class="row">
                    <div class="mb-1 form-password-toggle col-md-6">
                        <label class="form-label" for="vertical-password">Dias Restantes</label>
                        <input type="text" id="vertical" class="form-control" value="" disabled />
                    </div>
                    <div class="mb-1 form-password-toggle col-md-6">
                        <label class="form-label" for="vertical-confirm-password">Data Fim</label>
                        <input type="text" class="form-control" value="" disabled />
                    </div>
                    </div>
                    <div class="d-flex justify-content-between">
                    <button class="btn btn-outline-secondary btn-prev" disabled>
                        <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                        <span class="align-middle d-sm-inline-block d-none">Anterior</span>
                    </button>
                    <button class="btn btn-primary btn-next">
                        <span class="align-middle d-sm-inline-block d-none">Começar</span>
                        <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                    </button>
                    </div>
                </div>
                @php
                    $i = 0;
                @endphp
                @foreach ($exam_questions as $question)
                    @php
                        $i++;
                    @endphp
                    <div id="question-{{ $i }}-vertical" class="content" role="tabpanel" aria-labelledby="question-{{ $i }}-vertical-trigger">
                        <div class="content-header">
                            <h5 class="mb-0">Questão da Prova</h5>
                            <small>Faça com calma!</small>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="card">
                                    <img
                                        src="{{ asset('storage/files/' . $question->file) }}"
                                        class="card-img-top"
                                    />
                                    <div class="card-body">
                                        <div class="row">
                                            <label class="" for="type">Selecione<tag data-bs-toggle="tooltip" title="Escolha a Sua Resposta"><i data-feather='info'></i></tag></label>
                                            <div class="col-12">
                                                @php
                                                    $quantity = $exercise->answers;
                                                    $j = 0;
                                                @endphp
                                                <select class="form-select" id="answer" name="answer" required >
                                                    <option value="" class="">Respostas</option>
                                                    @while ($quantity > 0)
                                                        @php
                                                            $j++;
                                                            $quantity--;
                                                        @endphp
                                                        <option value="{{ $j }}"  >{{ $j }}</option>
                                                    @endwhile
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary btn-prev">
                                <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Anterior</span>
                            </button>
                            <button class="btn btn-primary btn-next"  {{ $i == 10 ? 'hidden' : '' }} >
                                <span class="align-middle d-sm-inline-block d-none">Próximo</span>
                                <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                            </button>
                            <button class="btn btn-success btn-next" {{ $i < 10 ? 'hidden' : '' }} >
                                <span class="align-middle d-sm-inline-block d-none">Salvar</span>
                                <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
          </div>
        </div>

      </div>
    </div>
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
  <script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/plyr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/plyr.polyfilled.min.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/tables/disciplines.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{asset(mix('js/scripts/components/components-alerts.js'))}}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-number-input.js'))}}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-wizard.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/extensions/ext-component-media-player-treinaend.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/exercise/check_exercise.js')) }}"></script>
@endsection

check_exercise
