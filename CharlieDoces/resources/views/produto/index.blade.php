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
    @foreach($produtos as $produto)
    <section class="cardProduto">
        <div class="orientacaoIconeDesconto">
            <img class="icon" src="/icon/favorito.svg" alt="" id="favorito">
            <p class="desconto">
                @if(($produto->PRODUTO_DESCONTO / $produto->PRODUTO_PRECO) * 100 == 0)
                @else
                {{ number_format(($produto->PRODUTO_DESCONTO / $produto->PRODUTO_PRECO) * 100, 2, ',', '.') }}% de Desconto
                @endif
            </p>
        </div>
         @if($produto->Produto_imagem->isNotEmpty())
            @foreach($produto->Produto_imagem as $imagem)
                <img class="imagemProduto" src="{{ $imagem->IMAGEM_URL }}" alt="">
            @endforeach
        @else
            <p>Nenhuma imagem disponível.</p>
        @endif
        <p class="categoriaProduto">{{$produto->Categoria->CATEGORIA_NOME}}</p>
        <p class="nomeProduto">{{$produto->PRODUTO_NOME}}</p>
        <div class="orientacaoPreco">
            <div>
            <span class="precoProduto"><s>R${{$produto->PRODUTO_PRECO}}</s></span><span class="precoFinal">R${{$produto->PRODUTO_PRECO - $produto->PRODUTO_DESCONTO}}</span>
            </div>
            <img class="icon" src="/icon/sacola.svg" alt="">
        </div>   
    </section>
    @endforeach
</main>
</body>
</html>


