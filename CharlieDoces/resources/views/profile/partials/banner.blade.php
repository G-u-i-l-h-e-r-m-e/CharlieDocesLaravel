<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banner</title>
    <link rel="stylesheet" href="{{ asset('css/banner.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body>
<section class="carousel-container">
<div class="carousel-banner">
    <div class="carousel-item active">
        <h2 class="carousel-subtitle title-natal animate__animated animate__fadeInDown">O Natal já começou na Charlie Doces</h2>
        <div class="carousel-products">
            <!-- Produto 1 (ID 278) -->
            <div class="product-circle">
                <img src="https://lojabauducco.vteximg.com.br/arquivos/ids/159337-1000-1000/panettone-bauducco-908g-7891962067919_1.jpg?v=638634137187930000" alt="Panettone Bauducco 908g">
            </div>
            <!-- Produto 2 (ID 279) -->
            <div class="product-circle">
                <img src="https://lojabauducco.vteximg.com.br/arquivos/ids/158649-1000-1000/panettone-limao-siciliano-e-uvas-bauducco-500g-foto-1.jpg?v=638291918369300000" alt="Panettone Limão Siciliano Bauducco 500g">
            </div>
            <!-- Produto 3 (ID 280) -->
            <div class="product-circle">
                <img src="https://lojabauducco.vteximg.com.br/arquivos/ids/159194-1000-1000/chocottone-maxi-trufa-bauducco-450g-7891962071398_3.jpg?v=638609892484500000" alt="Chocottone Maxi Trufa Bauducco 450g">
            </div>
        </div>
    </div>
</div>

<div class="carousel-item">
    <h2 class="carousel-subtitle title-natal animate__animated animate__fadeInDown">O Natal já começou na Charlie Doces</h2>
    <div class="carousel-products">
        <!-- Produto 1 (ID 281 - Chocolate Ao Leite Nestle) -->
        <div class="product-circle">
            <img src="https://d3gdr9n5lqb5z7.cloudfront.net/fotos/937535-1-20-09-2023-17-53-38-270_mini.jpg" alt="Chocolate Ao Leite Nestle">
        </div>
        <!-- Produto 2 (ID 282 - Chocolate KITKAT) -->
        <div class="product-circle">
            <img src="https://www.nestleatevoce.com.br/media/catalog/product/i/m/image-7891000248768-12342557-1.jpg?auto=webp&format=pjpg&width=1600&height=2000&fit=cover" alt="Chocolate KITKAT">
        </div>
        <!-- Produto 3 (ID 283 - Chocolate ALPINO) -->
        <div class="product-circle">
            <img src="https://www.nestleatevoce.com.br/media/catalog/product/i/m/image-7891000313015-12448721-1.jpg?auto=webp&format=pjpg&width=1600&height=2000&fit=cover" alt="Chocolate ALPINO">
        </div>
    </div>
</div>

        <div class="carousel-item ">
            <h2 class="carousel-subtitle title-produtos animate__animated animate__fadeInDown">Confira os Produtos Mais Vendidos</h2>
            <div class="carousel-products">
    <div class="product-circle"><img src="{{ asset('img/banner/img-banner-3.png') }}" alt="Vendido 1"></div>
    <div class="product-circle"><img src="{{ asset('img/banner/img-banner-3.png') }}" alt="Vendido 2"></div>
    <div class="product-circle"><img src="{{ asset('img/banner/img-banner-3.png') }}" alt="Vendido 3"></div>
</div>

         <!-- Botões de Navegação -->
    </div>
        <button class="carousel-button left">&#10094;</button> <!-- Botão Esquerda -->
        <button class="carousel-button right">&#10095;</button> <!-- Botão Direita -->
    </div>
</section>

<div class="carousel-indicators">
        <span class="indicator active"></span>
        <span class="indicator"></span>
        <span class="indicator"></span>
    </div>

    <script src="{{ asset('js/banner.js') }}"></script>
</body>
</html>
