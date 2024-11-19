<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Carrinho</title>
    <link rel="stylesheet" href="{{ asset('css/carrinho.css') }}">
</head>
<body>

    @include('profile.partials.header', ['categorias' => \App\Models\Categoria::all()])

    <div class="carrinho-container">
        <h1>Meu Carrinho</h1>

        @if($items->isEmpty())
            <p>Seu carrinho está vazio. Continue comprando!</p>
        @else
            <table class="carrinho-tabela">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço Unitário</th>
                        <th>Total</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>
                                <img src="{{ $item->produto->produto_imagens->first()->IMAGEM_URL }}" alt="{{ $item->produto->PRODUTO_NOME }}" width="50">
                                {{ $item->produto->PRODUTO_NOME }}
                            </td>
                            <td>
                                <form action="{{ route('carrinho.atualizar', $item->PRODUTO_ID) }}" method="POST">
                                    @csrf
                                    <input type="number" name="ITEM_QTD" value="{{ $item->ITEM_QTD }}" min="1">
                                    <button type="submit">Atualizar</button>
                                </form>
                            </td>
                            <td>R$ {{ number_format($item->produto->PRODUTO_PRECO - $item->produto->PRODUTO_DESCONTO, 2, ',', '.') }}</td>
                            <td>R$ {{ number_format(($item->produto->PRODUTO_PRECO - $item->produto->PRODUTO_DESCONTO) * $item->ITEM_QTD, 2, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('carrinho.remover', $item->PRODUTO_ID) }}" method="POST">
                                    @csrf
                                    <button type="submit">Remover</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="carrinho-total">
                <p>Total: R$ {{ number_format($items->sum(function($item) {
                    return ($item->produto->PRODUTO_PRECO - $item->produto->PRODUTO_DESCONTO) * $item->ITEM_QTD;
                }), 2, ',', '.') }}</p>
                <button class="botao-finalizar">Confirmar Pedido</button>
            </div>
        @endif
    </div>

    @include('profile.partials.footer')

</body>
</html>
