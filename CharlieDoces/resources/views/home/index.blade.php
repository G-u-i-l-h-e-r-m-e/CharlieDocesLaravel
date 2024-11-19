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
    <main class="background">
        <!-- Cabeçalho com categorias -->
        <section>
            @include('profile.partials.header', ['categorias' => \App\Models\Categoria::all()])
        </section>

        <section id="carrinho-dinamico">
            @include('carrinho.carrinho', ['items' => $items])
        </section>

        <section>
            @include('profile.partials.banner')
        </section>

        <section>
            @include('profile.partials.carrousel-categoria')
        </section>

        <!-- Seção de produtos Natal -->
        <div class="home-carousels-container">
            <div class="home-component-title-01">
                @include('componentes-produtos.component-title', ['titulo' => 'Ofertas Imperdíveis', 'subtitulo' => 'CONFIRA NOSSAS NOVIDADES'])
            </div>
            @include('componentes-produtos.carousel-natal', ['produtosNatal' => $produtosNatal])
            <div class="pagination">
                {{ $produtosNatal->links() }}
            </div>
        </div>

        <!-- Seção de produtos de chocolate -->
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

        <!-- Seção de produtos mais vendidos -->
        <div class="home-carousels-container">
            <div class="home-component-title-03">
                @include('componentes-produtos.component-title', ['titulo' => 'Top Vendas', 'subtitulo' => 'Conheça o pódio de preferidos e experimente as escolhas que fazem sucesso.'])
            </div>

            <div class="home-carousels-container">
                @include('componentes-produtos.carousel-mais-vendidos', ['produtosMaisVendidos' => $produtosMaisVendidos])
            </div>
        </div>

        <!-- Rodapé -->
        <section>
            @include('profile.partials.footer')
        </section>
    </main>

    <script src="/js/produto.js"></script>
</body>

</html>
