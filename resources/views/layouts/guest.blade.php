<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login - Perpustakaan Digital</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #123456, #2563a6);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: white;
            width: 90%;
            max-width: 420px;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,.2);
        }

        .login-title {
            text-align: center;
            margin-bottom: 25px;
        }

        .login-title h1 {
            color: #123456;
            margin-bottom: 8px;
        }

        .login-title p {
            color: #777;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-title">
            <h1>📚 Perpustakaan Digital</h1>
            <p>Silakan login untuk masuk ke sistem</p>
        </div>

        {{ $slot }}
    </div>
</body>
</html>