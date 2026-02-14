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
        <!-- exercise panel -->
        <div role="tabpanel" class="tab-pane active" id="faq-exercise" aria-labelledby="exercise" aria-expanded="true">
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
                                    <a type="submit" class="btn-sm btn-primary me-1">
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
        <div
          class="tab-pane"
          id="faq-exam"
          role="tabpanel"
          aria-labelledby="exam"
          aria-expanded="false"
        >
          <!-- icon and header -->
          <div class="d-flex align-items-center">
            <div class="avatar avatar-tag bg-light-primary me-1">
              <i data-feather="clock" class="font-medium-4"></i>
            </div>
            <div>
              <h4 class="mb-0">Prazo</h4>
              <span>{{ $discipline->days }}</span>
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
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/tables/disciplines.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{asset(mix('js/scripts/components/components-alerts.js'))}}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-number-input.js'))}}"></script>
@endsection

