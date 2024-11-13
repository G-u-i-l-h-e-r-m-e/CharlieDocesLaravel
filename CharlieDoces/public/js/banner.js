const banners = document.querySelectorAll('.carousel-item');
const indicators = document.querySelectorAll('.indicator');
const leftButton = document.querySelector('.carousel-button.left');
const rightButton = document.querySelector('.carousel-button.right');
let currentIndex = 0;

// Função para exibir o banner atual
function showBanner(index) {
    banners.forEach((banner, i) => {
        banner.classList.toggle('active', i === index);
        indicators[i].classList.toggle('active', i === index);
    });
}

// Função para avançar para o próximo banner
function nextBanner() {
    currentIndex = (currentIndex + 1) % banners.length;
    showBanner(currentIndex);
}

// Função para voltar para o banner anterior
function prevBanner() {
    currentIndex = (currentIndex - 1 + banners.length) % banners.length;
    showBanner(currentIndex);
}

// Muda de banner a cada 30 segundos
setInterval(nextBanner, 30000); // Muda de banner a cada 30 segundos

// Permite que o usuário navegue pelos indicadores
indicators.forEach((indicator, index) => {
    indicator.addEventListener('click', () => {
        currentIndex = index;
        showBanner(currentIndex);
    });
});

// Event listener para o botão da esquerda (anterior)
leftButton.addEventListener('click', prevBanner);

// Event listener para o botão da direita (próximo)
rightButton.addEventListener('click', nextBanner);

