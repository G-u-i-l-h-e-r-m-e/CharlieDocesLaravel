document.addEventListener('DOMContentLoaded', function () {
    const decreaseButtons = document.querySelectorAll('.decrease-quantity');
    const increaseButtons = document.querySelectorAll('.increase-quantity');
    const deleteButtons = document.querySelectorAll('.delete-item');

    decreaseButtons.forEach(button => {
        button.addEventListener('click', function () {
            const row = button.closest('tr');
            const quantityElement = row.querySelector('.item-quantity');
            let quantity = parseInt(quantityElement.textContent);

            if (quantity > 1) {
                quantity--;
                quantityElement.textContent = quantity;
                updateTotal(row, quantity);
            }
        });
    });

    increaseButtons.forEach(button => {
        button.addEventListener('click', function () {
            const row = button.closest('tr');
            const quantityElement = row.querySelector('.item-quantity');
            let quantity = parseInt(quantityElement.textContent);

            quantity++;
            quantityElement.textContent = quantity;
            updateTotal(row, quantity);
        });
    });

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const row = button.closest('tr');
            row.remove();
        });
    });

    function updateTotal(row, quantity) {
        const price = parseFloat(row.querySelector('td:nth-child(2)').textContent);
        const totalElement = row.querySelector('.item-total');
        totalElement.textContent = (price * quantity).toFixed(2);
    }
});

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.item-quantity').forEach(function(element) {
        element.addEventListener('change', function() {
            var produtoId = this.getAttribute('data-produto-id');
            var quantidade = this.value;
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            var xhr = new XMLHttpRequest();
            xhr.open('PATCH', '{{ route("carrinho.updateQuantidadeItens", ":produtoId") }}'.replace(':produtoId', produtoId), true);
            xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
            xhr.setRequestHeader('X-CSRF-TOKEN', token);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        document.getElementById('total-' + produtoId).textContent = response.novoTotal;
                        document.getElementById('subtotal').textContent = response.subtotal;
                        document.getElementById('total').textContent = response.total;
                    } else {
                        console.log(xhr.responseText);
                    }
                }
            };

            xhr.send(JSON.stringify({
                _token: token,
                ITEM_QTD: quantidade
            }));
        });
    });

    document.querySelectorAll('.btn-remover').forEach(function(element) {
        element.addEventListener('click', function() {
            var produtoId = this.getAttribute('data-produto-id');
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            var xhr = new XMLHttpRequest();
            xhr.open('DELETE', '{{ route("carrinho.deleteCarrinho", ":produtoId") }}'.replace(':produtoId', produtoId), true);
            xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
            xhr.setRequestHeader('X-CSRF-TOKEN', token);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        document.getElementById('item-' + produtoId).remove();
                        document.getElementById('subtotal').textContent = response.subtotal;
                        document.getElementById('total').textContent = response.total;
                    } else {
                        console.log(xhr.responseText);
                    }
                }
            };

            xhr.send(JSON.stringify({
                _token: token
            }));
        });
    });
});