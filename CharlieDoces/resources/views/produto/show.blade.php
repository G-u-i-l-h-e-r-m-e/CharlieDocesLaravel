<h1>{{ $produto->PRODUTO_NOME }} - {{ $produto->PRODUTO_PRECO }}</h1>
<p>{{ $produto->PRODUTO_DESC }}</p>

<a href="/carrinho/{{$produto->PRODUTO_ID}}">Enviar para o carrinho</a>