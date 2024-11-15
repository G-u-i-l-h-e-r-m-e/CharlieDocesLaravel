<!-- resources/views/componentes-produtos/carousel-natal.blade.php -->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrossel Natal</title>
    <link rel="stylesheet" href="{{ asset('css/componentes-style/carousel-natal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/componentes-style/component-card.css') }}">
</head>

<body>

    <div class="carousel-natal-container">
        <div class="tituloHome">
            <h2 class="tituloNatal">Natal</h2>
            <h2 class="subtituloNatal">CONFIRA NOSSAS NOVIDADES</h2>
        </div>
        <div class="carousel-natal-wrapper">
            @if($produtosNatal->count() > 3)
                <button class="carouselNatal-button left">&#10094;</button> <!-- Botão Esquerda -->
            @endif

            <div class="carousel-natal-track">
                @foreach($produtosNatal as $produto)
                    @include('componentes-produtos.component-card', ['produto' => $produto])
                @endforeach
            </div>

            @if($produtosNatal->count() > 3)
                <button class="carouselNatal-button right">&#10095;</button> <!-- Botão Direita -->
            @endif
        </div>
    </div>

    <!-- Inclua o JavaScript -->
    @vite('resources/js/componentes-produtos/carousel-natal.js')

</body>

</html>