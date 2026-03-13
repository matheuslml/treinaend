@extends('layouts.web_base')

@section('page-style')
@endsection

@section('content')
<section class="consult-section">
    <!-- Lado esquerdo com imagem -->
    <div class="consult-image">
        <img src="{{ asset('assets-web/img/bg-ombudsman.jpg') }}" alt="Consulta Profissionais">
    </div>

    <!-- Lado direito com formulário e relatório -->
    <div class="consult-content">
        <h2 class="consult-title">Consulta de Profissionais</h2>
        <p class="consult-description">
            Digite o Código da Matrícula para verificar informações sobre o profissional.
        </p>

        <!-- Formulário -->
        <form class="consult-form" data-url="{{ route('get_registration') }}">
            <div class="form-group">
                <label for="code">Código da Matrícula do Aluno</label>
                <input type="text" id="code" name="code" placeholder="IEQ000000">
            </div>
            <button type="submit" class="consult-button">Consultar</button>
        </form>

        <!-- Relatório -->
        <div class="consult-report">
            <h3>Relatório</h3>
            <p>
                Aqui aparecerão os dados do profissional consultado.  
                Exemplo: Nome, área de atuação, validade do certificado, status.
            </p>
        </div>
    </div>
</section>
@endsection


@section('page-script')
    <script src="assets-web/js/site/site.js" src=""></script>
    <script src="js/scripts/registration/get_registration_code.js" src=""></script>
@endsection
