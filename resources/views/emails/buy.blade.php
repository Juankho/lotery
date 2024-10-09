<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tus Números Comprados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background-color: #2196F3;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 30px;
        }

        .content p {
            font-size: 16px;
            line-height: 1.6;
            color: #333333;
        }

        .content ul {
            list-style-type: none;
            padding: 0;
        }

        .content ul li {
            background-color: #f0f0f0;
            padding: 10px;
            margin: 5px 0;
            font-size: 18px;
            text-align: center;
            border-radius: 5px;
        }

        .footer {
            background-color: #333333;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>¡Tus Números de la Lotery!</h1>
        </div>
        <div class="content">
            <p>Hola, estos son los números que has comprado:</p>
            <ul>
                @foreach($numbers as $number)
                <li>{{ $number }}</li>
                @endforeach
            </ul>
            <p>¡Mucha suerte en el próximo sorteo! Esperamos que uno de estos números sea el ganador del dia {{ $date }}.</p>
        </div>
        <div class="footer">
            <p>Lotery &copy; 2024. Todos los derechos reservados.</p>
        </div>
    </div>
</body>

</html>