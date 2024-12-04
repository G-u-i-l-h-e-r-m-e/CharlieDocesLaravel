<!-- resources/views/home/index.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- Meta tags e título -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>

    <!-- Incluir os assets compilados pelo Vite -->

@vite([
    'resources/css/login/login.css', 
    'resources/css/app.css',
    'resources/js/app.js',
    'resources/css/home-style.css',
    'resources/css/banner.css',
    'resources/css/componentes-style/carousel-natal.css',
    'resources/css/componentes-style/carousel-chocolate.css',
    'resources/css/componentes-style/carousel-mais-vendidos.css',
    'resources/css/componentes-style/component-card.css',
    'resources/css/componentes-style/content-title.css',
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
    'resources/js/todos_produtos.js',])

    <!-- Outros meta tags e links -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Animate.css se necessário -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body class="home-page">
    <!-- Inclui o header -->
    @include('profile.partials.header', ['categorias' => \App\Models\Categoria::all()])

    <!-- Seção do banner -->
    <div class="home-carousels-banner">
        @include('profile.partials.banner')
    </div>

    <!-- Seção de Ofertas Imperdíveis -->
    <div class="home-carousels-container">
        <div class="home-component-title-01 animate__animated animate__headShake">
            @include('componentes-produtos.component-title', [
    'titulo' => 'NATAL',
    'subtitulo' => 'CONFIRA NOSSAS NOVIDADES',
])
        </div>

        @include('componentes-produtos.carousel-natal', ['produtosNatal' => $produtosNatal])

    </div>

    <!-- Seção de Promoções de Chocolates -->
    <div class="home-carousels-container">
        <div class="home-component-title-02 animate__animated animate__headShake">
            @include('componentes-produtos.component-title', [
    'titulo' => 'Ofertas Imperdíveis',
    'subtitulo' => 'Confira as promoções irresistíveis de nossos chocolates e faça a festa!',
])
        </div>
        <div class="circles-background"></div>

        <div class="background-carousel-chocolate">
            @include('componentes-produtos.carousel-chocolate', ['produtosChocolate' => $produtosChocolate])

            <div class="pagination">
                {{ $produtosChocolate->links() }}
            </div>
        </div>
    </div>

    <!-- Seção Top Vendas -->
    <div class="home-carousels-container">
        <div class="home-component-title-03 animate__animated animate__headShake">
            @include('componentes-produtos.component-title', [
    'titulo' => 'Top Vendas',
    'subtitulo' => 'Conheça o pódio de preferidos e experimente as escolhas que fazem sucesso.',
])
        </div>

        <div class="home-carousels-container">
            @include('componentes-produtos.carousel-mais-vendidos', ['produtosMaisVendidos' => $produtosMaisVendidos])
        </div>
    </div>

    <!-- Inclui o footer -->
    <section>
        @include('profile.partials.footer')
    </section>


    @vite([
    'resources/js/componentes-produtos/component-card.js',
    'resources/js/banner.js',
    'resources/js/componentes-produtos/carousel-natal.js',
    'resources/js/componentes-produtos/carousel-chocolate.js',
])
</body>

</html>