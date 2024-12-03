<!-- resources/views/carrinho/carrinho.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Carrinho</title>
    <link rel="stylesheet" href="{{ asset('css/carrinho.css') }}">
    <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/header.css'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <section>
        @include('profile.partials.header', ['categorias' => \App\Models\Categoria::all()])
    </section>

    <div class="container mt-5">
        <!-- Mensagens de Sucesso e Erro -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="carrinho-container">
            <div class="titulo-carrinho">
                <h1>Meu Carrinho</h1>
            </div>

            @if ($items->isEmpty())
                <div class="alert alert-info">
                    Seu carrinho está vazio. <a href="{{ route('produtos.todos') }}">Continue comprando</a>
                </div>
            @else
                        <table class="table table-bordered">
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
                                @foreach ($items as $item)
                                    @if ($item->produto)
                                        <tr>
                                            <td>
                                                <img src="{{ $item->produto->IMAGEM_URL }}" alt="{{ $item->produto->PRODUTO_NOME }}"
                                                    width="50" class="img-thumbnail">
                                                {{ $item->produto->PRODUTO_NOME }}
                                            </td>
                                            <td>
                                                <form action="{{ route('carrinho.atualizar', $item->PRODUTO_ID) }}" method="POST"
                                                    class="form-inline">
                                                    @csrf
                                                    <input type="number" name="ITEM_QTD" value="{{ $item->ITEM_QTD }}" min="1"
                                                        class="form-control mr-2" style="width: 80px;">
                                                    <button type="submit" class="btn btn-primary btn-sm">Atualizar</button>
                                                </form>
                                            </td>
                                            <td>R$
                                                {{ number_format($item->produto->PRODUTO_PRECO - $item->produto->PRODUTO_DESCONTO, 2, ',', '.') }}
                                            </td>
                                            <td>R$
                                                {{ number_format(($item->produto->PRODUTO_PRECO - $item->produto->PRODUTO_DESCONTO) * $item->ITEM_QTD, 2, ',', '.') }}
                                            </td>
                                            <td>
                                                <form action="{{ route('carrinho.remover', $item->PRODUTO_ID) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Tem certeza que deseja remover este item?')">
                                                        Remover
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="5" class="alert alert-warning">
                                                Produto não encontrado. <a href="{{ route('carrinho.exibir') }}">Atualizar Carrinho</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>

                        <div class="carrinho-total d-flex justify-content-between align-items-center">
                            <p><strong>Total: R$
                                    {{ number_format(
                    $items->sum(function ($item) {
                        return ($item->produto->PRODUTO_PRECO - $item->produto->PRODUTO_DESCONTO) * $item->ITEM_QTD;
                    }),
                    2,
                    ',',
                    '.',
                ) }}
                                </strong></p>
                            <!-- Botão que abre o modal -->
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#finalizarCompraModal">
                                Finalizar Compra
                            </button>
                        </div>
            @endif
        </div>

        <section>
            @include('profile.partials.footer')
        </section>

        <!-- Modal -->
        @if (!$items->isEmpty())
                <div class="modal fade" id="finalizarCompraModal" tabindex="-1" role="dialog"
                    aria-labelledby="finalizarCompraModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form action="{{ route('pedido.finalizar') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="finalizarCompraModalLabel">Finalizar Compra</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <!-- Lado Esquerdo: Produtos -->
                                        <div class="col-md-6">
                                            <h5>Seus Produtos</h5>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Produto</th>
                                                        <th>Quantidade</th>
                                                        <th>Preço Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($items as $item)
                                                        @if ($item->produto)
                                                            <tr>
                                                                <td>{{ $item->produto->PRODUTO_NOME }}</td>
                                                                <td>{{ $item->ITEM_QTD }}</td>
                                                                <td>R$
                                                                    {{ number_format(($item->produto->PRODUTO_PRECO - $item->produto->PRODUTO_DESCONTO) * $item->ITEM_QTD, 2, ',', '.') }}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Lado Direito: Resumo do Pedido -->
                                        <div class="col-md-6">
                                            <h5>Resumo do Pedido</h5>
                                            <div class="endereco mb-3">
                                                <h6>Endereço de Entrega</h6>
                                                @php
                                                    $endereco = Auth::user()->endereco;
                                                @endphp
                                                @if ($endereco)
                                                    <p>
                                                        {{ $endereco->ENDERECO_LOGRADOURO }}, {{ $endereco->ENDERECO_NUMERO }}<br>
                                                        {{ $endereco->ENDERECO_COMPLEMENTO }}
                                                    </p>
                                                @else
                                                    <p>Endereço não cadastrado. <a href="{{ route('profile.edit') }}">Cadastrar
                                                            Endereço</a></p>
                                                @endif
                                            </div>
                                            <div class="pagamento mb-3">
                                                <h6>Forma de Pagamento</h6>
                                                <select name="forma_pagamento" class="form-control" required>
                                                    <option value="">Selecione</option>
                                                    <option value="ficticio">Fictício</option>
                                                    <!-- Adicione outras opções conforme necessário -->
                                                </select>
                                            </div>
                                            <div class="total">
                                                <h6><strong>Total: R$
                                                        {{ number_format(
                $items->sum(function ($item) {
                    return ($item->produto->PRODUTO_PRECO - $item->produto->PRODUTO_DESCONTO) * $item->ITEM_QTD;
                }),
                2,
                ',',
                '.',
            ) }}
                                                    </strong></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Concluir Compra</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        @endif

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- Scripts personalizados -->
        <script src="{{ asset('js/AJAX/carrinho.js') }}"></script>
</body>

</html>