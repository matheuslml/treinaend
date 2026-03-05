<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<link rel="shortcut icon" href="{{isset($unit->logo) ? asset('storage/images/units/' . $unit->icon) : ''}}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($unit->name) ? $unit->name : '' }}</title>


    @component('web.components.styles')


    @endcomponent
</head>

    <body>
        <!-- ======= Header ======= -->
        <header id="header" >
            <div class="" style="margin-left: 2%;">

              <div class="logo float-start d-none d-xl-block">
                  <a href="{{ route('web_home') }}"><img class="img-profile"
                src="{{isset($unit->logo) ? asset('storage/images/units/' . $unit->logo) : ''}}"></a>
              </div>
              <div class="logo float-start d-lg-none">
                <img class="img-profile"
                  src="{{isset($unit->logo) ? asset('storage/images/units/' . $unit->logo) : ''}}">
              </div>

              <nav class="nav-menu float-start d-none d-lg-block" style="margin-left: 2%">
                <ul>
                  <li class="{{ (request()->is('/')) || (request()->is('/')) ? 'active' : '' }}">
                    <a href="{{ route('web_home') }}">Início</a></li>
                  <li class="drop-down {{ (request()->is('cursos*')) || (request()->is('cursos*')) ? 'active' : '' }}">
                    <a href="">Cursos</a>
                    <ul>
                      @foreach ($courses as $course)
                          <li class="">
                              <a href="">{{ $course->name }}</a>
                          </li>
                      @endforeach
                    </ul>
                  </li>
                  <li  {{ (request()->is('parcerias*')) || (request()->is('parcerias*')) ? 'active' : '' }}">
                    <a href="">Parcerias</a>
                  </li>
                  <li  {{ (request()->is('publicacoes')) || (request()->is('publicacao*')) ? 'active' : '' }}">
                    <a href="{{ route('noticias_web_index') }}">Blog</a>
                  </li>
                  <li  {{ (request()->is('sobre*')) || (request()->is('sobre*')) ? 'active' : '' }}">
                    <a href="">Sobre</a>
                  </li>
                  <li  {{ (request()->is('contato*')) || (request()->is('contato*')) ? 'active' : '' }}">
                    <a href="">Contato</a>
                  </li>

                  <li class="drop-down"> <a href="">Mais</a>
                    <ul>
                      <li class="">
                        <a class="employee-menu-link" href="{{ route('login') }}">Login</a></li>
                      <li class="">
                        <a href="">Matrícula</a></li>
                      <li class="">
                        <a href="">Consulta de Profissionais</a></li>
                    </ul>
                  </li>

                </ul>
              </nav><!-- .nav-menu -->

            </div>
          </header><!-- End Header -->

        <main id="main">
            @include('flash::message')

            @yield('content')
        </main>
         <!-- ======= Footer ======= -->
        <footer id="footer">
            <div class="container-fluid">


            </div>
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-4 col-md-6 footer-newsletter">
                            <iframe src="{{ isset($unit->google_maps_iframe) ? $unit->google_maps_iframe : '' }}" height="100%" width="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                        <div class="col-12 col-lg-3 col-md-6 footer-info">
                            <img class="img-profile-footer-home" src="{{isset($unit->logo) ? asset('storage/images/units/' . $unit->logo) : ''}}" >
                            <div class="col-12 text-footer-phone">
                                <p class="mt-2">
                                    {{ isset($unit->organization) ? $unit->organization->title : ''}} <br>
                                    {{ isset($unit) ? $unit->address : '' }}<br>
                                    {{ isset($unit->organization) ? $unit->operation : '' }}<br><br>
                                </p>
                                <a  href="mailto:{{ isset($unit->email) ? $unit->email : '' }}"><i class="fa fa-envelope"></i> {{ isset($unit->email) ? $unit->email : '' }}</a><br>                    <a
                                href="
                                {{ isset($unit) ?
                                    'https://api.whatsapp.com/send/?phone=%2B' .
                                        $unit->phone .
                                        '&text&type=phone_number&app_absent=0'
                                        : ''
                                }}" ><i class="fab fa-whatsapp"></i> {{ isset($unit->phone) ? $unit->phone : '' }}</a><br>
                                <a  href="{{ isset($unit) ? $unit->operation : '' }}"><i class="fa fa-home"></i> {{ isset($unit->operation) ? $unit->operation : '' }}</a>
                            </div>
                        </div>

                        <div class="col-12 col-lg-2 col-md-6 footer-links  text-footer-phone">
                            {!! html_entity_decode((isset($web_footer->content_left) ? $web_footer->content_left : ''), ENT_QUOTES, 'UTF-8') !!}
                        </div>
                        <div class="col-12 col-lg-2 col-md-6 footer-links  text-footer-phone" style="padding-left: 4%";>
                            {!! html_entity_decode((isset($web_footer->content_right) ? $web_footer->content_right : ''), ENT_QUOTES, 'UTF-8') !!}
                        </div>


                    </div>
                </div>
            </div>

            <div class="container b-5 px-3 pt-3 text-muted text-center text-small">
                <div class="row develop-by">
                    <div class="col-12 text-center " >
                        <a style="color: white;" href="{{ isset($copyright->link_url) ? $copyright->link_url : '' }}"><p class="mb-1"> Desenvolvido pela {{ isset($copyright->company_name) ? $copyright->company_name : '' }}</p></a>
                    </div>
                    <div class="col-12" >
                        @php
                            $verifica_logo = false;
                        @endphp
                        @if (isset($web_footer->logos))
                            @foreach ( $web_footer->logos as $logo)
                                <a href="{{ $logo->link_url }}">
                                    <img
                                        {{ $verifica_logo ? "style=\"padding-left:10px;margin-left:10px;border-left:1px solid #858796;\"" : '' }}
                                        src="{{asset('storage/images/webfooters/' . $logo->logo_url)}}"
                                        alt="{{ $logo->title }}"
                                    />
                                </a>
                                @if ($verifica_logo)
                                    @php
                                        $verifica_logo = false;
                                    @endphp
                                @else
                                    @php
                                        $verifica_logo = true;
                                    @endphp
                                @endif
                            @endforeach
                        @endif
                        @if (isset($copyright->logo_url))
                            <a href="{{ isset($copyright->link_url) ? $copyright->link_url : '' }}"><img src="{{asset('storage/images/copyrights/' . $copyright->logo_url)}}" height="50" style="padding-left:10px;margin-left:10px;border-left:1px solid #858796;" alt="{{ $copyright->company_name }}"></a>
                        @endif
                    </div>
                </div>
            </div>
        </footer><!-- End Footer -->
        <div vw class="enabled">
            <div vw-access-button class="active"></div>
            <div vw-plugin-wrapper>
              <div class="vw-plugin-top-wrapper"></div>
            </div>
          </div>
          <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
          <script>
            new window.VLibras.Widget('https://vlibras.gov.br/app');
          </script>

            <a href="https://arraial.egov.modernizacao.com.br/" class="back-to-top-link"><img src="{{ isset($web_footer->float_icon_url) ? asset('storage/images/webfooters/' . $web_footer->float_icon_url) : '' }}" class="" alt="icon"/></a>
        @component('web.components.scripts')

        @endcomponent
    {{-- JS Script --}}
    @yield('js-script')
    {{-- JS Script --}}
    </body>
</html>
