<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Certificado</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Times New Roman', serif;
            width: 297mm;
            height: 210mm;
            position: relative;
        }

        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 297mm;
            height: 210mm;
        }

        .background img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .container {
            position: absolute;
            top: 0;
            left: 0;
            width: 297mm;
            height: 210mm;
            padding: 30mm;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .header, .footer {
            display: flex;
            justify-content: flex-start;
        }

        .header img, .footer img {
            height: 70px;
        }

        .content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: flex-end; /* força o bloco para a direita */
            text-align: center;
            padding-right: 30mm; /* margem elegante à direita */
        }

        .certificate-text {
            width: 50%; /* ocupa metade direita */
            text-align: center;
            color: #fff; /* texto branco */
            font-family: 'Georgia', serif;
        }

        .title {
            font-size: 42px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 20px;
            letter-spacing: 2px;
        }

        .subtitle {
            font-size: 24px;
            margin-bottom: 10px;
            font-style: italic;
        }

        .name {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 25px;
            color: #fff; /* mantém branco */
        }

        .description {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 20px;
            color: #fff;
        }

        .validation {
            font-size: 14px;
            color: #ddd; /* tom mais suave para rodapé */
            margin-top: 30px;
        }


    </style>
</head>
<body>
    <!-- Fundo fixo -->
    <div class="background">
        <img src="{{ public_path('assets-web/img/bg-ombudsman.jpg') }}" alt="Fundo">
    </div>

    <div class="container">
        <!-- Logo topo -->
        <div class="header">
            <img src="{{ isset($copyright->logo_url) ? public_path('storage/images/copyrights/' . $copyright->logo_url) : '' }}" alt="Logo">
        </div>

        <div class="content">
            <div class="certificate-text">
                <h1 class="title">Certificado</h1>
                <h2 class="subtitle">Conferimos a</h2>
                <h2 class="name">{{ $registration->person->name }}</h2>
                <p class="description">
                    O presente certificado pela conclusão do curso de<br>
                    <strong>Inspeção de Equipamentos</strong><br>
                    Promovido pela <strong>TREINAEND</strong><br>
                    Treinamentos e cursos industriais Ltda<br>
                    de acordo com a Portaria 537/2015 do INMETRO.
                </p>
                <p class="validation">
                    Consulte a veracidade da qualificação do aluno no site<br>
                    <strong>www.treinaend.com.br</strong>, no menu "Consulta de Profissionais".
                </p>
            </div>
        </div>



        <!-- Logo rodapé -->
        <div class="footer">
            <img src="{{ isset($copyright->logo_url) ? public_path('storage/images/copyrights/' . $copyright->logo_url) : '' }}" alt="Logo">
        </div>
    </div>
</body>
</html>
