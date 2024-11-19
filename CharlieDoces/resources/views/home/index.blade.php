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

        <section id="carrinho-dinamico">
            @include('carrinho.carrinho', ['items' => $items])
        </section>

        
        <section>
            @include('profile.partials.banner');
        </section>
        
        <section>
            @include('profile.partials.carrousel-categoria');
        </section>
        
        <section>
            <div class="tituloHome">
                <h2>TOP VENDAS</h2>
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
