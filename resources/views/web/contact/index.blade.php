@extends('layouts.web_base')

@section('page-style')
@endsection

@section('content')
    <!-- Title Section -->
    <section class="title-section">
        <div class="container">
            <h2>Contato</h2>
            <h3>Fale com a TREINAEND</h3>
        </div>
    </section>

    <!-- Contact Info Section -->
    <section class="tnd-about-section">
        <div class="tnd-about-content">
            <span class="tnd-about-category">Institucional</span>
            <h2 class="tnd-about-title">Estamos prontos para ouvir você</h2>
            <p class="tnd-about-description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Fusce vitae lorem nec sapien tincidunt fermentum. 
                Integer euismod magna vel facilisis cursus, justo nulla 
                posuere libero, vitae tincidunt risus lorem nec erat.
            </p>
            <p class="tnd-about-description">
                Entre em contato conosco para dúvidas, sugestões ou parcerias.
            </p>
        </div>
        <div class="tnd-about-image">
            <img src="{{ asset('assets-web/img/bg-ombudsman.jpg') }}" alt="Contato TREINAEND">
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="tnd-education-section">
        <div class="container">
            <h3 class="tnd-education-title">Envie sua mensagem</h3>

            <form class="contact-form">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" id="name" name="name" placeholder="Seu nome completo">
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="Seu melhor e-mail">
                </div>

                <div class="form-group">
                    <label for="message">Mensagem</label>
                    <textarea id="message" name="message" rows="5" placeholder="Escreva sua mensagem"></textarea>
                </div>

                <button type="submit" class="tnd-about-button">Enviar</button>
            </form>
        </div>
    </section>

    <!-- Contact Details Section -->
    <section class="comment-section-footer">
        <h3>Informações de Contato</h3>
        <h4>Estamos localizados em todo o Brasil</h4>
        <p>
            Endereço: Rua Exemplo, 123 - Arraial do Cabo, RJ<br>
            Telefone: (22) 99999-9999<br>
            E-mail: contato@treinaend.com.br
        </p>
        <div class="social-links">
            <a href="#">FB</a>
            <a href="#">IG</a>
            <a href="#">LI</a>
        </div>
    </section>
@endsection


@section('page-script')

    <script src="assets-web/js/site/site.js" src=""></script>
@endsection
