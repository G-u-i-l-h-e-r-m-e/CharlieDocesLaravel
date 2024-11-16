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
            <!-- Botão Esquerda (exibido apenas se há mais de 3 produtos) -->
            @if ($produtosNatal->count() > 3)
                <button class="carouselNatal-button left">&#10094;</button>
            @endif

            <!-- Track para os slides -->
            <div class="carousel-natal-track">
                @php
                    // Divide os produtos em grupos de 3
                    $produtosAgrupados = $produtosNatal->chunk(3);
                @endphp

                @foreach ($produtosAgrupados as $index => $grupo)
                    <div class="carousel-natal-slide" style="display: {{ $index === 0 ? 'flex' : 'none' }};">
                        @foreach ($grupo as $produto)
                            @include('componentes-produtos.component-card', ['produto' => $produto])
                        @endforeach
                    </div>
                @endforeach
            </div>

            <!-- Botão Direita (exibido apenas se há mais de 3 produtos) -->
            @if ($produtosNatal->count() > 3)
                <button class="carouselNatal-button right">&#10095;</button>
            @endif
        </div>
    </div>

    <!-- Inclua o JavaScript -->
    @vite('resources/js/componentes-produtos/carousel-natal.js')

</body>

</html>
