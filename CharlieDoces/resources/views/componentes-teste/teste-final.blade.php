<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Final</title>
    <link rel="stylesheet" href="{{ asset('css/componentes-style/component-card.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/temporario/teste-final.css') }}">
    <link rel="stylesheet" href="{{ asset('css/componentes-style/carousel-mais-vendidos.css') }}">
</head>

<body>
    <div class="container">
        <h1>Teste Final</h1>

        <!-- Incluindo o carousel de mais vendidos -->
        @include('componentes-produtos.carousel-mais-vendidos', ['produtosMaisVendidos' => $produtosMaisVendidos])

    </div>

    @vite('resources/js/componentes-produtos/carousel-natal.js')
</body>

</html>
