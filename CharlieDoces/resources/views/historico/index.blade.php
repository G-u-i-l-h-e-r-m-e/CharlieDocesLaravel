<!-- resources/views/historico/index.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Pedidos</title>
    <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>

    @vite([
        'resources/css/historicoPedidos.css',  
        'resources/css/pagination.css',
    ])
</head>
<body>
    <div class="container">
        <h1>Histórico de Pedidos</h1>
        <table>
            <thead>
                <tr>
                    <th>Pedido</th>
                    <th>Data</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Valor total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedidoItems as $item)
                    <tr>
                        <td>{{ $item->Pedido->PEDIDO_ID }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->Pedido->PEDIDO_DATA)->format('d/m/Y') }}</td>
                        <td>{{ $item->Produto->PRODUTO_NOME }}</td>
                        <td>{{ $item->ITEM_QTD }}</td>
                        <td>{{ 'R$ ' . number_format($item->ITEM_QTD * $item->ITEM_PRECO, 2, ',', '.') }}</td>
                        <td>{{ $item->Pedido->Status->STATUS_DESC }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <section>
    {{ $pedidoItems->links('pagination::bootstrap-4') }}
    </section>
</body>
</html>
