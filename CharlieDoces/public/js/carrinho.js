document.addEventListener('DOMContentLoaded', function () {
    const decreaseButtons = document.querySelectorAll('.decrease-quantity');
    const increaseButtons = document.querySelectorAll('.increase-quantity');
    const deleteButtons = document.querySelectorAll('.delete-item');

    decreaseButtons.forEach(button => {
        button.addEventListener('click', function () {
            const row = button.closest('tr');
            const quantityElement = row.querySelector('.item-quantity');
            let quantity = parseInt(quantityElement.textContent);

            if (quantity > 1) {
                quantity--;
                quantityElement.textContent = quantity;
                updateTotal(row, quantity);
            }
        });
    });

    increaseButtons.forEach(button => {
        button.addEventListener('click', function () {
            const row = button.closest('tr');
            const quantityElement = row.querySelector('.item-quantity');
            let quantity = parseInt(quantityElement.textContent);

            quantity++;
            quantityElement.textContent = quantity;
            updateTotal(row, quantity);
        });
    });

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const row = button.closest('tr');
            row.remove();
        });
    });

    function updateTotal(row, quantity) {
        const price = parseFloat(row.querySelector('td:nth-child(2)').textContent);
        const totalElement = row.querySelector('.item-total');
        totalElement.textContent = (price * quantity).toFixed(2);
    }
});