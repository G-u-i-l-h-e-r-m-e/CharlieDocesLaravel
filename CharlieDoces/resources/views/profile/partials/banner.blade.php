<!-- resources/views/profile/partials/banner.blade.php -->

<section class="carousel-container">
    <div class="carousel-banner">
        <!-- Slide 1 -->
        <div class="carousel-item active">
            <h2 class="carousel-subtitle title-natal animate__animated animate__fadeInDown">
                O Natal já começou na Charlie Doces
            </h2>
            <div class="carousel-products">
                <!-- Produto 1 -->
                <div class="product-circle">
                    <img src="https://lojabauducco.vteximg.com.br/arquivos/ids/159334-800-800/chocottone-bauducco-908g-7891962055312_3.jpg?v=638634131691200000"
                        alt="Panettone Bauducco 908g">
                </div>
                <!-- Produto 2 -->
                <div class="product-circle">
                    <img src="https://lojabauducco.vteximg.com.br/arquivos/ids/158649-1000-1000/panettone-limao-siciliano-e-uvas-bauducco-500g-foto-1.jpg"
                        alt="Panettone Limão Siciliano Bauducco 500g">
                </div>
                <!-- Produto 3 -->
                <div class="product-circle">
                    <img src="https://lojabauducco.vteximg.com.br/arquivos/ids/159194-1000-1000/chocottone-maxi-trufa-bauducco-450g-7891962071398_3.jpg"
                        alt="Chocottone Maxi Trufa Bauducco 450g">
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
            <h2 class="carousel-subtitle title-chocolates animate__animated animate__fadeInDown">
                OS MELHORES CHOCOLATES ESTÃO AQUI
            </h2>
            <div class="carousel-products">
                <!-- Produto 1 -->
                <div class="product-circle">
                    <img src="https://d3gdr9n5lqb5z7.cloudfront.net/fotos/937535-1-20-09-2023-17-53-38-270_mini.jpg"
                        alt="Chocolate Ao Leite Nestle">
                </div>
                <!-- Produto 2 -->
                <div class="product-circle">
                    <img src="https://www.nestleatevoce.com.br/media/catalog/product/i/m/image-7891000248768-12342557-1.jpg"
                        alt="Chocolate KITKAT">
                </div>
                <!-- Produto 3 -->
                <div class="product-circle">
                    <img src="https://www.nestleatevoce.com.br/media/catalog/product/i/m/image-7891000313015-12448721-1.jpg"
                        alt="Chocolate ALPINO">
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item">
            <h2 class="carousel-subtitle title-produtos animate__animated animate__fadeInDown">
                Confira os Produtos Mais Vendidos
            </h2>
            <div class="carousel-products">
                <div class="product-circle">
                    <img src="{{ Vite::asset('resources/img/banner/img-banner-3.png') }}" alt="Vendido 1">
                </div>
                <div class="product-circle">
                    <img src="{{ Vite::asset('resources/img/banner/img-banner-3.png') }}" alt="Vendido 2">
                </div>
                <div class="product-circle">
                    <img src="{{ Vite::asset('resources/img/banner/img-banner-3.png') }}" alt="Vendido 3">
                </div>
            </div>
        </div>

        <!-- Botões de Navegação -->
        <button class="carousel-button left">&#10094;</button>
        <button class="carousel-button right">&#10095;</button>
    </div>

    <!-- Indicadores do Carrossel -->
    <div class="carousel-indicators">
        <span class="indicator active"></span>
        <span class="indicator"></span>
        <span class="indicator"></span>
    </div>
</section>