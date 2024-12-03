<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="icon" href="{{ asset('img/header/logo.svg') }}" sizes="64x64" type="image/svg">
    
    @vite(['resources/css/app.css', 'resources/css/header.css', 'resources/css/login/login.css'])
    
    <!-- Fonte do Google Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <header>
        @include('profile.partials.header', ['categorias' => \App\Models\Categoria::all()])
    </header>

    <div class="login-container">
        <div class="login-form">
            <h2>Entrar ou Criar Conta</h2>
            <form id="login-form" class="login-form" method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="email">Email ou CPF</label>
                    <input type="text" id="email" name="email"
                        placeholder="exemplo@exemplo.com.br ou XXX.XXX.XXX-XX"
                        value="{{ old('email') }}" required>
                    
                    @error('email')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password" placeholder="*********" required>
                    
                    @error('password')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <a href="{{ route('password.request') }}" class="forgot-password">Esqueceu a senha?</a>
                </div>
                
                <div>
                    <button type="submit">Entrar</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Importando JS via Vite -->
    @vite(['resources/js/login.js'])
</body>

</html>
