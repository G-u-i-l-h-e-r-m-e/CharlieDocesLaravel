// Controle de quantidade de itens no card
document.querySelectorAll('.cardProduto').forEach(card => {
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

// Controle do carousel de imagens dentro de cada card
document.querySelectorAll('.cardProduto').forEach(card => {
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

// Controle do carousel de cards (movimento horizontal entre os cards)
const containerInner = document.querySelector('.carousel-cards-inner');
const nextBtn = document.querySelector('.next-card');
const prevBtn = document.querySelector('.prev-card');
const cardWidth = document.querySelector('.cardProduto').offsetWidth;  // A largura de um card
const cards = document.querySelectorAll('.cardProduto');
let offset = 0;
const cardsToMove = 3;  // Mover 3 cards por clique

// Função para ajustar o número de cards visíveis dinamicamente
const updateVisibleCards = () => {
    const visibleCards = Math.floor(containerInner.parentElement.clientWidth / cardWidth);
    return visibleCards;
}

// Função para ajustar o offset para o último grupo de cards
const adjustOffset = () => {
    const visibleCards = updateVisibleCards();
    const totalCards = cards.length;
    const maxOffset = (totalCards * cardWidth) - (visibleCards * cardWidth);
    offset = Math.min(offset, maxOffset);
}

nextBtn.addEventListener('click', () => {
    offset += cardWidth * cardsToMove;
    adjustOffset();
    containerInner.style.transform = `translateX(-${offset}px)`;
});

prevBtn.addEventListener('click', () => {
    offset -= cardWidth * cardsToMove;
    offset = Math.max(offset, 0);
    containerInner.style.transform = `translateX(-${offset}px)`;
});
