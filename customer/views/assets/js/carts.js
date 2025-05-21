document.addEventListener('DOMContentLoaded', function () {
    const cartItems = document.querySelectorAll('.cart-item');
    const subtotalEl = document.getElementById('subtotal');
    const shippingEl = document.getElementById('shipping');
    const totalEl = document.getElementById('total');

    // Định dạng tiền Việt Nam
    function formatCurrency(amount) {
        return new Intl.NumberFormat('vi-VN', { maximumFractionDigits: 0 }).format(amount) + '₫';
    }

    // Chuyển chuỗi hoặc số sang số nguyên
    function parseCurrency(str) {
        if (typeof str === 'string') {
            const num = parseInt(str, 10);
            return isNaN(num) ? 0 : num;
        }
        return str || 0;
    }

    function calculateTotal() {
        let subtotal = 0;

        cartItems.forEach(item => {
            const priceInput = item.querySelector('.product-price');
            const price = parseCurrency(priceInput.value);

            const quantityInput = item.querySelector('.quantity-input');
            let quantity = parseInt(quantityInput.value, 10);

            if (isNaN(quantity) || quantity < 1) {
                quantity = 1;
                quantityInput.value = 1;
            }

            const itemTotal = price * quantity;

            const itemTotalEl = item.querySelector('.item-total');
            if (itemTotalEl) {
                itemTotalEl.textContent = formatCurrency(itemTotal);
            }

            subtotal += itemTotal;
        });

        const shipping = shippingEl ? parseCurrency(shippingEl.textContent) : 0;
        const total = subtotal + shipping;

        if (subtotalEl) subtotalEl.textContent = formatCurrency(subtotal);
        if (totalEl) totalEl.textContent = formatCurrency(total);
    }

    cartItems.forEach(item => {
        const quantityInput = item.querySelector('.quantity-input');
        if (quantityInput) {
            quantityInput.addEventListener('input', function () {
                calculateTotal();
            });
        }
    });

    calculateTotal();
});
