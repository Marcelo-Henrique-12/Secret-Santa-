<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            text-align: center;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: rgb(43, 168, 189);
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ccc;
            text-align: center;
            color: #888;
        }

        .custon-name {
            color: rgb(255, 255, 255) !important;
            font-weight: bold;
            box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.6);
            background-color: rgb(43, 168, 189) !important;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }

        .custon-name p {
            color: rgb(255, 255, 255) !important;
            text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.6);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Sorteio de Amigo Secreto</h1>
        <p>Olá {{ $participante->nome }},</p>
        <p>Descubra quem é seu amigo secreto para este ano:</p>
        <div class="custon-name">
            <p style="margin: 0; font-size: 20px;">{{ $amigoSecreto->nome }}</p>
        </div>
        <p>Esperamos que você faça um ótimo presente para seu amigo secreto!</p>
        <p>Atenciosamente,<br> Seu Sistema Bonitinho</p>
    </div>

    <div class="footer">
        <p>Este e-mail foi enviado automaticamente. Por favor, não responda.</p>
    </div>
</body>

</html>
