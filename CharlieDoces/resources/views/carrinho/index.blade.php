<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    <link rel="stylesheet" href="resources/css/carrinho.css">
    <link rel="icon" href="{{ asset('img/header/logo.svg') }}" sizes="64x64" type="image/svg">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <section>
        @include('profile.partials.header', ['categorias' => \App\Models\Categoria::all()])
    </section>

    <!-- Botão Histórico de compras -->
    <div class="botao-historico-container">
        <button class="botao-historico" onclick="window.location.href='/historico_pedidos'">
            Histórico de compras
        </button>
    </div>


    <div class="carrinho-container">
        <table>
            <thead class="header-table">
                <tr>
                    {{-- <th scope="col">Id Produto</th> --}}
                    <th scope="col">Produto</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr data-item-id="{{ $item->id }}">
                        {{-- <td>{{ $item->Produto->PRODUTO_ID }}</td> --}}
                        <td>{{ $item->Produto->PRODUTO_NOME }}</td>
                        <td>{{ 'R$ ' . number_format($item->Produto->PRODUTO_PRECO, 2, ',', '.') }}</td>
                        <td class="campo-quantidade">
                            <form
                                action="{{ route('carrinho.delQuantidadeItens', ['produto' => $item->Produto->PRODUTO_ID]) }}"
                                method="POST">
                                @csrf

                                <input type="submit" value="-">
                            </form>
                            <span class="item-quantity">{{ $item->ITEM_QTD }}</span>
                            <form
                                action="{{ route('carrinho.addQuantidadeItens', ['produto' => $item->Produto->PRODUTO_ID]) }}"
                                method="POST">
                                @csrf

                                <input type="submit" value="+">
                            </form>
                        </td>
                        <td class="item-total">{{ 'R$ ' . number_format($item->Produto->PRODUTO_PRECO * $item->ITEM_QTD, 2, ',', '.') }}</td>
                        <td>
                            <form
                                action="{{ route('carrinho.deleteCarrinho', ['produto' => $item->Produto->PRODUTO_ID]) }}"
                                method="POST">
                                @csrf

                                <button type="submit">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <section>
        @include('profile.partials.footer')
    </section>
    {{-- <script src="/js/carrinho.js"></script> --}}
</body>

</html>
