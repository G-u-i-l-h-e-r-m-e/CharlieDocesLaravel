<!-- resources/views/carrinho/carrinho.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Carrinho</title>
    <link rel="stylesheet" href="{{ asset('css/carrinho.css') }}">
    <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/header.css','resources/css/footer.css','resources/css/carrinho.css','resources/css/pagination.css'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <section>
        @include('profile.partials.header', ['categorias' => \App\Models\Categoria::all()])
    </section>

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

<div class="container">
    <div class="carrinho-container">
        <div class="titulo-carrinho">
            <h1>Meu Carrinho</h1>
        </div>

        <div class="carrinho-vazio">
            @if ($items->isEmpty())
                <p>Seu carrinho está vazio. Continue comprando!</p>
            @else
        </div>
        <table>
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
                    <tr>
                        <td>
                            <img src="{{ $item->produto->produto_imagens->first()->IMAGEM_URL }}"
                                alt="{{ $item->produto->PRODUTO_NOME }}" width="50">
                            {{ $item->produto->PRODUTO_NOME }}
                        </td>
                        <td>
                            <div class="atualizar">
                                <form action="{{ route('carrinho.atualizar', $item->PRODUTO_ID) }}" method="POST">
                                    @csrf
                                    <input style="text-align: center;" type="number" name="ITEM_QTD" value="{{ $item->ITEM_QTD }}" min="1">
                                    <button type="submit" class="btn-refresh">
                                        <img
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAVFJREFUSEvt1D0oRWEcx/HP3WRTFqNFSYwGg0wmUgbJpMhoMchLXsrbZlPKYrBJFgaLwcBiExMmg2K2EOfUuTr3Om/3lu2e5emc83t+3+f5Pf//U/LPT+mf/TUAuQkXiagNU+hDb+R4g2vs4y2LkgeYwS6aU0zeMY3TNEgWYAJH0cQHDOMxeu/ECsaxiO1aAWEsT2jCHmbxlWAyGER3UU9EO5jHGYZyT5K1SFMef6ekRXSPMIZ+XOUAQtPVSLMejBWQOCAurPb8MzG24rJ5eU6FtnoHSZBazP9AkiLK3HJCXCNRmd6hu/p/2hmkHloC4BID2MRyUUBcl1WKW1gIKu4D7XitFbCEDRwgNHuODDowh7DTvzGG46Rqy7sqRiPzloxSnQxWf1hrJ8f1rQgrqQddQc6fwbVxG1x858G3E7zU08kFmreYJC+iYi4ZqgYgN8IfeHU3GfDcU2wAAAAASUVORK5CYII=" />
                                    </button>
                                </form>
                            </div>
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
                                <button type="submit" class="btn-remover">
                                    <img
                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAKBJREFUSEvtlTEOwjAMRV9O0a1S1aHcppfpwg3ohTgISzcEG7egQmo6BKwfgrygZHXs5287ccD5BOf4KMAInICDkcgCTMDZSlQBHkAjVF6BvhTw3BytRJRdlkgFUPY3QHT4tfe74lS6OyBmLqUnEs37xc2rgNqDfQbqFMmH+b8lugPtl1/qDehSH6tEr1U5A0Mm5AIcP61OtTIz49vX3AErpWYoGUsMhGoAAAAASUVORK5CYII=" />
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="carrinho-total">
            <p><strong>Total:</strong> R$
                {{ number_format(
                    $items->sum(function ($item) {
                        return ($item->produto->PRODUTO_PRECO - $item->produto->PRODUTO_DESCONTO) * $item->ITEM_QTD;
                    }),
                    2,
                    ',',
                    '.',
                ) }}
            </p>
            <!-- Botão que abre o modal -->
            <button data-toggle="modal" data-target="#finalizarCompraModal">Finalizar
                Compra</button>
        </div>
        @endif
    </div>
    <div class="orientationPaginacao">
    {{ $items->links('pagination::bootstrap-4') }}
    </div>
</div>
    <section>
        @include('profile.partials.footer')
    </section>

    <!-- Modal -->
    <div class="modal fade" id="finalizarCompraModal" tabindex="-1" role="dialog"
        aria-labelledby="finalizarCompraModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="modalFinalizar" action="{{ route('pedido.finalizar') }}" method="POST">
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
                                            <tr>
                                                <td>{{ $item->produto->PRODUTO_NOME }}</td>
                                                <td>{{ $item->ITEM_QTD }}</td>
                                                <td>R$
                                                    {{ number_format(($item->produto->PRODUTO_PRECO - $item->produto->PRODUTO_DESCONTO) * $item->ITEM_QTD, 2, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Lado Direito: Resumo do Pedido -->
                            <div class="col-md-6">
                                <h5>Resumo do Pedido</h5>
                                <div class="endereco">
                                    <h6><strong>Endereço de Entrega</strong></h6>
                                    @php
                                        $endereco = Auth::user()->endereco;
                                    @endphp
                                    @if ($endereco)
                                        <p>
                                            {{ $endereco->ENDERECO_LOGRADOURO }}, {{ $endereco->ENDERECO_NUMERO }}<br>
                                            {{ $endereco->ENDERECO_COMPLEMENTO }}
                                        </p>
                                    @else
                                        <p>Endereço não cadastrado.</p>
                                    @endif
                                </div>
                                <div class="pagamento">
                                    <h6><strong>Forma de Pagamento</strong></h6>
                                    <select name="forma_pagamento" class="form-control" required>
                                        <option value="ficticio">Fictício</option>
                                    </select>
                                </div>
                                <div class="total">
                                    <h6><strong>Total: R$</strong>
                                        {{ number_format(
                                            $items->sum(function ($item) {
                                                return ($item->produto->PRODUTO_PRECO - $item->produto->PRODUTO_DESCONTO) * $item->ITEM_QTD;
                                            }),
                                            2,
                                            ',',
                                            '.',
                                        ) }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Concluir Compra</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="/resources/js/AJAX/carrinho.js"></script>

    <!-- Scripts necessários -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- Scripts personalizados -->
        <script src="{{ asset('js/AJAX/carrinho.js') }}"></script>
</body>