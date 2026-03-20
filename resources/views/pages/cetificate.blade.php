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
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .content {
            flex: 1;
            display: flex;
            align-items: flex-start; /* texto mais acima */
            justify-content: flex-end; /* força para a direita */
            text-align: right;
        }

        .certificate-text {
            width: 50%;
            margin-left: auto; /* empurra o bloco para a borda direita */
            text-align: right;
            color: #000; /* texto preto */
            font-family: 'Georgia', serif;
            padding: 20mm; /* margem interna igual em todos os lados */
            box-sizing: border-box; /* garante que o padding não estoure a largura */
        }

        .title {
            font-size: 60px; /* maior */
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 10px;
            letter-spacing: 2px;
        }

        .subtitle {
            font-size: 28px; /* menor que o título */
            margin-bottom: 20px;
            font-style: italic;
        }

        .name {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 25px;
            color: #000;
            width: 100%;
        }

        .description {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 20px;
            color: #000;
        }

        .validation {
            font-size: 14px;
            color: #333;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="background">
        <img src="{{ isset($copyright->logo_url) ? public_path('storage/images/copyrights/' . $copyright->logo_url) : public_path('assets-web/img/img_certificate.png') }}" alt="Fundo">
    </div>

    <div class="container">

        <div class="content">
            <div class="certificate-text">
                <h1 class="title">Certificado</h1>
                <h3 class="subtitle">Conferimos a</h3>
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
    </div>
</body>
</html>
