<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $produto->PRODUTO_NOME }}</title>
    <link rel="stylesheet" href="/css/produtoShow.css">
</head>

<body>

    <main class="detalhesProduto">
        <!-- Detalhes do Produto Atual -->
        <section class="detalhesProdutoInfo">
            <h1>{{ $produto->PRODUTO_NOME }}</h1>
            <p>Categoria: {{ $produto->Categoria ? $produto->Categoria->CATEGORIA_NOME : 'Categoria não disponível' }}
            </p>

            <div class="carousel-images">
                @if($produto->produto_imagens && $produto->produto_imagens->isNotEmpty())
                    @foreach($produto->produto_imagens as $imagem)
                        <img src="{{ $imagem->IMAGEM_URL }}" alt="Imagem do Produto">
                    @endforeach
                @else
                    <p>Nenhuma imagem disponível.</p>
                @endif
            </div>

            <p>Preço: R${{ $produto->PRODUTO_PRECO - $produto->PRODUTO_DESCONTO }}</p>
            <p>Descrição: {{ $produto->PRODUTO_DESCRICAO }}</p>

            <button class="btn-AddCarrinho" type="button"><a href="/carrinho/{{$produto->PRODUTO_ID}}">Adicionar ao
                    carrinho</a></button>
        </section>

        <!-- Carrossel de Produtos Relacionados -->
        <section class="carouselProdutosRelacionados">
            <h2>Produtos Relacionados</h2>
            <div class="carousel-cards">
                <button class="carousel-btn-cards prev-card">❮</button>
                <div class="carousel-cards-inner">
                    @foreach($produtosRelacionados as $produtoRelacionado)
                        <section class="cardProduto">
                            <div class="carousel">
                                <div class="carousel-images">
                                    @if($produtoRelacionado->produto_imagens && $produtoRelacionado->produto_imagens->isNotEmpty())
                                        @foreach($produtoRelacionado->produto_imagens as $imagem)
                                            <img src="{{ $imagem->IMAGEM_URL }}" alt="Imagem do Produto">
                                        @endforeach
                                    @else
                                        <p>Nenhuma imagem disponível.</p>
                                    @endif
                                </div>
                            </div>
                            <p class="categoriaProduto">{{ $produtoRelacionado->Categoria->CATEGORIA_NOME }}</p>
                            <a class="nomeProduto"
                                href="/produto/{{ $produtoRelacionado->PRODUTO_ID }}">{{ $produtoRelacionado->PRODUTO_NOME }}</a>
                            <div class="orientacaoPreco">
                                <span class="precoProduto">
                                    <span
                                        class="precoFinal">R${{ $produtoRelacionado->PRODUTO_PRECO - $produtoRelacionado->PRODUTO_DESCONTO }}</span>
                                </span>
                            </div>
                        </section>
                    @endforeach
                </div>
                <button class="carousel-btn-cards next-card">❯</button>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Carrossel de Produtos Relacionados
            const prevButton = document.querySelector('.prev-card');
            const nextButton = document.querySelector('.next-card');
            const carouselInner = document.querySelector('.carousel-cards-inner');
            const carouselItems = document.querySelectorAll('.cardProduto');
            const totalItems = carouselItems.length;
            const itemWidth = carouselItems[0].offsetWidth + 20; // Largura do item + margem
            let currentIndex = 0;

            function moveCarousel() {
                const offset = -(currentIndex * itemWidth);
                carouselInner.style.transform = `translateX(${offset}px)`;
            }

            prevButton.addEventListener('click', function () {
                if (currentIndex > 0) {
                    currentIndex--;
                    moveCarousel();
                }
            });

            nextButton.addEventListener('click', function () {
                if (currentIndex < totalItems - 1) {
                    currentIndex++;
                    moveCarousel();
                }
            });

            // Carrossel de Imagens dentro de cada card de produto
            document.querySelectorAll('.cardProduto').forEach(card => {
                const imagesContainer = card.querySelector('.carousel-images');
                const images = imagesContainer.querySelectorAll('img');
                const prevImageBtn = card.querySelector('.carousel-btn.prev');
                const nextImageBtn = card.querySelector('.carousel-btn.next');
                let imageIndex = 0;

                function updateImageCarousel() {
                    const offset = -(imageIndex * (images[0].offsetWidth + 10));
                    imagesContainer.style.transform = `translateX(${offset}px)`;
                }

                prevImageBtn.addEventListener('click', function () {
                    if (imageIndex > 0) {
                        imageIndex--;
                        updateImageCarousel();
                    }
                });

                nextImageBtn.addEventListener('click', function () {
                    if (imageIndex < images.length - 1) {
                        imageIndex++;
                        updateImageCarousel();
                    }
                });
            });
        });

    </script>

</body>

</html>