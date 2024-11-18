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
</head>

<body>

    @include('profile.partials.header', ['categorias' => \App\Models\Categoria::all()])

    @include('profile.partials.banner')


    @include('componentes-produtos.component-title', ['titulo' => 'Ofertas Imperdíveis', 'subtitulo' => 'Confira as promoções irresistíveis de nossos chocolates e faça a festa!'])

    <div class="home-carousels-container">
        @include('componentes-produtos.carousel-natal', ['produtosNatal' => $produtosNatal])

        <div class="pagination">
            {{ $produtosNatal->links() }}
        </div>
    </div>



    @include('componentes-produtos.component-title', ['titulo' => 'Ofertas Imperdíveis', 'subtitulo' => 'Confira as promoções irresistíveis de nossos chocolates e faça a festa!'])

    <div class="background-carousel-chocolate">
        @include('componentes-produtos.carousel-chocolate', ['produtosChocolate' => $produtosChocolate])

        <div class="pagination">
            {{ $produtosChocolate->links() }}
        </div>
    </div>


    @include('componentes-produtos.component-title', ['titulo' => 'Top Vendas', 'subtitulo' => 'Conheça o pódio de preferidos e experimente as escolhas que fazem sucesso.'])

    <div class="home-carousels-container">
        @include('componentes-produtos.carousel-mais-vendidos', ['produtosMaisVendidos' => $produtosMaisVendidos])
    </div>


    @include('profile.partials.footer')

    <script src="/js/produto.js"></script>
</body>

</html>