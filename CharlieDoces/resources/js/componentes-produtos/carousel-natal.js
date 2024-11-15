// resources/js/componentes-produtos/carousel-natal.js

document.addEventListener('DOMContentLoaded', function () {
    const track = document.querySelector('.carousel-natal-track');
    const prevButton = document.querySelector('.carouselNatal-button.left'); // Botão para ir à esquerda
    const nextButton = document.querySelector('.carouselNatal-button.right'); // Botão para ir à direita
    const cards = track.querySelectorAll('.card-container');

    console.log('Track:', track);
    console.log('Prev Button:', prevButton);
    console.log('Next Button:', nextButton);
    console.log('Cards:', cards.length);

    // Certifique-se de que temos track e cards
    if (!track || !cards || cards.length === 0) {
        console.warn('Carrossel sem elementos para exibir.');
        return;
    }

    // Calcular a largura de um card + gap
    const gap = parseInt(getComputedStyle(track).gap) || 161; // Pegue o gap do CSS
    const cardWidth = cards[0]?.offsetWidth + gap;
    console.log('Card Width:', cardWidth);

    // Verificar se há mais de 3 cards
    if (cards.length <= 3) {
        if (prevButton) prevButton.style.display = 'none'; // Esconde o botão "Esquerda" se não necessário
        if (nextButton) nextButton.style.display = 'none'; // Esconde o botão "Direita" se não necessário
        console.log('Menos ou igual a 3 cards, botões escondidos.');
        return; // Sem movimento necessário
    } else {
        if (prevButton) prevButton.style.display = 'flex'; // Exibe o botão "Esquerda"
        if (nextButton) nextButton.style.display = 'flex'; // Exibe o botão "Direita"
        console.log('Mais de 3 cards, botões exibidos.');
    }

    // Movimento inicial
    let currentPosition = 0;

    // Botão Próximo
    if (nextButton) {
        nextButton.addEventListener('click', () => {
            if (currentPosition < (cards.length - 3) * cardWidth) { // Limitar a quantidade
                currentPosition += cardWidth;
                track.style.transform = `translateX(-${currentPosition}px)`;
                console.log('Moved to position:', currentPosition);
            }
        });
    }

    // Botão Anterior
    if (prevButton) {
        prevButton.addEventListener('click', () => {
            if (currentPosition > 0) {
                currentPosition -= cardWidth;
                track.style.transform = `translateX(-${currentPosition}px)`;
                console.log('Moved to position:', currentPosition);
            }
        });
    }
});
