@extends('layouts.web_base')

@section('page-style')
@endsection

@section('content')

<section class="student-register-section">
    <div class="student-register-container">
        <!-- Card Informativo -->
        <div class="student-register-info">
            <img src="{{ asset('assets-web/img/bg-ombudsman.jpg') }}" alt="Informativo TREINAEND">
            <div class="info-overlay">
                <h2>Bem-vindo à TREINAEND</h2>
                <p>
                    Cadastre-se para iniciar sua jornada de capacitação profissional.  
                    Oferecemos cursos alinhados com a realidade da indústria brasileira.
                </p>
            </div>
        </div>

        <!-- Card Formulário -->
        <div class="student-register-form">
            <h3>Cadastro de Aluno</h3>
            <form>
                <div class="form-group">
                    <label for="course">Curso</label>
                    <select id="course" name="course">
                        <option value="">Selecione um curso</option>
                        <option value="curso1">Curso 1</option>
                        <option value="curso2">Curso 2</option>
                        <option value="curso3">Curso 3</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Nome completo</label>
                    <input type="text" id="name" name="name" placeholder="Seu nome">
                </div>

                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00">
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="email@exemplo.com">
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password" placeholder="Crie uma senha">
                </div>

                <button type="submit" class="register-button">Cadastrar</button>
            </form>
        </div>
    </div>
</section>
@endsection


@section('page-script')

    <script src="assets-web/js/site/site.js" src=""></script>
@endsection
