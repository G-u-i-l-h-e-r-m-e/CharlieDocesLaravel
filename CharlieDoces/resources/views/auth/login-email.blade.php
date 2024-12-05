<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('img/header/logo.svg') }}" sizes="64x64" type="image/svg">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite([
        'resources/css/app.css',
        'resources/css/login/login.css',
        'resources/css/app.css',
        'resources/css/componentes-style/component-card.css',
        'resources/css/header.css',
        'resources/css/footer.css',
        'resources/css/todos_produtos.css',
        'resources/css/card-produto-todos-produtos.css',
        // JS files
        'resources/js/app.js',
        'resources/js/componentes-produtos/component-card.js',
        'resources/js/carrousel-categoria.js',
        'resources/js/categoria.js',
        'resources/js/header.js',
        'resources/js/login.js',
        'resources/js/produto.js',
        'resources/js/todos_produtos.js',
    ])

</head>
<body>
    <section>
        @include('profile.partials.header', ['categorias' => \App\Models\Categoria::all()]);
    </section>
    <div class="login-container">
        <div class="login-form">
            <h2>Entrar ou Criar Conta</h2>
            <form id="login-form" class="login-form" method="POST" action="{{ route('email') }}">
                @csrf
                <div>
                    <label for="email">Email ou CPF</label>
                    <input type="text" id="email" name="email"
                        placeholder="exemplo@exemplo.com.br ou XXX.XXX.XXX-XX" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <button type="submit">Entrar</button>
                </div>
        </div>
        </form>
    </div>

    <section class="footer">
        @include('profile.partials.footer');
    </section>
</body>

</html>