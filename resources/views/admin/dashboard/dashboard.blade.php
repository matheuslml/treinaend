
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
          <h4 class="card-title">Histórioco de Mensagens</h4>
        </div>
      </div>
      <div class="card-body">
        <ul class="timeline ms-50">
          @foreach(
                      Auth::user()
                          ->notifications()
                          ->orderBy('created_at', 'desc')
                          ->take(10)
                          ->get() 
                      as $newNotification
                  )
            <li class="timeline-item">
              <span class="timeline-point timeline-point-{{ $newNotification->status_id == 1 ? 'success' :
                                                            ($newNotification->status_id == 2 ? 'warning' : 
                                                            ($newNotification->status_id == 3 ? 'primary' : 
                                                            ($newNotification->status_id == 4 ? 'danger' : 'info'))) }} timeline-point-indicator"></span>
              <div class="timeline-event">
                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                  <h6>{{ $newNotification->type->title . ' - ' . $newNotification->title }}</h6>
                  <span class="timeline-event-time me-1">{{ $newNotification->created_at }}</span>
                </div>
                <p class="mb-0">{{ $newNotification->content }}</p>
              </div>
            </li>
          @endforeach

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
