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
          <div class="d-flex align-items-center">
            <div class="avatar avatar-tag bg-light-primary me-1">
              <i data-feather="shopping-bag" class="font-medium-4"></i>
            </div>
            <div>
              <h4 class="mb-0">Delivery</h4>
              <span>Which license do I need?</span>
            </div>
          </div>

          <!-- frequent answer and question  collapse  -->
          <div class="accordion accordion-margin mt-2" id="faq-delivery-qna">
            <div class="card accordion-item">
              <h2 class="accordion-header" id="deliveryOne">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-delivery-one"
                  aria-expanded="false"
                  aria-controls="faq-delivery-one"
                >
                  Where has my order reached?
                </button>
              </h2>

              <div
                id="faq-delivery-one"
                class="collapse accordion-collapse"
                aria-labelledby="deliveryOne"
                data-bs-parent="#faq-delivery-qna"
              >
                <div class="accordion-body">
                  Pastry pudding cookie toffee bonbon jujubes jujubes powder topping. Jelly beans gummi bears sweet roll
                  bonbon muffin liquorice. Wafer lollipop sesame snaps. Brownie macaroon cookie muffin cupcake candy
                  caramels tiramisu. Oat cake chocolate cake sweet jelly-o brownie biscuit marzipan. Jujubes donut
                  marzipan chocolate bar. Jujubes sugar plum jelly beans tiramisu icing cheesecake.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="deliveryTwo">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-delivery-two"
                  aria-expanded="false"
                  aria-controls="faq-delivery-two"
                >
                  The shipment status shows that it has been returned/cancelled. What does it mean and who do I contact?
                </button>
              </h2>
              <div
                id="faq-delivery-two"
                class="collapse accordion-collapse"
                aria-labelledby="deliveryTwo"
                data-bs-parent="#faq-delivery-qna"
              >
                <div class="accordion-body">
                  Sweet pie candy jelly. Sesame snaps biscuit sugar plum. Sweet roll topping fruitcake. Caramels
                  liquorice biscuit ice cream fruitcake cotton candy tart. Donut caramels gingerbread jelly-o
                  gingerbread pudding. Gummi bears pastry marshmallow candy canes pie. Pie apple pie carrot cake.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="deliveryThree">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-delivery-three"
                  aria-expanded="false"
                  aria-controls="faq-delivery-three"
                >
                  What if my shipment is marked as lost?
                </button>
              </h2>
              <div
                id="faq-delivery-three"
                class="collapse"
                aria-labelledby="deliveryThree"
                data-bs-parent="#faq-delivery-qna"
              >
                <div class="accordion-body">
                  Tart gummies dragée lollipop fruitcake pastry oat cake. Cookie jelly jelly macaroon icing jelly beans
                  soufflé cake sweet. Macaroon sesame snaps cheesecake tart cake sugar plum. Dessert jelly-o sweet
                  muffin chocolate candy pie tootsie roll marzipan. Carrot cake marshmallow pastry. Bonbon biscuit
                  pastry topping toffee dessert gummies. Topping apple pie pie croissant cotton candy dessert tiramisu.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="deliveryFour">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-delivery-four"
                  aria-expanded="false"
                  aria-controls="faq-delivery-four"
                >
                  My shipment status shows that it’s out for delivery. By when will I receive it?
                </button>
              </h2>
              <div
                id="faq-delivery-four"
                class="collapse"
                aria-labelledby="deliveryFour"
                data-bs-parent="#faq-delivery-qna"
              >
                <div class="accordion-body">
                  Cheesecake muffin cupcake dragée lemon drops tiramisu cake gummies chocolate cake. Marshmallow tart
                  croissant. Tart dessert tiramisu marzipan lollipop lemon drops. Cake bonbon bonbon gummi bears topping
                  jelly beans brownie jujubes muffin. Donut croissant jelly-o cake marzipan. Liquorice marzipan cookie
                  wafer tootsie roll. Tootsie roll sweet cupcake.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="deliveryFive">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-delivery-five"
                  aria-expanded="false"
                  aria-controls="faq-delivery-five"
                >
                  What do I need to do to get the shipment delivered within a specific timeframe?
                </button>
              </h2>
              <div
                id="faq-delivery-five"
                class="collapse"
                aria-labelledby="deliveryFive"
                data-bs-parent="#faq-delivery-qna"
              >
                <div class="accordion-body">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                  dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                  aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                  dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                  officia deserunt mollit anim id est laborum.
                </div>
              </div>
            </div>
          </div>
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
              <i data-feather="refresh-cw" class="font-medium-4"></i>
            </div>
            <div>
              <h4 class="mb-0">Cancellation & Return</h4>
              <span>Which license do I need?</span>
            </div>
          </div>

          <!-- frequent answer and question  collapse  -->
          <div class="accordion accordion-margin mt-2" id="faq-cancellation-qna">
            <div class="card accordion-item">
              <h2 class="accordion-header" id="cancellationOne">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-cancellation-one"
                  aria-expanded="false"
                  aria-controls="faq-cancellation-one"
                >
                  Can my security guard or neighbour receive my shipment if I am not available?
                </button>
              </h2>

              <div
                id="faq-cancellation-one"
                class="collapse"
                aria-labelledby="cancellationOne"
                data-bs-parent="#faq-cancellation-qna"
              >
                <div class="accordion-body">
                  Pastry pudding cookie toffee bonbon jujubes jujubes powder topping. Jelly beans gummi bears sweet roll
                  bonbon muffin liquorice. Wafer lollipop sesame snaps. Brownie macaroon cookie muffin cupcake candy
                  caramels tiramisu. Oat cake chocolate cake sweet jelly-o brownie biscuit marzipan. Jujubes donut
                  marzipan chocolate bar. Jujubes sugar plum jelly beans tiramisu icing cheesecake.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="cancellationTwo">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-cancellation-two"
                  aria-expanded="false"
                  aria-controls="faq-cancellation-two"
                >
                  How can I get the contact number of my delivery agent?
                </button>
              </h2>
              <div
                id="faq-cancellation-two"
                class="collapse"
                aria-labelledby="cancellationTwo"
                data-bs-parent="#faq-cancellation-qna"
              >
                <div class="accordion-body">
                  Sweet pie candy jelly. Sesame snaps biscuit sugar plum. Sweet roll topping fruitcake. Caramels
                  liquorice biscuit ice cream fruitcake cotton candy tart. Donut caramels gingerbread jelly-o
                  gingerbread pudding. Gummi bears pastry marshmallow candy canes pie. Pie apple pie carrot cake.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="cancellationThree">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-cancellation-three"
                  aria-expanded="false"
                  aria-controls="faq-cancellation-three"
                >
                  How can I cancel my shipment?
                </button>
              </h2>
              <div
                id="faq-cancellation-three"
                class="collapse"
                aria-labelledby="cancellationThree"
                data-bs-parent="#faq-cancellation-qna"
              >
                <div class="accordion-body">
                  Tart gummies dragée lollipop fruitcake pastry oat cake. Cookie jelly jelly macaroon icing jelly beans
                  soufflé cake sweet. Macaroon sesame snaps cheesecake tart cake sugar plum. Dessert jelly-o sweet
                  muffin chocolate candy pie tootsie roll marzipan. Carrot cake marshmallow pastry. Bonbon biscuit
                  pastry topping toffee dessert gummies. Topping apple pie pie croissant cotton candy dessert tiramisu.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="cancellationFour">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-cancellation-four"
                  aria-expanded="false"
                  aria-controls="faq-cancellation-four"
                >
                  I have received a defective/damaged product. What do I do?
                </button>
              </h2>
              <div
                id="faq-cancellation-four"
                class="collapse"
                aria-labelledby="cancellationFour"
                data-bs-parent="#faq-cancellation-qna"
              >
                <div class="accordion-body">
                  Cheesecake muffin cupcake dragée lemon drops tiramisu cake gummies chocolate cake. Marshmallow tart
                  croissant. Tart dessert tiramisu marzipan lollipop lemon drops. Cake bonbon bonbon gummi bears topping
                  jelly beans brownie jujubes muffin. Donut croissant jelly-o cake marzipan. Liquorice marzipan cookie
                  wafer tootsie roll. Tootsie roll sweet cupcake.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="cancellationFive">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-cancellation-five"
                  aria-expanded="false"
                  aria-controls="faq-cancellation-five"
                >
                  How do I change my delivery address?
                </button>
              </h2>
              <div
                id="faq-cancellation-five"
                class="collapse"
                aria-labelledby="cancellationFive"
                data-bs-parent="#faq-cancellation-qna"
              >
                <div class="accordion-body">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                  dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                  aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                  dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                  officia deserunt mollit anim id est laborum.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="cancellationSix">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-cancellation-six"
                  aria-expanded="false"
                  aria-controls="faq-cancellation-six"
                >
                  What documents do I need to carry for self-collection of my shipment?
                </button>
              </h2>
              <div
                id="faq-cancellation-six"
                class="collapse"
                aria-labelledby="cancellationSix"
                data-bs-parent="#faq-cancellation-qna"
              >
                <div class="accordion-body">
                  At tempor commodo ullamcorper a lacus vestibulum. Ultrices neque ornare aenean euismod. Dui vivamus
                  arcu felis bibendum. Turpis in eu mi bibendum neque egestas congue. Nullam ac tortor vitae purus
                  faucibus ornare suspendisse sed. Commodo viverra maecenas accumsan lacus vel facilisis volutpat est
                  velit. Tortor consequat id porta nibh. Id aliquet lectus proin nibh nisl condimentum id venenatis a.
                  Faucibus nisl tincidunt eget nullam non nisi. Enim nunc faucibus a pellentesque. Pellentesque diam
                  volutpat commodo sed egestas egestas fringilla phasellus. Nec nam aliquam sem et tortor consequat id.
                  Fringilla est ullamcorper eget nulla facilisi. Morbi tristique senectus et netus et.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="cancellationSeven">
                <button
                  class="accordion-button collapsed"
                  data-bs-toggle="collapse"
                  role="button"
                  data-bs-target="#faq-cancellation-seven"
                  aria-expanded="false"
                  aria-controls="faq-cancellation-seven"
                >
                  What are the timings for self-collecting shipments from the Delhivery Branch?
                </button>
              </h2>
              <div
                id="faq-cancellation-seven"
                class="collapse"
                aria-labelledby="cancellationSeven"
                data-bs-parent="#faq-cancellation-qna"
              >
                <div class="accordion-body">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                  dolore magna aliqua. Euismod lacinia at quis risus sed vulputate odio ut enim. Dictum at tempor
                  commodo ullamcorper a lacus vestibulum.
                </div>
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
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/tables/disciplines.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{asset(mix('js/scripts/components/components-alerts.js'))}}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-number-input.js'))}}"></script>
@endsection

