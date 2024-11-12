<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="/css/produto.css">
</head>

<body>

    <main class="orientacaoCards">
        <div class="carousel-cards">
            <button class="carousel-btn-cards prev-card">❮</button>
            <div class="carousel-cards-inner">
                @foreach($produtos as $produto)
                    <section class="cardProduto">
                        <div class="carousel">
                            <button class="carousel-btn prev">❮</button>
                            <div class="carousel-images">
                                @if($produto->produto_imagens && $produto->produto_imagens->isNotEmpty())
                                    @foreach($produto->produto_imagens as $imagem)
                                        <img class="imagemProduto" src="{{ $imagem->IMAGEM_URL }}" alt="Imagem do Produto">
                                    @endforeach
                                @else
                                    <p class="imagemProduto">Nenhuma imagem disponível.</p>
                                @endif
                            </div>
                            <button class="carousel-btn next">❯</button>
                        </div>
                        <p class="categoriaProduto">{{ $produto->categoria->CATEGORIA_NOME }}</p>
                        <a class="nomeProduto" href="/produto/{{ $produto->PRODUTO_ID }}">{{ $produto->PRODUTO_NOME }} - {{ $produto->PRODUTO_ID }}</a>
                        <div class="orientacaoPreco">
                            <div>
                                <span class="precoProduto">
                                    <span class="precoFinal">R${{ $produto->PRODUTO_PRECO - $produto->PRODUTO_DESCONTO }}</span>
                                </span>
                            </div>
                        </div>
                        <div class="qtdItens">
                            <button class="btn-qtdItens btnMenos">-</button>
                            <span class="countItens">0</span>
                            <button class="btn-qtdItens btnMais">+</button>
                        </div>
                        <button class="btn-AddCarrinho" type="submit"><a href="/carrinho/{{ $produto->PRODUTO_ID }}">Adicionar ao carrinho</a></button>
                    </section>
                @endforeach
            </div>
            <button class="carousel-btn-cards next-card">❯</button>
        </div>
    </main>

    <script src="/js/produto.js"></script>
</body>

</html>
