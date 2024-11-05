<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #FFFFFF;
            font-family: Arial, sans-serif;
        }

        .login-container {
            display: flex;
            justify-content: center;
            text-align: start;
            width: 700px;
            height: 700px;
            font-family: 'Poppins', sans-serif;
        }

        .login-container h2 {
            font-size: 32px;
            color: #4A2F25;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .login-container label {
            display: block;
            font-size: 24px;
            color: #4A2F25;
            margin-bottom: 8px;
            text-align: left;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 698px;
            height: 52px;
            padding: 12px;
            font-size: 16px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .password-container {
            position: relative;
        }

        .password-container input[type="password"] {
            padding-right: 40px;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 32px;
            color: #4A2F25;
        }

        .forgot-password {
            display: block;
            font-size: 14px;
            color: #007BFF;
            text-decoration: none;
            margin: 10px 0 20px;
            text-align: right;
        }

        .login-container button {
            width: 100%;
            padding: 12px;
            font-size: 24px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .login-container p {
            font-weight: 400;
            font-size: 16px;
            line-height: 20px;
            color: #BF0B0B;
        }

        .login-container button:hover {
            background-color: #45A049;
        }

        .hidden {
            display: none;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="login-container">
        <form id="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            <h2>Entrar ou Criar Conta</h2>
            <div id="email-section">
                <label for="email">Email ou CPF</label>
                <input type="text" id="email" name="email"
                    placeholder="exemplo@exemplo.com.br ou XXX.XXX.XXX-XX">
                @error('email')
                    <p>{{ $message }}</p>
                @enderror
                <button id="botao" type="submit">Continuar</button>
            </div>
        </form>
    </div>
</body>

</html>
