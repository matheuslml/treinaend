
@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Áreta de Trabalho')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/plyr.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-media-player.css')) }}">
  @endsection

@section('content')

<!-- Examples -->
<section id="card-demo-example">
  <div class="row match-height">

    <div class="col-md-8 col-lg-8">
      <div class="card">
        <div class="card-body">
          <div class="video-player" id="plyr-video-player">
            <iframe src="https://www.youtube.com/embed/bTqVqk7FSmY" allowfullscreen allow="autoplay"></iframe>
          </div>
        </div>
      </div>
    </div>
  <!-- User Timeline Card -->
  <div class="col-lg-4 col-12">
    <div class="card card-user-timeline">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <i data-feather="list" class="user-timeline-title-icon"></i>
          <h4 class="card-title">User Timeline</h4>
        </div>
        <i data-feather="more-vertical" class="font-medium-3 cursor-pointer"></i>
      </div>
      <div class="card-body">
        <ul class="timeline ms-50">
          <li class="timeline-item">
            <span class="timeline-point timeline-point-indicator"></span>
            <div class="timeline-event">
              <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                <h6>12 Invoices have been paid</h6>
                <span class="timeline-event-time me-1">12 min ago</span>
              </div>
              <p>Invoices have been paid to the company.</p>
              <div class="d-flex flex-row align-items-center">
                <img class="me-1" src="{{asset('images/icons/json.png')}}" alt="data.json" height="23" />
                <h6 class="mb-0">data.json</h6>
              </div>
            </div>
          </li>
          <li class="timeline-item">
            <span class="timeline-point timeline-point-warning timeline-point-indicator"></span>
            <div class="timeline-event">
              <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                <h6>Client Meeting</h6>
                <span class="timeline-event-time me-1">45 min ago</span>
              </div>
              <p>Project meeting with john @10:15am</p>
              <div class="d-flex flex-row align-items-center">
                <div class="avatar me-50">
                  <img
                    src="{{asset('images/portrait/small/avatar-s-9.jpg')}}"
                    alt="Avatar"
                    width="38"
                    height="38"
                  />
                </div>
                <div class="user-info">
                  <h6 class="mb-0">John Doe (Client)</h6>
                  <p class="mb-0">CEO of Infibeam</p>
                </div>
              </div>
            </div>
          </li>
          <li class="timeline-item">
            <span class="timeline-point timeline-point-info timeline-point-indicator"></span>
            <div class="timeline-event">
              <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                <h6>Create a new project for client</h6>
                <span class="timeline-event-time me-1">2 day ago</span>
              </div>
              <p>Add files to new design folder</p>
              <div class="avatar-group">
                <div
                  data-bs-toggle="tooltip"
                  data-popup="tooltip-custom"
                  data-bs-placement="bottom"
                  title="Billy Hopkins"
                  class="avatar pull-up"
                >
                  <img
                    src="{{asset('images/portrait/small/avatar-s-9.jpg')}}"
                    alt="Avatar"
                    width="33"
                    height="33"
                  />
                </div>
                <div
                  data-bs-toggle="tooltip"
                  data-popup="tooltip-custom"
                  data-bs-placement="bottom"
                  title="Amy Carson"
                  class="avatar pull-up"
                >
                  <img
                    src="{{asset('images/portrait/small/avatar-s-6.jpg')}}"
                    alt="Avatar"
                    width="33"
                    height="33"
                  />
                </div>
                <div
                  data-bs-toggle="tooltip"
                  data-popup="tooltip-custom"
                  data-bs-placement="bottom"
                  title="Brandon Miles"
                  class="avatar pull-up"
                >
                  <img
                    src="{{asset('images/portrait/small/avatar-s-8.jpg')}}"
                    alt="Avatar"
                    width="33"
                    height="33"
                  />
                </div>
                <div
                  data-bs-toggle="tooltip"
                  data-popup="tooltip-custom"
                  data-bs-placement="bottom"
                  title="Daisy Weber"
                  class="avatar pull-up"
                >
                  <img
                    src="{{asset('images/portrait/small/avatar-s-20.jpg')}}"
                    alt="Avatar"
                    width="33"
                    height="33"
                  />
                </div>
                <div
                  data-bs-toggle="tooltip"
                  data-popup="tooltip-custom"
                  data-bs-placement="bottom"
                  title="Jenny Looper"
                  class="avatar pull-up"
                >
                  <img
                    src="{{asset('images/portrait/small/avatar-s-20.jpg')}}"
                    alt="Avatar"
                    width="33"
                    height="33"
                  />
                </div>
              </div>
            </div>
          </li>
          <li class="timeline-item">
            <span class="timeline-point timeline-point-danger timeline-point-indicator"></span>
            <div class="timeline-event">
              <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                <h6>Create a new project for client</h6>
                <span class="timeline-event-time me-1">5 day ago</span>
              </div>
              <p class="mb-0">Add files to new design folder</p>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!--/ User Timeline Card -->
    @foreach ($courses_nav as $course)
        <div class="col-md-4 col-lg-4">
            <a href="#" >
              <div class="card">
                  <img class="card-img-top" src="{{asset('storage/images/courses/' . $course->image_card)}}" alt="Card image cap" />
                  <div class="card-body">
                  <h4 class="card-title">{{ $course->name }}</h4>
                  </div>
              </div>
            </a>
        </div>
    @endforeach

  </div>
</section>
<!-- Examples -->
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/plyr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/plyr.polyfilled.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/pages/dashboard-analytics.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/extensions/ext-component-media-player.js')) }}"></script>
@endsection
