<!-- resources/views/componentes-teste/teste-card.blade.php -->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste do Carrossel Natal</title>
    <link rel="stylesheet" href="{{ asset('css/componentes-style/component-card.css') }}">
    <link rel="stylesheet" href="/css/componentes-style/carousel-natal.css">
    <link rel="stylesheet" href="/css/componentes-style/teste-card.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <h1 style="text-align: center;">Teste do Carrossel Natal</h1>

    @include('componentes-produtos.carousel-natal')

    <!-- Inclua o JavaScript -->
    @vite('resources/js/componentes-produtos/carousel-natal.js')
</body>

</html>