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
            <p class="tnd-about-description">A TREINAEND é uma escola técnica especializada em capacitação industrial, 
                com atuação voltada à formação complementar de estudantes e profissionais da indústria. Nosso trabalho 
                é direcionado ao desenvolvimento técnico responsável, com foco na clareza dos conteúdos, na aplicação 
                prática e no alinhamento às exigências reais do setor industrial.</p>
            <p class="tnd-about-description">Atuamos na capacitação de profissionais que buscam fortalecer o currículo, 
                ampliar competências técnicas e se preparar de forma mais consistente para as demandas do mercado.</p>
            <a href="#" class="tnd-about-button">Saiba Mais</a>
        </div>
        <div class="tnd-about-image">
            <img src="{{ asset('assets-web/img/bg-ombudsman.jpg') }}" alt="Sobre TREINAEND">
        </div>
    </section>

    <!-- Seção 3 -->
    <section class="tnd-about-section tnd-section-gray">
        <div class="tnd-about-content">
            <h2 class="tnd-about-title">Nossa atuação</h2>
            <p>
                A TREINAEND atua há mais de 12 anos na capacitação técnica industrial, 
                oferecendo cursos que complementam a formação tradicional e contribuem para a preparação prática dos profissionais.
            </p>
            <p>
                Não trabalhamos com promessas irreais ou discursos comerciais exagerados. 
                Nosso foco é formar profissionais tecnicamente mais preparados, conscientes das responsabilidades e exigências da atuação industrial.
            </p>
        </div>
        <div class="tnd-about-content">
            <h3>Nossos programas são desenvolvidos com base em:</h3>
            
            <ul class="about-lists">
                <li><i class="fa fa-arrow-circle-right pages-module-scss-module__peInyW__pages-featured-link__icon float-left"></i>
experiência prática no contexto industrial</li>
                <li><i class="fa fa-arrow-circle-right pages-module-scss-module__peInyW__pages-featured-link__icon float-left"></i>
organização didática e técnica</li>
                <li><i class="fa fa-arrow-circle-right pages-module-scss-module__peInyW__pages-featured-link__icon float-left"></i>
respeito às normas e boas práticas do setor</li>
                <li><i class="fa fa-arrow-circle-right pages-module-scss-module__peInyW__pages-featured-link__icon float-left"></i>
compromisso com formação responsável e clara</li>
            </ul>
        </div>
    </section>

    <!-- Seção 4 -->
    <section class="about tnd-section-white">
        <div class="container">
            <div class="about-content">
                <h2 class="section-title">Posicionamento educacional</h2>
                <p>
                    Acreditamos que a formação técnica é construída de forma contínua...
                </p>
                <ul class="about-list">
                    <li>fortalecem a base técnica</li>
                    <li>ampliam a compreensão prática</li>
                    <li>contribuem para a organização profissional</li>
                    <li>auxiliam na diferenciação curricular</li>
                </ul>
                <p>Sempre com clareza sobre o papel educacional de cada curso.</p>
            </div>
        </div>
    </section>

    <!-- Seção 5 -->
    <section class="about tnd-section-gray">
        <div class="container">
            <div class="about-content">
                <h2 class="section-title">Parcerias e relação com instituições</h2>
                <p>
                    A TREINAEND mantém parcerias educacionais com escolas técnicas...
                </p>
            </div>
        </div>
    </section>

    <!-- Seção 6 -->
    <section class="about tnd-section-white">
        <div class="container">
            <div class="about-content">
                <h2 class="section-title">Responsabilidade técnica</h2>
                <p>
                    A TREINAEND foi fundada e é conduzida por profissional com experiência...
                </p>
                <ul class="about-list">
                    <li>alinhamento entre teoria e prática</li>
                    <li>coerência técnica nos conteúdos</li>
                    <li>organização dos processos educacionais</li>
                    <li>compromisso direto com a qualidade da formação</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Seção 7 -->
    <section class="about tnd-section-gray">
        <div class="container">
            <div class="about-content">
                <h2 class="section-title">Compromisso com a clareza</h2>
                <p>Nosso compromisso é atuar com:</p>
                <ul class="about-list">
                    <li>seriedade técnica</li>
                    <li>clareza na comunicação</li>
                    <li>respeito às normas</li>
                    <li>transparência nas propostas</li>
                    <li>responsabilidade na formação profissional</li>
                </ul>
                <p>
                    A TREINAEND existe para contribuir com a formação técnica industrial...
                </p>
            </div>
        </div>
    </section>


    <!-- Call to Action -->
    <section class="comment-section-footer">
        <h3>
            Seja para complementar a formação técnica, fortalecer o currículo profissional...
        </h3>
    </section>
@endsection


@section('page-script')

    <script src="assets-web/js/site/site.js" src=""></script>
@endsection
