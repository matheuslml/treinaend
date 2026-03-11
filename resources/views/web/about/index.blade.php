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
    <section class="tnd-about-section tnd-section-white">
        <div class="tnd-about-content">
            <h2 class="tnd-about-title">Posicionamento educacional</h2>
            <p>
                Acreditamos que a formação técnica é construída de forma contínua. 
                A capacitação complementar não substitui a formação acadêmica ou 
                técnica tradicional, mas atua como um reforço importante, especialmente 
                para estudantes e profissionais em início de carreira.
            </p>
            <p>Sempre com clareza sobre o papel educacional de cada curso</p>
        </div>
        <div class="tnd-about-content">
            <h3>Por isso, a TREINAEND desenvolve cursos que:</h3>
            
            <ul class="about-lists">
                <li><i class="fa fa-arrow-circle-right pages-module-scss-module__peInyW__pages-featured-link__icon float-left"></i>
                    fortalecem a base técnica</li>
                <li><i class="fa fa-arrow-circle-right pages-module-scss-module__peInyW__pages-featured-link__icon float-left"></i>
                    ampliam a compreensão prática</li>
                <li><i class="fa fa-arrow-circle-right pages-module-scss-module__peInyW__pages-featured-link__icon float-left"></i>
                    contribuem para a organização profissional</li>
                <li><i class="fa fa-arrow-circle-right pages-module-scss-module__peInyW__pages-featured-link__icon float-left"></i>
                    auxiliam na diferenciação curricular</li>
            </ul>
        </div>
    </section>

    <!-- Seção 5 -->
    <section class="tnd-about-section tnd-section-white">
        <div class="tnd-about-content">
            <h2 class="tnd-about-title">Parcerias e relação com instituições</h2>
            <p>
                A TREINAEND mantém parcerias educacionais com escolas técnicas e instituições de formação profissional, 
                com o objetivo de incentivar a qualificação técnica e a empregabilidade dos alunos.</p>
            <p class="pt-6">Essas parcerias são estruturadas de forma simples, transparente e institucional, sem custos ou riscos 
                para as instituições parceiras, respeitando a autonomia pedagógica e a identidade de cada escola.</p>
        </div>
        <div class="tnd-about-image">
            <img src="{{ asset('assets-web/img/bg-ombudsman.jpg') }}" alt="Sobre TREINAEND">
        </div>
    </section>

    <!-- Seção 6 -->
    <section class="tnd-about-section tnd-section-gray">
        <div class="tnd-about-content">
            <h2 class="tnd-about-title">Responsabilidade técnica</h2>
            <p>
                A TREINAEND foi fundada e é conduzida por profissional com experiência 
                no setor industrial, que atua como responsável técnico pelos programas de capacitação oferecidos.
            </p>
        </div>
        <div class="tnd-about-content">
            <h3>Esse modelo permite:</h3>
            
            <ul class="about-lists">
                <li><i class="fa fa-arrow-circle-right pages-module-scss-module__peInyW__pages-featured-link__icon float-left"></i>
                    alinhamento entre teoria e prática</li>
                <li><i class="fa fa-arrow-circle-right pages-module-scss-module__peInyW__pages-featured-link__icon float-left"></i>
                    coerência técnica nos conteúdos</li>
                <li><i class="fa fa-arrow-circle-right pages-module-scss-module__peInyW__pages-featured-link__icon float-left"></i>
                    organização dos processos educacionais</li>
                <li><i class="fa fa-arrow-circle-right pages-module-scss-module__peInyW__pages-featured-link__icon float-left"></i>
                    compromisso direto com a qualidade da formação</li>
            </ul>
        </div>
    </section>

    <!-- Seção 7 -->
    <section class="tnd-about-section tnd-section-white">
        <div class="tnd-about-content">
            <h2 class="tnd-about-title">Compromisso com a clareza</h2>
            <p>
                A TREINAEND existe para contribuir com a formação técnica industrial 
                de forma organizada, consciente e alinhada à realidade do mercado.
            </p>
        </div>
        <div class="tnd-about-content">
            <h3>Nosso compromisso é atuar com:</h3>
            
            <ul class="about-lists">
                <li><i class="fa fa-arrow-circle-right pages-module-scss-module__peInyW__pages-featured-link__icon float-left"></i>
                    seriedade técnica</li>
                <li><i class="fa fa-arrow-circle-right pages-module-scss-module__peInyW__pages-featured-link__icon float-left"></i>
                    clareza na comunicação</li>
                <li><i class="fa fa-arrow-circle-right pages-module-scss-module__peInyW__pages-featured-link__icon float-left"></i>
                    respeito às normas</li>
                <li><i class="fa fa-arrow-circle-right pages-module-scss-module__peInyW__pages-featured-link__icon float-left"></i>
                    transparência nas propostas</li>
                <li><i class="fa fa-arrow-circle-right pages-module-scss-module__peInyW__pages-featured-link__icon float-left"></i>
                    responsabilidade na formação profissional</li>
            </ul>
        </div>
    </section>


    <!-- Call to Action -->
    <section class="comment-section-footer">
        <h3>
            Seja para complementar a formação técnica, fortalecer o currículo profissional ou estabelecer parcerias educacionais, 
            a TREINAEND está preparada para atuar com seriedade, clareza e responsabilidade.
        </h3>
    </section>
@endsection


@section('page-script')

    <script src="assets-web/js/site/site.js" src=""></script>
@endsection
