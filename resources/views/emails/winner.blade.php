<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Ganaste la Lotery!</title>
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
            background-color: #4caf50;
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
        .content h2 {
            color: #4caf50;
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            background-color: #4caf50;
            color: #ffffff;
            padding: 15px 30px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            margin-top: 20px;
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
            <h1>¡Felicidades, {{ $name }}!</h1>
        </div>
        <div class="content">
            <h2>¡Has ganado la Lotery con el número {{ $number }}!</h2>
            <p>Estamos encantados de informarte que tu número {{ $number }} ha sido el afortunado ganador de la Lotery. Este es un momento emocionante, ¡y queremos celebrarlo contigo!</p>
            <p>Si no realizaste esta acción, puedes ignorar este mensaje.</p>
        </div>
        <div class="footer">
            <p>Lotery &copy; 2024. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
