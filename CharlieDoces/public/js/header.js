// Input de busca e área de exibição de resultados
const searchInput = document.getElementById('search-input');
const searchResults = document.getElementById('search-results');

// Evento ao digitar no input de busca
searchInput.addEventListener('input', () => {
    const query = searchInput.value;

    // Se o usuário digitou pelo menos 3 caracteres, buscamos os resultados
    if (query.length > 2) {
        // Requisição ao backend (AJAX ou Fetch API)
        fetch(`/search?q=${query}`)
            .then(response => response.json())
            .then(data => {
                // Limpa os resultados anteriores
                searchResults.innerHTML = '';

                // Adiciona os novos resultados
                data.forEach(item => {
                    const resultItem = document.createElement('a');
                    resultItem.href = `/produto/${item.id}`; // Backend: Definir o link correto
                    resultItem.textContent = item.nome; // Backend: Preencher com nome do produto
                    searchResults.appendChild(resultItem);
                });

                // Exibe os resultados
                searchResults.classList.add('show');
            });
    } else {
        // Esconde os resultados se o campo estiver vazio ou com poucos caracteres
        searchResults.classList.remove('show');
    }
});
