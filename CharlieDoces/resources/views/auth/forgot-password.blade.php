<!DOCTYPE html>
<html lang="pt-BR">

@@ -9,9 +9,10 @@
    <link rel="icon" href="{{ asset('img/header/logo.svg') }}" sizes="64x64" type="image/svg">

    <!-- Importando CSS via Vite -->
    @vite(['resources/css/login/forgotPassword.css', 'resources/css/login/login.css', 'resources/css/app.css', 'resources/css/header.css'])

    <!-- Fonte do Google Fonts -->
    <link rel="stylesheet" href="{{ asset('css/login/forgotPassword.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>

@@ -20,30 +21,18 @@
        @include('profile.partials.header', ['categorias' => \App\Models\Categoria::all()])
    </section>
    <div class="forgotpassword-container">
        <form>
            @csrf
            <h2>Esqueceu a senha</h2>
            <label for="email">Forneça o endereço de e-mail da sua conta para receber um e-mail de redefinição de senha</label>
            <input type="email" id="email" name="email" placeholder="exemplo@exemplo.com.br" required>
            <a href="/enviado">
                <button type="button">Enviar</button>
            </a>
        </form>
    </div>
    <section>
        @include('profile.partials.footer');
    </section>
</body>
</html>