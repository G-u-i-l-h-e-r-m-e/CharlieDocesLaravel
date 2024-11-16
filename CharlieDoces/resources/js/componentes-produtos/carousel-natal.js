document.addEventListener('DOMContentLoaded', function () {
    const track = document.querySelector('.carousel-natal-track');
    const prevButton = document.querySelector('.carouselNatal-button.left');
    const nextButton = document.querySelector('.carouselNatal-button.right');
    const cards = track.querySelectorAll('.card-container');

    // Verificar se os elementos foram encontrados
    console.log('Track:', track);
    console.log('Prev Button:', prevButton);
    console.log('Next Button:', nextButton);
    console.log('Cards:', cards.length);

    // Se houver 3 ou menos produtos, esconde os botões
    if (cards.length <= 3) {
        if (prevButton) prevButton.style.display = 'none';
        if (nextButton) nextButton.style.display = 'none';
        return;
    }

    // Configuração inicial
    let currentIndex = 0;
    const itemsPerPage = 3;

    // Atualiza a visibilidade dos produtos
    const updateVisibleCards = () => {
        cards.forEach((card, index) => {
            if (index >= currentIndex && index < currentIndex + itemsPerPage) {
                card.style.display = 'block'; // Exibe o card
            } else {
                card.style.display = 'none'; // Esconde o card
            }
        });

        // Desabilita ou habilita os botões dependendo da posição atual
        if (prevButton) {
            prevButton.disabled = currentIndex === 0; // Desabilita botão anterior se no início
        }
        if (nextButton) {
            nextButton.disabled = currentIndex + itemsPerPage >= cards.length; // Desabilita próximo se estiver no final
        }
    };

    // Botão Próximo
    nextButton.addEventListener('click', () => {
        if (currentIndex + itemsPerPage < cards.length) {
            currentIndex += itemsPerPage; // Avança para o próximo grupo de 3 produtos
            updateVisibleCards();
        }
    });

    // Botão Anterior
    prevButton.addEventListener('click', () => {
        if (currentIndex - itemsPerPage >= 0) {
            currentIndex -= itemsPerPage; // Volta para o grupo anterior
            updateVisibleCards();
        }
    });

    // Mostrar os primeiros 3 produtos inicialmente
    updateVisibleCards();
});
