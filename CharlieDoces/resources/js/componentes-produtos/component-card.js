document.addEventListener("DOMContentLoaded", function () {
    console.log("component-card.js carregado");

    const settingsContainers = document.querySelectorAll(".settings-container");

    settingsContainers.forEach(function (container) {
        const decrementButton = container.querySelector(".buttons-settings:first-child");
        const incrementButton = container.querySelector(".buttons-settings:last-child");
        const countDisplay = container.querySelector(".countItens");
        const cardContainer = container.closest(".card-container");
        const addToCartButton = cardContainer.querySelector(".add-cart");
        const productId = cardContainer.getAttribute("data-product-id");
        let quantidade = 1; // Inicializa com 1

        // Atualiza o contador no display
        countDisplay.textContent = quantidade;

        // Função para bloquear/desbloquear o botão "Adicionar ao Carrinho"
        function toggleAddToCartButton(isAvailable) {
            if (isAvailable && quantidade > 0) {
                addToCartButton.classList.remove("disabled");
                addToCartButton.innerHTML = `<a href="/carrinho/${productId}?quantidade=${quantidade}">Adicionar ao carrinho</a>`;
                addToCartButton.style.backgroundColor = "#D94A4A";
                addToCartButton.style.border = "none";
                addToCartButton.style.cursor = "pointer";
            } else {
                addToCartButton.classList.add("disabled");
                addToCartButton.innerHTML = `<box-icon name='block' color='#d94a4a'></box-icon>`;
                addToCartButton.style.backgroundColor = "transparent";
                addToCartButton.style.border = "1px solid #D94A4A";
                addToCartButton.style.cursor = "not-allowed";
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

        clickableElements.forEach(function(element) {
            element.style.cursor = 'pointer';
            element.addEventListener('click', function() {
                window.location.href = element.getAttribute('data-url');
            });
        });

        // Função para controlar o carrossel de imagens
        const carouselImages = cardContainer.querySelectorAll('.carousel-image');
        const carouselIndicators = cardContainer.querySelectorAll('.indicator');

        carouselIndicators.forEach(function(indicator) {
            indicator.addEventListener('click', function(event) {
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
