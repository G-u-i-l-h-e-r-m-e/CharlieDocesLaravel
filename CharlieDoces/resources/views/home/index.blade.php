<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/componentes-style/carousel-natal.css') }}">
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

    <section>
        <!-- Incluindo o componente carousel-natal -->
        @include('componentes-produtos.carousel-natal', ['produtosNatal' => $produtosNatal])

        <!-- Paginação -->
        <div class="pagination">
            {{ $produtosNatal->links() }}
        </div>
    </section>

    <section>
        <!-- Incluindo o componente carousel-natal -->
        @include('componentes-produtos.carousel-natal', ['produtosNatal' => $produtosNatal])

        <!-- Paginação -->
        <div class="pagination">
            {{ $produtosNatal->links() }}
        </div>
    </section>

    @include('profile.partials.footer')

    <script src="/js/produto.js"></script>
</body>

</html>