<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrinho de Compras</title>
  <link rel="stylesheet" href="/css/carrinho.css">
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
      <img src="{{ $item->Produto->PRODUTO_NOME }}" alt="Imagem do produto">
      <div class="cart-item-details">
        <h3>{{ $item->Produto->PRODUTO_NOME }}</h3>
        <p>Quantidade: {{ $item->ITEM_QTD }}</p>
        <p>Valor: R$ {{ $item->Produto->PRODUTO_PRECO }}</p>

        <?php
          $produto_valor = $item->Produto->PRODUTO_PRECO * $item->ITEM_QTD;
          $TotalCarrinho += $produto_valor;  // Usar += para acumular o valor
        ?>
      </div>

      <div class="cart-item-quantity">
        <button>-</button>
        <span>{{ $item->ITEM_QTD }}</span>
        <button>+</button>
      </div>

    </div>
  @endforeach
</div>
<div class="cart-summary">
  <!-- <p>Subtotal: <span>R$ {{ number_format($TotalCarrinho, 2, ',', '.') }}</span></p>  Exibe o subtotal formatado -->
  <!-- <p>Descontos: <span>-R$ 9,80</span></p> -->
  <p class="total">Total: <span>R$ {{ number_format($TotalCarrinho - 9.80, 2, ',', '.') }}</span></p> <!-- Total após desconto -->
</div>

    <div class="cart-actions">
      <button class="continue-btn">Continuar Comprando</button>
      <button class="checkout-btn">Finalizar Pedido</button>
    </div>
  </div>

  <script>
  
   const cartSidebar = document.querySelector('.cart-sidebar');
    const cartOverlay = document.querySelector('.cart-overlay');
    const closeButton = document.querySelector('.close-btn');
    const carrinho =document.querySelector('.carrinho')
    const continuarComprando = document.querySelector('.continue-btn');


function openCart() {
  cartSidebar.classList.add('active');
  cartOverlay.classList.add('active');
}

function closeCart() {
  cartSidebar.classList.remove('active');
  cartOverlay.classList.remove('active');
}

// Eventos
  cartOverlay.addEventListener('click', closeCart);
  closeButton.addEventListener('click', closeCart);
  continuarComprando.addEventListener('click', closeCart);


  
  carrinho.addEventListener('click', function(event) {
    event.preventDefault(); // Evita redirecionar
    openCart();
});

  </script> 
</body>
</html>
