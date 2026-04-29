
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
    @foreach ($courses_nav as $course)
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <img class="card-img-top" src="{{asset('storage/images/courses/' . $course->image_banner)}}" alt="Card image cap" />
                <div class="card-body">
                <h4 class="card-title">{{ $course->name }}</h4>
                <p class="card-text">
                    Some quick example text to build on the card title and make up the bulk of the card's content.
                </p>
                <a href="#" class="btn btn-outline-primary">Ver</a>
                </div>
            </div>
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
