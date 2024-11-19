<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/historicoPedidos.css">
    <title>Histórico de Pedidos</title>
</head>
<body>
    <section>
        @include('profile.partials.header', ['categorias' => \App\Models\Categoria::all()])
    </section>
    <div class="container">
        <h1>Histórico de Pedidos</h1>
        <table>
            <thead>
                <tr>
                    <th>Pedido</th>
                    <th>Produto</th>
                    <th>Status</th>
                    <th>Quantidade</th>
                    <th>Valor total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedidoItems as $item)
                    <tr>
                        <td>{{ $item->Pedido->PEDIDO_ID }}</td>
                        <td>{{ $item->Produto->PRODUTO_NOME }}</td>
                        <td>{{ $item->Pedido->Status->STATUS_DESC }}</td>
                        <td>{{ $item->ITEM_QTD }}</td>
                        <td>{{ $item->ITEM_QTD * $item->ITEM_PRECO }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <section>
        @include('profile.partials.footer')
    </section>
</body>
</html>