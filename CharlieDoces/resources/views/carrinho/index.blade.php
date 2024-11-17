<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    <link rel="stylesheet" href="css/carrinho.css">
    <link rel="icon" href="{{ asset('img/header/logo.svg') }}" sizes="64x64" type="image/svg">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <section>
        @include('profile.partials.header', ['categorias' => \App\Models\Categoria::all()])
    </section>
    <div class="carrinho-container">
        <table>
            <thead class="header-table">
                <tr>
                    <th scope="col">Produto</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Total</th>
                    <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr data-item-id="{{ $item->id }}">
                    <td>{{ $item->Produto->PRODUTO_NOME }}</td>
                    <td>{{ $item->Produto->PRODUTO_PRECO }}</td>
                    <td class="campo-quantidade">
                        <button class="decrease-quantity">-</button>
                        <span class="item-quantity">{{ $item->ITEM_QTD }}</span>
                        <button class="increase-quantity">+</button>
                    </td>
                    <td class="item-total">{{ $item->Produto->PRODUTO_PRECO * $item->ITEM_QTD }}</td>
                    <td><button class="delete-item">Excluir</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <section>
        @include('profile.partials.footer')
    </section>

    <script src="/js/carrinho.js"></script>
</body>

</html>