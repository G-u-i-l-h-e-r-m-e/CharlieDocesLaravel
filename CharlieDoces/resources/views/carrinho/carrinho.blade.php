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
        <p>Quantidade: {{ $item->ITEM_QTD }}</p>
        <p>Valor: R$ {{ $item->Produto->PRODUTO_PRECO }}</p>

        <?php
          $produto_valor = $item->Produto->PRODUTO_PRECO * $item->ITEM_QTD;
          $TotalCarrinho += $produto_valor;  // Usar += para acumular o valor
        ?>
      </div>

      <div class="cart-item-quantity" data-produto-id="{{ $item->Produto->PRODUTO_ID }}">
        <button class="btn-remove">-</button>
        <span class="item-quantity">{{ $item->ITEM_QTD }}</span>
        <button class="btn-add">+</button>
    </div>




    </div>
  @endforeach
</div>
<div class="cart-summary">
  <p class="total">Total: <span>R$ {{ number_format($TotalCarrinho, 2, ',', '.') }}</span></p> <!-- Total após desconto -->
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.querySelectorAll('.btn-add').forEach(button => {
        button.addEventListener('click', function () {
            const container = this.closest('.cart-item-quantity');
            const produtoId = container.getAttribute('data-produto-id');  // Garantir que o ID seja único

            fetch(`/carrinho/${produtoId}/adicionar`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.ITEM_QTD) {
                    container.querySelector('.item-quantity').textContent = data.ITEM_QTD;
                }
            })
            .catch(error => console.error('Erro:', error));
        });
    });

    document.querySelectorAll('.btn-remove').forEach(button => {
        button.addEventListener('click', function () {
            const container = this.closest('.cart-item-quantity');
            const produtoId = container.getAttribute('data-produto-id');  // Garantir que o ID seja único

            fetch(`/carrinho/${produtoId}/remover`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.ITEM_QTD > 0) {
                    container.querySelector('.item-quantity').textContent = data.ITEM_QTD;
                } else {
                    container.parentElement.remove(); // Remove o item do carrinho
                }
            })
            .catch(error => console.error('Erro:', error));
        });
    });
});


</script>

</body>
</html>
