document.addEventListener('DOMContentLoaded', function () {
    const track = document.querySelector('.carousel-chocolate-track');
    const cards = track.querySelectorAll('.card-container');

    console.log('Track:', track);
    console.log('Cards:', cards.length);


    if (cards.length === 3) {
        console.log('Exibindo exatamente 3 produtos');
    } else {
        console.warn('Quantidade inesperada de produtos:', cards.length);
    }

});
