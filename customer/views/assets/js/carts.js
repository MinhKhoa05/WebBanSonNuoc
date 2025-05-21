document.addEventListener('DOMContentLoaded', function () {
    // Các phần tử DOM
    const cartItems = document.querySelectorAll('.cart-item');
    const subtotalEl = document.getElementById('subtotal');
    const shippingEl = document.getElementById('shipping');
    const totalEl = document.getElementById('total');

    // Hàm định dạng số thành tiền tệ Việt Nam
    function formatCurrency(amount) {
        return new Intl.NumberFormat('vi-VN', { maximumFractionDigits: 0 }).format(amount) + '₫';
    }

    // Hàm chuyển đổi tiền tệ từ chuỗi sang số
    function parseCurrency(str) {
        if (typeof str === 'string') {
            return parseInt(str.replace(/[^\d]/g, '')) || 0;
        }
        return str || 0;
    }

    // Hàm tính toán tổng tiền
    function calculateTotal() {
        let subtotal = 0;

        cartItems.forEach(item => {
            // Lấy giá từ input ẩn .product-price
            const priceInput = item.querySelector('.product-price');
            const price = parseCurrency(priceInput.value);

            // Lấy số lượng từ input
            const quantityInput = item.querySelector('.quantity-input');
            let quantity = parseInt(quantityInput.value);

            // Đảm bảo số lượng hợp lệ
            if (isNaN(quantity) || quantity < 1) {
                quantity = 1;
                quantityInput.value = 1;
            }

            // Tính tổng cho từng sản phẩm
            const itemTotal = price * quantity;

            // Cập nhật thành tiền cho sản phẩm
            const itemTotalEl = item.querySelector('.item-total');
            if (itemTotalEl) {
                itemTotalEl.textContent = formatCurrency(itemTotal);
            }

            // Cộng vào tổng phụ
            subtotal += itemTotal;
        });

        // Tính phí vận chuyển và tổng cộng
        const shipping = shippingEl ? parseCurrency(shippingEl.textContent) : 0;
        const total = subtotal + shipping;

        // Cập nhật giao diện
        if (subtotalEl) subtotalEl.textContent = formatCurrency(subtotal);
        if (totalEl) totalEl.textContent = formatCurrency(total);
    }

    // Thêm sự kiện cho tất cả các input số lượng
    cartItems.forEach(item => {
        const quantityInput = item.querySelector('.quantity-input');
        if (quantityInput) {
            // Sự kiện 'input' để cập nhật ngay khi người dùng thay đổi giá trị
            quantityInput.addEventListener('input', function () {
                calculateTotal();
            });
        }
    });

    // Tính toán tổng tiền ban đầu khi trang được tải
    calculateTotal();
});