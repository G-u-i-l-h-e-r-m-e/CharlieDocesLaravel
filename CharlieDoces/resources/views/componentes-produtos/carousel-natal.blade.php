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

    <div class="carousel-natal-container" data-total-produtos="{{ $produtosNatal->total() }}">

        <div class="carousel-natal-wrapper">
            @if ($produtosNatal->total() > 3)
                <button class="carouselNatal-button left">&#10094;</button>
            @endif

            <div class="carousel-natal-track">
                @php
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

            @if ($produtosNatal->total() > 3)
                <button class="carouselNatal-button right">&#10095;</button>
            @endif
        </div>
    </div>

    @vite('resources/js/componentes-produtos/carousel-natal.js')

</body>

</html>