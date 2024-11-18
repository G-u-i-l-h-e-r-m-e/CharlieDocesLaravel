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
    <main class="background">
        <!-- Cabeçalho com categorias -->
        <section>
            @include('profile.partials.header', ['categorias' => \App\Models\Categoria::all()])
        </section>

        <!-- Carrinho de compras -->
        <section>
            @include('carrinho.carrinho', ['items' => $items])
        </section>
        
        <!-- Banner -->
        <section>
            @include('profile.partials.banner')
        </section>

        <!-- Carrossel de Natal com Paginação -->
        <section>
            @include('componentes-produtos.carousel-natal', ['produtosNatal' => $produtosNatal])
            <div class="pagination">
                {{ $produtosNatal->links() }}
            </div>
        </section>

        <!-- Rodapé -->
        <section>
            @include('profile.partials.footer')
        </section>
    </main>

    <script src="/js/produto.js"></script>
</body>

</html>
