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
      <p class="card-text ">conhecimento que abre caminhos</p>
    </div>
  </div>
</section>
<!-- /search header -->

<!-- frequently asked questions tabs pills -->
<section id="">
  <!-- vertical tab pill -->
  <div class="row">
    <div class="col-12">

        <!-- exam fazer tela para completar e falhar em prova  ---------------------------------------------------------------------------------->
        <div class="tab-pane" id="faq-exam" role="tabpanel" aria-labelledby="exam" aria-expanded="false" >

          <!-- icon and header exam_questions -->
          <div class="d-flex align-items-center col-12">
            <div class="bs-stepper vertical vertical-wizard-example" >
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
                            <button type="button" class="step-trigger" id="btn-number-lesson-{{ $i }}" disabled>
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
                        <small class="text-muted">Data: {{ $examDateFormated }}</small>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="vertical-username" {{ $exam_date == false ? 'hidden' : '' }} >Chegou a hora de colocar em prática tudo o que você estudou. Respire fundo, mantenha a concentração e faça o seu melhor.</label>
                            <label class="form-label" for="vertical-username" {{ $exam_date == true ? 'hidden' : '' }} >Ainda não é o dia da prova. Aproveite este tempo para revisar o conteúdo, reforçar os pontos que você tem mais dificuldade e se preparar com calma. Mantenha o foco nos estudos, organize seu cronograma e use cada dia como uma oportunidade para estar mais seguro quando chegar a hora.</label>
                        </div>
                        <div class="" >
                        <button class="btn btn-primary btn-next" id="btn-start"  {{ $exam_date == false ? 'hidden' : '' }} >
                            <span class="align-middle d-sm-inline-block d-none">Começar</span>
                            <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                        </button>
                        </div>
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
                            <h5 class="mb-0">Questão: {{ $i }} </h5>
                            <small>Faça com calma! </small>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="card">
                                    <img
                                        src="{{ asset('storage/files/' . $question->exercise->file) }}"
                                        class="card-img-top"
                                    />
                                    <div class="card-body">
                                        <div class="row">
                                            <label class="" for="type">Selecione   <tag data-bs-toggle="tooltip" title="Escolha a Sua Resposta"><i data-feather='info'></i></tag></label>
                                            <div class="col-12">
                                                @php
                                                    $quantity = $question->exercise->answers;
                                                    $j = 0;
                                                @endphp
                                                <input type="number" value="{{ $question->id }}" id="question-{{ $i }}" name="question" hidden/>
                                                <select class="form-select" id="answer-{{ $i }}" name="answer" required >
                                                    <option value="" class="">Respostas</option>
                                                    @while ($quantity > 0)
                                                        @php
                                                            $j++;
                                                            $quantity--;
                                                        @endphp
                                                        <option value="{{ $j }}"  >{{ $j }}-{{ $question->exercise->correct_answer }}</option>
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
                            <button  id="btn-next-{{ $i }}" class="btn btn-primary btn-next"  {{ $i == 10 ? 'hidden' : '' }} >
                                <span class="align-middle d-sm-inline-block d-none">Próximo</span>
                                <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                            </button>
                            <button  id="btn-lesson-save-{{ $i }}" class="btn btn-success" {{ $i < 10 ? 'hidden' : '' }} >
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

  <script src="{{ asset(mix('js/scripts/extensions/ext-component-media-player-treinaend.js')) }}"></script>-->
  <script src="{{ asset(mix('js/scripts/exercise/check_exercise.js')) }}"></script>
@endsection


