document.addEventListener('DOMContentLoaded', function () {
    // Các phần tử DOM
    const cartItems = document.querySelectorAll('.cart-item');
    const subtotalEl = document.getElementById('subtotal');
    const shippingEl = document.getElementById('shipping');
    const totalEl = document.getElementById('total');

    // Hàm định dạng số thành tiền tệ Việt Nam
    function formatCurrency(amount) {
        return new Intl.NumberFormat('vi-VN').format(amount) + '₫';
    }

    // Hàm chuyển đổi tiền tệ từ chuỗi sang số
    function parseCurrency(str) {
        return parseInt(str.replace(/\D/g, '')) || 0;
    }

    // Hàm tính toán tổng tiền
    function calculateTotal() {
        let subtotal = 0;

        cartItems.forEach(item => {
            const price = parseCurrency(item.querySelector('.product-price').value);
            const quantity = parseInt(item.querySelector('.quantity-input').value);
            const itemTotal = price * quantity;

            // Cập nhật thành tiền cho từng sản phẩm
            item.querySelector('.item-total').textContent = formatCurrency(itemTotal);

            // Cộng dồn vào tổng phụ
            subtotal += itemTotal;
        });

        // Lấy phí vận chuyển
        const shipping = parseCurrency(shippingEl.textContent);

        // Tính tổng cộng
        const total = subtotal + shipping;

        // Cập nhật giao diện
        subtotalEl.textContent = formatCurrency(subtotal);
        totalEl.textContent = formatCurrency(total);
    }

    // Xử lý sự kiện thay đổi số lượng
    function handleQuantityChange(e) {
        const input = e.target;
        let value = parseInt(input.value);

        // Đảm bảo giá trị là số và lớn hơn 0
        if (isNaN(value) || value < 1) {
            input.value = 1;
        }

        // Cập nhật tổng tiền
        calculateTotal();
    }

    // Gắn sự kiện cho các trường nhập liệu số lượng
    cartItems.forEach(item => {
        const quantityInput = item.querySelector('.quantity-input');

        if (quantityInput) {
            quantityInput.addEventListener('change', handleQuantityChange);
        }
    });

    // Tính toán tổng tiền ban đầu
    calculateTotal();
});