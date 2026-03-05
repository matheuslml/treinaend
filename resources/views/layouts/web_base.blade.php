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
            <div class="" style="margin:0 2% 0 2%;">
                <div class="logo float-start d-none d-xl-block" style="display: flex; align-items: center;">
                    <a href="{{ route('web_home') }}" style="display: flex; align-items: center;">
                        <img class="img-profile"
                            src="{{ isset($unit->logo) ? asset('storage/images/units/' . $unit->logo) : '' }}"
                            style="margin-right: 10px;">
                        <div class="text-sm hidden text-gray-500 dark:text-white lg:block">
                            {{ $unit->operation }}
                        </div>
                    </a>
                </div>

              <div class="logo float-start d-lg-none">
                    <a href="{{ route('web_home') }}" style="display: flex; align-items: center;">
                        <img class="img-profile"
                            src="{{ isset($unit->logo) ? asset('storage/images/units/' . $unit->logo) : '' }}"
                            style="margin-right: 10px;">
                        <div class="text-sm hidden text-gray-500 dark:text-white lg:block">
                            {{ $unit->operation }}
                        </div>
                    </a>
              </div>

              <nav class="nav-menu float-end d-none d-lg-block" style="margin-left: 2%">
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
        <footer id="footer" class="w-ful">
            <div class="footer-top">
                <div class="row footer-logo">
                    <img class="img-profile-footer-home" src="{{isset($unit->logo) ? asset('storage/images/units/' . $unit->logo) : ''}}" >
                </div>
                <div class="row">
                    <div class="col-12 col-lg-3 col-md-6 footer-links  text-footer-phone">
                        <div class="col-12 text-footer-phone">
                            <a  href=""><h4 class="mt-2 footer-link-title">
                                Home
                            </h4></a>
                            <a  href=""><p class="mt-2 footer-link-text">
                                Inspeção de Equipamentos
                            </p></a>
                            <a  href=""><p class="mt-2 footer-link-text">
                                NR-33 – Trabalho em espaço Confinado
                            </p></a>
                            <a  href=""><p class="mt-2 footer-link-text">
                                NR-35 – Trabalho em altura
                            </p></a>
                            <a  href=""><p class="mt-2 footer-link-text">
                                Parcerias educacionais
                            </p></a>
                            <a  href=""><p class="mt-2 footer-link-text">
                                Blog
                            </p></a>
                            <a  href=""><p class="mt-2 footer-link-text">
                                Sobre a TREINAEND
                            </p></a>
                            <a  href=""><p class="mt-2 footer-link-text">
                                Contato
                            </p></a>
                            <a  href=""><p class="mt-2 footer-link-text">
                                Meu EAD
                            </p></a>
                            <a  href=""><p class="mt-2 footer-link-text">
                                Matrícula
                            </p></a>
                            <a  href=""><p class="mt-2 footer-link-text">
                                Consulta de Profissionais
                            </p></a>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3 col-md-6 footer-info">
                        <div class="col-12 text-footer-phone">
                            <a  href=""><h4 class="mt-2 footer-link-title">
                                Localização
                            </h4></a>
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
                    <div class="col-12 col-lg-2 col-md-6 footer-links  text-footer-phone" style="padding-left: 4%";>
                    </div>
                    <div class="col-12 col-lg-4 col-md-6 footer-links  text-footer-phone" style="padding-left: 4%";>
                        <div class="col-12 text-footer-phone">
                            <a  href=""><h4 class="mt-2 footer-link-title">
                                Seja um Aluno da TREINAEND
                            </h4></a>
                            <p class="footer-link-text">Ao se matricular, você garante acesso imediato a conteúdos inspiradores, professores renomados e experiências únicas que vão impulsionar sua carreira e seu desenvolvimento pessoal.
Não espere mais: faça sua matrícula agora e dê o primeiro passo rumo ao futuro que você merece.</p>
                            <a  href=""><h4 class="mt-2 footer-link-title">
                                Siga a TREINAEND
                            </h4></a>
                        </div>
                    </div>


                </div>
            </div>

            <div class="container b-5 px-3 pt-3 text-muted text-center text-small">
                <div class="row develop-by">
                    <div class="col-12 text-center " >
                        <a style="color: white;" href="{{ isset($copyright->link_url) ? $copyright->link_url : '' }}"><p class="mb-1"> Desenvolvido pela {{ isset($copyright->company_name) ? $copyright->company_name : '' }}</p></a>
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
