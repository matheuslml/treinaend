@extends('layouts.web_base')

@section('page-style')
@endsection

@section('content')
    <!-- Title Section -->
    <section class="title-section">
        <div class="container">
            <h2>Sobre Nós</h2>
            <h3>Conheça a TREINAEND</h3>
        </div>
    </section>

    <!-- About Section -->
    <section class="tnd-about-section">
        <div class="tnd-about-content">
            <span class="tnd-about-category">Institucional</span>
            <h2 class="tnd-about-title">Quem Somos</h2>
            <p class="tnd-about-description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Fusce vitae lorem nec sapien tincidunt fermentum. 
                Integer euismod, magna vel facilisis cursus, justo nulla 
                posuere libero, vitae tincidunt risus lorem nec erat.
            </p>
            <a href="#" class="tnd-about-button">Saiba Mais</a>
        </div>
        <div class="tnd-about-image">
            <img src="{{ asset('assets-web/img/bg-ombudsman.jpg') }}" alt="Sobre TREINAEND">
        </div>
    </section>

    <!-- Values Section -->
    <section class="tnd-education-section">
        <div class="container">
            <h3 class="tnd-education-title">Nossos Valores</h3>

            <div class="tnd-education-grid">
                <div class="tnd-education-card">
                    <div class="tnd-education-image">
                        <img src="{{ asset('assets-web/img/bg-ombudsman.jpg') }}" alt="Missão">
                    </div>
                    <h4 class="tnd-education-name">Missão</h4>
                    <div class="tnd-education-content">
                        <p class="tnd-education-meta">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                            Proin ac neque nec sapien fermentum varius.
                        </p>
                    </div>
                </div>

                <div class="tnd-education-card">
                    <div class="tnd-education-image">
                        <img src="{{ asset('assets-web/img/bg-ombudsman.jpg') }}" alt="Visão">
                    </div>
                    <h4 class="tnd-education-name">Visão</h4>
                    <div class="tnd-education-content">
                        <p class="tnd-education-meta">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                            Integer euismod magna vel facilisis cursus.
                        </p>
                    </div>
                </div>

                <div class="tnd-education-card">
                    <div class="tnd-education-image">
                        <img src="{{ asset('assets-web/img/bg-ombudsman.jpg') }}" alt="Valores">
                    </div>
                    <h4 class="tnd-education-name">Valores</h4>
                    <div class="tnd-education-content">
                        <p class="tnd-education-meta">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                            Justo nulla posuere libero, vitae tincidunt risus lorem nec erat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="comment-section-footer">
        <h3>Compromisso com a Indústria Brasileira</h3>
        <h4>Capacitação, responsabilidade técnica e evolução contínua</h4>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Fusce vitae lorem nec sapien tincidunt fermentum. 
            Integer euismod magna vel facilisis cursus.
        </p>
    </section>
@endsection


@section('page-script')

    <script src="assets-web/js/site/site.js" src=""></script>
@endsection
