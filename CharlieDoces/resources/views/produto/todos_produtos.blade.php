<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos os Produtos</title>
    <link rel="stylesheet" href="/css/produtoListar.css">
</head>

<body>
<section>
            @include('profile.partials.header',['categorias' => \App\Models\Categoria::all()]);
        </section>
    <main class="orientacaoCards">
        @foreach($produtos as $produto)
            <section class="cardProduto">
                <div class="carousel">
                    <div class="carousel-images">
                        @if($produto->produto_imagens && $produto->produto_imagens->isNotEmpty())
                            @foreach($produto->produto_imagens as $imagem)
                                <img class="imagemProduto" src="{{ $imagem->IMAGEM_URL }}" alt="Imagem do Produto">
                            @endforeach
                        @else
                            <p class="imagemProduto">Nenhuma imagem disponível.</p>
                        @endif
                    </div>
                </div>
                <p class="categoriaProduto">{{ $produto->categoria->CATEGORIA_NOME }}</p>
                <a class="nomeProduto" href="/produto/{{ $produto->PRODUTO_ID }}">{{ $produto->PRODUTO_NOME }}</a>
                <div class="orientacaoPreco">
                    <span class="precoProduto">
                        <span class="precoFinal">R${{ $produto->PRODUTO_PRECO - $produto->PRODUTO_DESCONTO }}</span>
                    </span>
                </div>
                <div class="qtdItens">
                    <button class="btn-qtdItens btnMenos">-</button>
                    <span class="countItens">0</span>
                    <button class="btn-qtdItens btnMais">+</button>
                </div>
                <button class="btn-AddCarrinho"><a href="/carrinho/{{ $produto->PRODUTO_ID }}">Adicionar ao carrinho</a></button>
            </section>
        @endforeach
    </main>

    <section>
            @include('profile.partials.footer');
        </section>

    <script src="/js/produto.js"></script>
</body>

</html>
