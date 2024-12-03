<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos os Produtos</title>
    <link rel="stylesheet" href="/css/produtoListar.css">
    <link rel="stylesheet" href="/css/pagination.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="produtos-page">
    <section>
        @include('profile.partials.header', ['categorias' => \App\Models\Categoria::all()])
    </section>
<section class="orientationMain">
<aside>
    <section class="filtro">
        <h3>Filtrar por Categoria</h3>
        @foreach($categorias as $categoria)
            <label>
                <input type="checkbox" class="categoria-checkbox" data-categoria="{{ $categoria->CATEGORIA_NOME }}">
                {{ $categoria->CATEGORIA_NOME }}
            </label><br>
        @endforeach
    </section>
</aside>

    <main class="produtos-container" id="produtos-lista">

        @foreach($produtos as $produto)
        <section class="card-produto">
            <div class="carousel">
                <div class="carousel-images">
                    @if($produto->produto_imagens && $produto->produto_imagens->isNotEmpty())
                    @foreach($produto->produto_imagens as $imagem)
                    <img class="imagem-produto" src="{{ $imagem->IMAGEM_URL }}" alt="Imagem do Produto">
                    @endforeach
                    @else
                    <p class="imagem-produto">Nenhuma imagem disponível.</p>
                    @endif
                </div>
            </div>
            <p class="categoria-produto">{{ $produto->categoria->CATEGORIA_NOME }}</p>
            <a class="nome-produto" href="/produto/{{ $produto->PRODUTO_ID }}">{{ $produto->PRODUTO_NOME }}</a>
            <div class="orientacao-preco">
                <span class="preco-produto">
                    <span class="preco-final">R${{ $produto->PRODUTO_PRECO - $produto->PRODUTO_DESCONTO }}</span>
                </span>
            </div>
            <div class="qtd-itens">
                <button class="btn-qtd-itens btn-menos">-</button>
                <span class="count-itens">0</span>
                <button class="btn-qtd-itens btn-mais">+</button>
            </div>
            <button class="btn-add-carrinho">
                <a href="/carrinho/{{ $produto->PRODUTO_ID }}">Adicionar ao carrinho</a>
            </button>
        </section>
        @endforeach
    </main>
    </section>
    <section>
    {{ $produtos->links('pagination::bootstrap-4') }}
    </section>

    <section>
        @include('profile.partials.footer')
    </section>
    
    <script>
$(document).ready(function() {
    // Evento de alteração nos checkboxes de categorias
    $('.categoria-checkbox').on('change', function() {
        var categoriasSelecionadas = [];

        // Coleta as categorias selecionadas
        $('.categoria-checkbox:checked').each(function() {
            categoriasSelecionadas.push($(this).data('categoria'));
        });

        // Envia a requisição AJAX para filtrar os produtos
        $.ajax({
            url: '{{ route('produtos.filtrar') }}',  // URL da sua rota
            method: 'GET',  // Requisição GET
            data: {
                categorias: categoriasSelecionadas,  // Dados enviados ao servidor
            },
            success: function(response) {
                // Atualiza a lista de produtos com os dados recebidos
                $('#produtos-lista').html(response);
            },
            error: function(xhr, status, error) {
                console.log("Erro na requisição AJAX:", error);
            }
        });
    });
});
    </script>

    <script src="/js/produto.js"></script>
</body>

</html>
