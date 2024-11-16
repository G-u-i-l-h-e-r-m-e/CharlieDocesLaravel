<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/produto.css">
</head>
<body>
    <main class="background">
        <section>
            @include('profile.partials.header',['categorias' => \App\Models\Categoria::all()]);
        </section>

        <section>
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
            @include('produto.index', ['produtos' => $produtos]);
        </section>
        
        <section>
            <div class="tituloHome">
                <h2>OFERTAS IMPERDÍVEIS</h2>
                <h2>Confira as promoções irresistíveis de nossos chocolates e faça a festa!</h2>
            </div>
            @include('categoria.show', ['categoria' => $categoriaChocolate])
        </section>
        
        <section>
            <div class="tituloHome">
                <h2>Confira nossas novidades</h2>
                <h2>{{$categoriaNatal -> CATEGORIA_NOME}}</h2>
            </div>
            @include('categoria.show', ['categoria' => $categoriaNatal])
        </section>
       
       
        <section>
            @include('profile.partials.footer')
        </section>
    </main>
    <script src="/js/produto.js"></script>
</body>
</html>
