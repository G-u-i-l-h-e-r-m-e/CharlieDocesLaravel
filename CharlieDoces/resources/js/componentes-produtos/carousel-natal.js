// resources/js/componentes-produtos/carousel-natal.js

document.addEventListener('DOMContentLoaded', function () {
    const track = document.querySelector('.carousel-natal-track');
    const prevButton = document.querySelector('.carouselNatal-button.left');
    const nextButton = document.querySelector('.carouselNatal-button.right');
    const slides = track.querySelectorAll('.carousel-natal-slide');
    const totalSlides = slides.length;
    const totalProdutos = parseInt(document.querySelector('.carousel-natal-container').dataset.totalProdutos, 10);

    // Verificar se os elementos foram encontrados
    console.log('Track:', track);
    console.log('Prev Button:', prevButton);
    console.log('Next Button:', nextButton);
    console.log('Slides:', slides.length);
    console.log('Total Produtos:', totalProdutos);

    // Se o total de produtos for 3 ou menos, esconde os botões
    if (totalProdutos <= 3) {
        if (prevButton) prevButton.style.display = 'none';
        if (nextButton) nextButton.style.display = 'none';
        return;
    }

    // Configuração inicial
    let currentSlideIndex = 0;

    // Atualiza a visibilidade dos slides
    const updateVisibleSlides = () => {
        slides.forEach((slide, index) => {
            if (index === currentSlideIndex) {
                slide.style.display = 'flex'; // Exibe o slide atual
            } else {
                slide.style.display = 'none'; // Esconde os outros slides
            }
        });

        // Desabilita ou habilita os botões dependendo da posição atual
        if (prevButton) {
            prevButton.disabled = currentSlideIndex === 0; // Desabilita botão anterior se no início
        }
        if (nextButton) {
            nextButton.disabled = currentSlideIndex === totalSlides - 1; // Desabilita próximo se estiver no final
        }
    };

    // Botão Próximo
    if (nextButton) {
        nextButton.addEventListener('click', () => {
            if (currentSlideIndex < totalSlides - 1) {
                currentSlideIndex += 1; // Avança para o próximo slide
                updateVisibleSlides();
            }
        });
    }

    // Botão Anterior
    if (prevButton) {
        prevButton.addEventListener('click', () => {
            if (currentSlideIndex > 0) {
                currentSlideIndex -= 1; // Volta para o slide anterior
                updateVisibleSlides();
            }
        });
    }

    // Mostrar o primeiro slide inicialmente
    updateVisibleSlides();
});
