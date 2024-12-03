// Remove a declaração de importação
// import axios from 'axios';

// Função para atualizar o contador do carrinho
function updateCartItemCount(totalItems) {
    const cartBadge = document.querySelector('.cart-badge');

    if (cartBadge) {
        cartBadge.textContent = totalItems;
    } else {
        // Se o badge não existe, cria um novo
        const cartLink = document.querySelector('.cart-link');
        if (cartLink) {
            const newBadge = document.createElement('span');
            newBadge.classList.add('cart-badge');
            newBadge.textContent = totalItems;
            cartLink.appendChild(newBadge);
        }
    }
}

document.addEventListener("DOMContentLoaded", function () {
    console.log("component-card.js carregado");

    const axios = window.axios; // Usa a instância global do axios

    // Seleciona todos os botões "Adicionar ao carrinho"
    const addToCartButtons = document.querySelectorAll(".add-to-cart-btn");

    addToCartButtons.forEach(function (button) {
        button.addEventListener("click", function (e) {
            e.preventDefault();

            const cardContainer = this.closest(".card-container");
            const productId = this.getAttribute("data-produto-id");
            const countDisplay = cardContainer.querySelector(".countItens");
            const quantidade = parseInt(countDisplay.textContent) || 1;

            axios.post('/carrinho/adicionar', {
                produto_id: productId,
                quantidade: quantidade,
            })
                .then(response => {
                    // Exibir notificação de sucesso
                    Swal.fire({
                        icon: 'success',
                        title: 'Produto adicionado ao carrinho!',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    // Atualizar o contador do carrinho no header
                    updateCartItemCount(response.data.totalItems);
                })
                .catch(error => {
                    // Exibir notificação de erro
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro ao adicionar ao carrinho',
                        text: 'Por favor, tente novamente.',
                    });
                });
        });
    });

    // Controle de quantidade e outras funcionalidades
    const settingsContainers = document.querySelectorAll(".settings-container");

    settingsContainers.forEach(function (container) {
        const decrementButton = container.querySelector(".buttons-settings:first-child");
        const incrementButton = container.querySelector(".buttons-settings:last-child");
        const countDisplay = container.querySelector(".countItens");
        const cardContainer = container.closest(".card-container");
        const productId = cardContainer.getAttribute("data-product-id");
        const addToCartButton = cardContainer.querySelector(".add-to-cart-btn");
        let quantidade = parseInt(countDisplay.textContent) || 1; // Inicializa com o valor atual

        // Atualiza o contador no display
        countDisplay.textContent = quantidade;

        // Função para bloquear/desbloquear o botão "Adicionar ao Carrinho"
        function toggleAddToCartButton(isAvailable) {
            if (isAvailable && quantidade > 0) {
                addToCartButton.classList.remove("disabled");
                addToCartButton.disabled = false;
                addToCartButton.style.backgroundColor = "#D94A4A";
                addToCartButton.style.border = "none";
                addToCartButton.style.cursor = "pointer";

                // Remover o ícone e mostrar o texto
                const textContainer = addToCartButton.querySelector('.cart-button-text');
                const iconContainer = addToCartButton.querySelector('.cart-button-icon');
                if (textContainer) {
                    textContainer.style.display = 'inline';
                }
                if (iconContainer) {
                    iconContainer.style.display = 'none';
                }
            } else {
                addToCartButton.classList.add("disabled");
                addToCartButton.disabled = true;
                addToCartButton.style.backgroundColor = "transparent";
                addToCartButton.style.border = "1px solid #D94A4A";
                addToCartButton.style.cursor = "not-allowed";

                // Mostrar o ícone e ocultar o texto
                const textContainer = addToCartButton.querySelector('.cart-button-text');
                const iconContainer = addToCartButton.querySelector('.cart-button-icon');
                if (textContainer) {
                    textContainer.style.display = 'none';
                }
                if (iconContainer) {
                    iconContainer.style.display = 'flex';
                }
            }
        }

        // Função para verificar o estoque no backend
        function verificarEstoque(produtoId, quantidade) {
            console.log(`Verificando estoque para produto_id: ${produtoId}, quantidade: ${quantidade}`);
            fetch("/verificar-estoque", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                },
                body: JSON.stringify({ produto_id: produtoId, quantidade: quantidade }),
            })
                .then((response) => {
                    console.log("Resposta recebida:", response);
                    return response.json();
                })
                .then((data) => {
                    console.log("Dados do estoque:", data);
                    toggleAddToCartButton(data.estoqueDisponivel);
                })
                .catch((error) => console.error("Erro ao verificar o estoque:", error));
        }

        // Função para redirecionar ao clicar nas áreas com data-url
        const clickableElements = cardContainer.querySelectorAll('[data-url]');

        clickableElements.forEach(function (element) {
            element.style.cursor = 'pointer';
            element.addEventListener('click', function () {
                window.location.href = element.getAttribute('data-url');
            });
        });

        // Controle do carrossel de imagens
        const carouselImages = cardContainer.querySelectorAll('.carousel-image');
        const carouselIndicators = cardContainer.querySelectorAll('.indicator');

        carouselIndicators.forEach(function (indicator) {
            indicator.addEventListener('click', function (event) {
                event.stopPropagation(); // Impede a propagação do evento para o pai
                const index = parseInt(indicator.getAttribute('data-index'));

                // Remove 'active' de todas as imagens e indicadores
                carouselImages.forEach(img => img.classList.remove('active'));
                carouselIndicators.forEach(ind => ind.classList.remove('active'));

                // Adiciona 'active' à imagem e indicador selecionados
                if (carouselImages[index]) {
                    carouselImages[index].classList.add('active');
                }
                indicator.classList.add('active');
            });
        });

        // Incrementar a quantidade
        incrementButton.addEventListener("click", function () {
            quantidade++;
            countDisplay.textContent = quantidade;

            verificarEstoque(productId, quantidade);
        });

        // Decrementar a quantidade
        decrementButton.addEventListener("click", function () {
            if (quantidade > 1) { // Impede que a quantidade fique abaixo de 1
                quantidade--;
                countDisplay.textContent = quantidade;

                verificarEstoque(productId, quantidade);
            }
        });

        // Inicializa o estado do botão com a quantidade inicial
        verificarEstoque(productId, quantidade);
    });
});
