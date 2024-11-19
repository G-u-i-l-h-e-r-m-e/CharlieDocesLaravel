const cartSidebar = document.querySelector('.cart-sidebar');
const cartOverlay = document.querySelector('.cart-overlay');
const closeButton = document.querySelector('.close-btn');
const carrinho = document.querySelector('.carrinho');
const continuarComprando = document.querySelector('.continue-btn');

function openCart() {
  cartSidebar.classList.add('active');
  cartOverlay.classList.add('active');
}

function closeCart() {
  cartSidebar.classList.remove('active');
  cartOverlay.classList.remove('active');
}

// Eventos para fechar o carrinho
cartOverlay.addEventListener('click', closeCart);
closeButton.addEventListener('click', closeCart);
continuarComprando.addEventListener('click', closeCart);

// Evento para abrir o carrinho
carrinho.addEventListener('click', function(event) {
  event.preventDefault(); // Evita redirecionar
  openCart();
});

document.addEventListener('DOMContentLoaded', function () {
  const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  // Adicionar item ao carrinho
  document.querySelectorAll('.btn-add').forEach(button => {
    button.addEventListener('click', function () {
      const container = this.closest('.cart-item');
      const produtoId = container.querySelector('.cart-item-quantity').getAttribute('data-produto-id'); // Alterado aqui

      if (!produtoId) {
        console.error('ID do produto não encontrado!');
        return;
      }

      console.log('Adicionando produto ao carrinho:', produtoId);

      fetch(`/carrinho/${produtoId}/adicionar`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
        },
      })
      .then(response => response.json())
      .then(data => {
        console.log('Resposta do servidor:', data);  // Verifique os dados aqui
        if (data.ITEM_QTD) {
            container.querySelector('.item-quantity').textContent = data.ITEM_QTD;
            updateTotalCarrinho();  // Atualiza o total do carrinho
        }
      })
      .catch(error => console.error('Erro:', error));
    });
  });

  // Remover item do carrinho
  document.querySelectorAll('.btn-remove').forEach(button => {
    button.addEventListener('click', function () {
      const container = this.closest('.cart-item');
      const produtoId = container.querySelector('.cart-item-quantity').getAttribute('data-produto-id'); // Alterado aqui

      if (!produtoId) {
        console.error('ID do produto não encontrado!');
        return;
      }

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
          updateTotalCarrinho();  // Atualiza o total do carrinho
        } else {
          container.remove(); // Remove o item caso a quantidade seja 0
          updateTotalCarrinho();  // Atualiza o total do carrinho
        }
      })
      .catch(error => console.error('Erro:', error));
    });
  });

  // Função para atualizar o total do carrinho
  function updateTotalCarrinho() {
    let total = 0;
    document.querySelectorAll('.cart-item').forEach(item => {
      const price = parseFloat(item.querySelector('.produto-preco').textContent.replace('R$', '').trim().replace(',', '.'));
      const quantity = parseInt(item.querySelector('.item-quantity').textContent);
      total += price * quantity;
    });

    const totalElement = document.querySelector('.total span');
    if (totalElement) {
      totalElement.textContent = total.toFixed(2).replace('.', ',');
    }
  }
});
