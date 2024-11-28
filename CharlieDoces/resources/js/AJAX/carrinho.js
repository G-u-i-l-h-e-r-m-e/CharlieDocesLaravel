$(document).ready(function() {
    $('.item-quantity').on('change', function() {
        var produtoId = $(this).data('produto-id');
        var quantidade = $(this).val();
        var token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '{{ route("carrinho.updateQuantidadeItens", ":produtoId") }}'.replace(':produtoId', produtoId),
            type: 'PATCH',
            data: {
                _token: token,
                ITEM_QTD: quantidade
            },
            success: function(response) {
                $('#total-' + produtoId).text(response.novoTotal);
                $('#subtotal').text(response.subtotal);
                $('#total').text(response.total);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    $('.btn-remover').on('click', function() {
        var produtoId = $(this).data('produto-id');
        var token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '{{ route("carrinho.deleteCarrinho", ":produtoId") }}'.replace(':produtoId', produtoId),
            type: 'DELETE',
            data: {
                _token: token
            },
            success: function(response) {
                $('#item-' + produtoId).remove();
                $('#subtotal').text(response.subtotal);
                $('#total').text(response.total);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});