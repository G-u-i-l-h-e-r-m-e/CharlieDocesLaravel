<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/login/login.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="login-container">
        <div class="login-form">
            <h2>Entrar ou Criar Conta</h2>
            <form id="login-form" class="login-form" method="POST" action="{{ route('login') }}">
                @csrf

                <div id="email-section">
                    <label for="email">Email ou CPF</label>
                    <input type="text" id="email" name="email" placeholder="exemplo@exemplo.com.br" required>
                    @error('email')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div id="password-section">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password" placeholder="*********" required>
                    @error('password')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <button type="submit">Entrar</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
