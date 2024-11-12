<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> 

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login/login.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <section>
        @include('profile.partials.header',['categorias' => \App\Models\Categoria::all()]);
    </section>
    <div class="login-container">
        <div class="login-form">
            <h2>Entrar ou Criar Conta</h2>
            <form id="login-form" class="login-form" method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="email">Email ou CPF</label>
                    <input type="text" id="email" name="email" placeholder="exemplo@exemplo.com.br"
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
                    <a href="/forgot-password" class="forgot-password">Esqueceu a senha?</a>
                </div>
                <div>
                    <button type="submit">Entrar</button>
                    <hr>
                </div>
                <div class="register-container">
                    <span>Não tem uma conta?</span>
                </div>
                <div>
                    <a href="/cadastro" class="btn btn-primary">
                        <button type="button">Cadastre-se</button>
                    </a>
                </div>
            </form>
        </div>
    </div>
    </div>
    <section>
        @include('profile.partials.footer');
    </section>
</body>
</html>
