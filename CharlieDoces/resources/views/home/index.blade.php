<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/componentes-style/carousel-natal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/componentes-style/carousel-mais-vendidos.css') }}">
    <link rel="stylesheet" href="/css/produto.css">
    <link rel="stylesheet" href="{{ asset('css/home-style.css') }}">
</head>

<body>

    @include('profile.partials.header', ['categorias' => \App\Models\Categoria::all()])

    @include('profile.partials.banner')

    <section>
        <!-- Incluindo o componente carousel-natal -->
        @include('componentes-produtos.carousel-natal', ['produtosNatal' => $produtosNatal])

        <!-- Paginação -->
        <div class="pagination">
            {{ $produtosNatal->links() }}
        </div>
    </section>

    <section class="teste">
        <!-- Incluindo o componente carousel-chocolate -->
        @include('componentes-produtos.carousel-chocolate', ['produtosChocolate' => $produtosChocolate])

        <!-- Paginação -->
        <div class="pagination">
            {{ $produtosChocolate->links() }}
        </div>
    </section>



    <section class="maisVendidos">
        <!-- Incluindo o componente carousel-mais-vendidos -->
        @include('componentes-produtos.carousel-mais-vendidos', ['produtosMaisVendidos' => $produtosMaisVendidos])
    </section>


    @include('profile.partials.footer')

    <script src="/js/produto.js"></script>
</body>

</html>