<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- Cabeçalho da página -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $produto->PRODUTO_NOME }}</title>
    <link rel="stylesheet" href="/css/produtoShow.css">
</head>

<body>

    <!-- Inclui o header -->
    <section>
        @include('profile.partials.header', ['categorias' => \App\Models\Categoria::all()])
    </section>

    <!-- Inclui os breadcrumbs -->
    @include('components.breadcrumbs')

    <main class="detalhesProduto">
        <!-- Detalhes do Produto Atual -->
        <section class="detalhesProdutoInfo">
            <h1>{{ $produto->PRODUTO_NOME }}</h1>
            <p>Categoria: {{ $produto->categoria ? $produto->categoria->CATEGORIA_NOME : 'Categoria não disponível' }}
            </p>

            <div class="orientacao">
                <div class="carousel">
                    <button class="carousel-btn prev">❮</button>
                    <div class="carousel-images">
                        @if($produto->produto_imagens && $produto->produto_imagens->isNotEmpty())
                            @foreach($produto->produto_imagens as $imagem)
                                <img class="imagemProduto" src="{{ $imagem->IMAGEM_URL }}" alt="Imagem do Produto">
                            @endforeach
                        @else
                            <p class="imagemProduto">Nenhuma imagem disponível.</p>
                        @endif
                    </div>
                    <button class="carousel-btn next">❯</button>
                </div>

                <div class="precoDesc">
                    <p><strong>Preço:</strong> R${{ $produto->PRODUTO_PRECO - $produto->PRODUTO_DESCONTO }}</p>
                    <p>{{ $produto->PRODUTO_DESC }}</p>

                    <div class="botaoTamanho">
                        <div class="qtdItens">
                            <button class="btn-qtdItens btnMenos">-</button>
                            <span class="countItens">0</span>
                            <button class="btn-qtdItens btnMais">+</button>
                        </div>
                        <button class="btn-AddCarrinho" type="button">
                            <a href="/carrinho/{{ $produto->PRODUTO_ID }}">Adicionar ao carrinho</a>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Carrossel de Produtos Relacionados -->
        <section class="carouselProdutosRelacionados">
            <h2>Produtos Relacionados</h2>
            <!-- Conteúdo dos produtos relacionados -->
        </section>
    </main>

    <!-- Scripts -->
    <script src="/js/produto.js"></script>
</body>

</html>