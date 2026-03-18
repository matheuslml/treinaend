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
            justify-content: flex-end;
            text-align: center;
        }

        .certificate-text {
            max-width: 60%;
            background: rgba(255, 255, 255, 0.85);
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 8px rgba(0,0,0,0.25);
        }

        h1 {
            font-size: 28px;
            margin-bottom: 15px;
        }

        p {
            font-size: 18px;
            line-height: 1.5;
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

        <!-- Texto central -->
        <div class="content">
            <div class="certificate-text">
                <h1>Certificado</h1>
                <p>
                    Certificamos que <strong>{{ $registration->person->name }}</strong><br>
                    concluiu com êxito sua participação.<br><br>
                    Emitido por {{ $unit->name ?? 'Unidade' }}.
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
