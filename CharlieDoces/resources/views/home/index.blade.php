<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/componentes-style/carousel-natal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/componentes-style/carousel-mais-vendidos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/componentes-style/content-title.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    @include('profile.partials.header', ['categorias' => \App\Models\Categoria::all()])

    <div class="home-carousels-banner">
        @include('profile.partials.banner')
    </div>

    <div class="home-carousels-container">

        <div class="home-component-title-01">
            @include('componentes-produtos.component-title', ['titulo' => 'Ofertas Imperdíveis', 'subtitulo' => 'CONFIRA NOSSAS NOVIDADES'])       
        </div>

        @include('componentes-produtos.carousel-natal', ['produtosNatal' => $produtosNatal])

        <div class="pagination">
            {{ $produtosNatal->links() }}
        </div>
    </div>


    <div class="home-carousels-container">
        <div class="home-component-title-02">
            @include('componentes-produtos.component-title', ['titulo' => 'Ofertas Imperdíveis', 'subtitulo' => 'Confira as promoções irresistíveis de nossos chocolates e faça a festa!'])
        </div>

        <div class="circles-background"></div>

        <div class="background-carousel-chocolate">
            @include('componentes-produtos.carousel-chocolate', ['produtosChocolate' => $produtosChocolate])

            <div class="pagination">
                {{ $produtosChocolate->links() }}
            </div>
        </div>
    </div>

    <div class="home-carousels-container">
        <div class="home-component-title-03">
            @include('componentes-produtos.component-title', ['titulo' => 'Top Vendas', 'subtitulo' => 'Conheça o pódio de preferidos e experimente as escolhas que fazem sucesso.'])
        </div>

        <div class="home-carousels-container">
            @include('componentes-produtos.carousel-mais-vendidos', ['produtosMaisVendidos' => $produtosMaisVendidos])
        </div>

    </div>


    @include('profile.partials.footer')

    <script src="/js/produto.js"></script>
</body>

</html>