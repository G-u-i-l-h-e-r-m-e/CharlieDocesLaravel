<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrossel Chocolate</title>
    <link rel="stylesheet" href="{{ asset('css/componentes-style/carousel-chocolate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/componentes-style/component-card.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <div class="carousel-chocolate-container">
        <div class="tituloHome">
            <h2 class="tituloChocolate">Ofertas Imperdíveis</h2>
            <h2 class="subtituloChocolate">Confira as promoções irresistíveis de nossos chocolates e faça a festa!</h2>
        </div>

        <div class="carousel-chocolate-wrapper">

            <div class="desconto">
                <div class="desconto-content">
                    <div>
                        <p>Desconto de</p>
                    </div>
                    <div class="badge">
                        <i class='bx bxs-badge' style="color: #fedb37;"></i>
                        <span>5%</span>
                    </div>
                </div>

                <div class="desconto-content">
                    <div>
                        <p>Desconto de</p>
                    </div>
                    <div class="badge">
                        <i class='bx bxs-badge'></i>
                        <span>10%</span>
                    </div>
                    
                </div>

                <div class="desconto-content">
                    <div>
                        <p>Desconto de</p>
                    </div>
                    <div class="badge">
                        <i class='bx bxs-badge' style="color: #fedb37;"></i>
                        <span>15%</span>
                    </div>
                </div>
            </div>


            <div class="carousel-chocolate-track">
                @if(isset($produtosChocolate) && $produtosChocolate->isNotEmpty())
                    @foreach ($produtosChocolate as $produto)
                        @include('componentes-produtos.component-card', ['produto' => $produto])
                    @endforeach
                @else
                    <p>Nenhum produto disponível no momento.</p>
                @endif
            </div>
        </div>

    </div>

    <!-- Inclua o JavaScript, se necessário -->
    @vite('resources/js/componentes-produtos/carousel-chocolate.js')


</body>

</html>