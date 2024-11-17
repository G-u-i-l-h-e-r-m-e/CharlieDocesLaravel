document.addEventListener('DOMContentLoaded', function () {
    const track = document.querySelector('.carousel-chocolate-track');
    const cards = track.querySelectorAll('.card-container');

    // Verificar se os elementos foram encontrados
    console.log('Track:', track);
    console.log('Cards:', cards.length);

    // Configuração inicial (neste caso, sem navegação, apenas exibição)
    if (cards.length === 3) {
        console.log('Exibindo exatamente 3 produtos');
    } else {
        console.warn('Quantidade inesperada de produtos:', cards.length);
    }

    // Lógica adicional pode ser adicionada aqui, se necessário
});
