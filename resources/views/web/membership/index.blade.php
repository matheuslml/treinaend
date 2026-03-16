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
            <form class="form form-horizontal" method="POST" action="{{ route('web_store') }}"">
                @csrf()
                <div class="form-group">
                    <label for="course">Cursos</label>
                    <select id="course_id" name="course_id">
                        <option value="">Selecione um curso</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Nome completo</label>
                    <input type="text" id="name" name="name" placeholder="Seu nome">
                </div>

                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" maxlength="14">
                    <small id="cpf-error" style="color:red; display:none;">CPF inválido</small>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="email@exemplo.com">
                    <button type="button" id="togglePassword" 
                            style="position:absolute; right:10px; top:30px; background:none; border:none; cursor:pointer;">
                        👁️
                    </button>
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password" placeholder="Crie uma senha">
                    <small id="passwordError" style="color:red"></small>
                </div>

                <div class="form-group">
                    <label for="password_confirmed">Confirmação de Senha</label>
                    <input type="password" id="password_confirmed" placeholder="Confirme sua senha">
                    <small id="confirmError" style="color:red"></small>
                </div>

                <button type="submit" class="register-button" style="display:none;">Cadastrar</button>
            </form>
        </div>
    </div>
</section>
@endsection


@section('page-script')

    <script src="assets-web/js/site/site.js" src=""></script>
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
    <script>
        function validatePasswords() {
            const password = document.getElementById('password').value;
            const confirm = document.getElementById('password_confirmed').value;
            const passwordError = document.getElementById('passwordError');
            const confirmError = document.getElementById('confirmError');
            const submitButton = document.querySelector('.register-button');

            let errors = [];

            // validações básicas
            if (password.length < 8) {
                errors.push('A senha deve ter pelo menos 8 caracteres.');
            }
            if (!/[a-zA-Z]/.test(password)) {
                errors.push('A senha deve conter pelo menos uma letra.');
            }
            if (!/[0-9]/.test(password)) {
                errors.push('A senha deve conter pelo menos um número.');
            }

            passwordError.innerText = errors.join('\n');

            // valida confirmação
            if (confirm && password !== confirm) {
                confirmError.innerText = 'As senhas não coincidem.';
            } else {
                confirmError.innerText = '';
            }

            // só mostra o botão se não houver erros e senhas iguais
            if (errors.length === 0 && password && confirm && password === confirm) {
                submitButton.style.display = 'inline-block';
            } else {
                submitButton.style.display = 'none';
            }
        }

        // valida em tempo real
        document.getElementById('password').addEventListener('input', validatePasswords);
        document.getElementById('password_confirmed').addEventListener('input', validatePasswords);
    </script>
@endsection
