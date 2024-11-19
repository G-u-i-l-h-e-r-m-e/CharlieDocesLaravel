<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrinho de Compras</title>
  <link rel="stylesheet" href="/css/carrinho.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
  <div class="cart-overlay"></div>
  <div class="cart-sidebar">
    <div class="cart-header">
      <h2>Minha Sacola</h2>
      <button class="close-btn">×</button>
    </div>

    <div class="cart-items">
    <?php 
      $TotalCarrinho = 0;
    ?>
    @foreach($items as $item)
      <div class="cart-item">
        <img src="{{ $item->Produto->imagemPrincipal->IMAGEM_URL ?? '/img/carrinho/doceGenerico.png' }}" alt="Imagem do produto">
        <div class="cart-item-details">
          <h3>{{ $item->Produto->PRODUTO_NOME }}</h3>
          <p>Quantidade: <span class="item-quantity">{{ $item->ITEM_QTD }}</span></p>
          <p>Valor: R$ {{ $item->Produto->PRODUTO_PRECO }}</p>
          <p>Produto id:{{$item->Produto->PRODUTO_ID}} </p>
        </div>

        <?php
            $produto_valor = $item->Produto->PRODUTO_PRECO * $item->ITEM_QTD;
            $TotalCarrinho += $produto_valor;  // Usar += para acumular o valor
          ?>

       <div class="cart-item-quantity item-quantity" data-produto-id="{{ $item->Produto->PRODUTO_ID }}">
          <button class="btn-remove">-</button>
          <span class="item-quantity">{{ $item->ITEM_QTD }}</span>
          <button class="btn-add">+</button>
        </div>
      </div>
    @endforeach
    </div>
    <div class="cart-summary">
      <p class="total">Total: <span>R$ {{ number_format($TotalCarrinho, 2, ',', '.') }}</span></p>
    </div>

    <div class="cart-actions">
      <button class="continue-btn">Continuar Comprando</button>
      <button class="checkout-btn">Finalizar Pedido</button>
    </div>
  </div>

  <script src="/js/carrinho.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
