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

// carousel imagens produto
document.querySelectorAll('.cardProduto').forEach(card => {
    const imagesContainer = card.querySelector('.carousel-images');
    const images = imagesContainer.querySelectorAll('.imagemProduto');
    let currentIndex = 0;

    function updateCarousel() {
        const offset = -currentIndex * 100;
        imagesContainer.style.transform = `translateX(${offset}%)`;
    }

    card.querySelector('.next').addEventListener('click', () => {
        if (currentIndex < images.length - 1) {
            currentIndex++;
        } else {
            currentIndex = 0; // Volta para a primeira imagem
        }
        updateCarousel();
    });

    card.querySelector('.prev').addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = images.length - 1; // Vai para a última imagem
        }
        updateCarousel();
    });

    updateCarousel();
});


//carousel cards
const containerInner = document.querySelector('.carousel-cards-inner');
const nextBtn = document.querySelector('.next-card');
const prevBtn = document.querySelector('.prev-card');
const cardWidth = document.querySelector('.cardProduto').offsetWidth;
const cards = document.querySelectorAll('.cardProduto');

// Defina quantos cards deseja mover por clique
const cardsToMove = 3;
let offset = 0;

// Calcula o número de cards visíveis e o total de largura dos cards
const visibleCards = Math.floor(containerInner.parentElement.clientWidth / cardWidth);
const totalCards = cards.length;

// Função para ajustar o offset para o último grupo de cards
function adjustOffset() {
    const maxOffset = (totalCards * cardWidth) - (visibleCards * cardWidth);
    // Garante que o último grupo de cards fique visível por completo
    offset = Math.min(offset, maxOffset);
}

nextBtn.addEventListener('click', () => {
    offset += cardWidth * cardsToMove;
    // Ajusta o offset para não cortar o último grupo de cards
    
    containerInner.style.transform = `translateX(-${offset}px)`;
    adjustOffset();
});

prevBtn.addEventListener('click', () => {
    offset -= cardWidth * cardsToMove;

    // Garante que o offset não seja menor que zero
    offset = Math.max(offset, 0);
    containerInner.style.transform = `translateX(-${offset}px)`;
});
