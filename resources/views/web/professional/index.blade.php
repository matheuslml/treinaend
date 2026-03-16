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
            Digite o Código da Matrícula e o CPF para verificar informações sobre o profissional.
        </p>

        <!-- Formulário -->
        <form class="consult-form" data-url="{{ route('get_registration') }}">
            <div class="form-group">
                <label for="code">Código da Matrícula do Aluno</label>
                <input type="text" id="code" name="code" placeholder="IEQ000000">
            </div>

            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" maxlength="14">
                <small id="cpf-error" style="color:red; display:none;">CPF inválido</small>
            </div>

            <div class="form-group">
                <label for="courses">Cursos</label>
                <select id="course_id" name="course_id">
                    <option value="">Selecione um curso</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>
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



<script>
    // Função para validar CPF
    function validarCPF(cpf) {
        cpf = cpf.replace(/[^\d]+/g,'');
        if(cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;
        let soma, resto;
        soma = 0;
        for (let i=1; i<=9; i++) soma += parseInt(cpf.substring(i-1, i)) * (11 - i);
        resto = (soma * 10) % 11;
        if ((resto === 10) || (resto === 11)) resto = 0;
        if (resto !== parseInt(cpf.substring(9, 10))) return false;
        soma = 0;
        for (let i=1; i<=10; i++) soma += parseInt(cpf.substring(i-1, i)) * (12 - i);
        resto = (soma * 10) % 11;
        if ((resto === 10) || (resto === 11)) resto = 0;
        if (resto !== parseInt(cpf.substring(10, 11))) return false;
        return true;
    }

    // Máscara automática de CPF
    document.getElementById("cpf").addEventListener("input", function() {
        let value = this.value.replace(/\D/g, "");
        if (value.length > 11) value = value.substring(0, 11);
        value = value.replace(/(\d{3})(\d)/, "$1.$2");
        value = value.replace(/(\d{3})(\d)/, "$1.$2");
        value = value.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
        this.value = value;
    });

    // Validação ao sair do campo
    document.getElementById("cpf").addEventListener("blur", function() {
        const cpf = this.value;
        const errorMsg = document.getElementById("cpf-error");
        if (!validarCPF(cpf)) {
            errorMsg.style.display = "block";
        } else {
            errorMsg.style.display = "none";
        }
    });
</script>
@endsection
