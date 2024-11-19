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
                            <button class="btn-AddCarrinho" type="button"><a href="/carrinho/{{$produto->PRODUTO_ID}}">Adicionar ao
                             carrinho</a></button>
                        </div>
                        </div>
                        
            </div>

            
        </section>

        <!-- Carrossel de Produtos Relacionados -->
        <section class="carouselProdutosRelacionados">
            <h2>Produtos Relacionados</h2>
            
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
           
        });

        document.querySelectorAll('.orientacao').forEach(card => {
    const imagesContainer = card.querySelector('.carousel-images');
    const images = imagesContainer.querySelectorAll('.imagemProduto');
    const nextBtn = card.querySelector('.next');
    const prevBtn = card.querySelector('.prev');
    let currentIndex = 0;

    function updateCarousel() {
        const offset = -currentIndex * 100;
        imagesContainer.style.transform = `translateX(${offset}%)`;
    }

    nextBtn.addEventListener('click', () => {
        if (currentIndex < images.length - 1) {
            currentIndex++;
        } else {
            currentIndex = 0; // Volta para a primeira imagem
        }
        updateCarousel();
    });

    prevBtn.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = images.length - 1; // Vai para a última imagem
        }
        updateCarousel();
    });

    updateCarousel();
});

document.querySelectorAll('.orientacao').forEach(card => {
    let count = 0;
    const countDisplay = card.querySelector('.countItens');
    const btnMais = card.querySelector('.btnMais');
    const btnMenos = card.querySelector('.btnMenos');

    function updateCounter() {
        countDisplay.innerText = count;
    }

    btnMais.addEventListener('click', () => {
        count++;
        updateCounter();
    });

    btnMenos.addEventListener('click', () => {
        if (count > 0) {
            count--;
            updateCounter();
        }
    });
});

    </script>
<script src="/js/produto.js"></script>
</body>

</html>