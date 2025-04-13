document.addEventListener('DOMContentLoaded', function() {
    // Các đối tượng global
    const cartItems = document.getElementById('cart-items');
    const subtotalEl = document.getElementById('subtotal');
    const shippingEl = document.getElementById('shipping');
    const totalEl = document.getElementById('total');
    const emptyCartEl = document.getElementById('empty-cart');
    const cartContainerEl = document.getElementById('cart-container');
    const discountInput = document.getElementById('discount-code');
    const applyDiscountBtn = document.getElementById('apply-discount');
    const discountMessageEl = document.getElementById('discount-message');
    const discountRowEl = document.getElementById('discount-row');
    const discountAmountEl = document.getElementById('discount-amount');
    
    // Danh sách mã giảm giá
    const discountCodes = {
        'PAINT10': 10,    // Giảm 10%
        'PAINT20': 20,    // Giảm 20%
        'FREESHIP': 'freeship',  // Miễn phí vận chuyển
        'WELCOME': 100000  // Giảm 100,000đ
    };
    
    // Biến lưu trữ trạng thái
    let state = {
        subtotal: 0,
        shipping: 50000,
        discount: 0,
        discountType: null,
        total: 0
    };
    
    // Format số thành dạng tiền tệ Việt Nam
    function formatCurrency(amount) {
        return new Intl.NumberFormat('vi-VN').format(amount) + 'đ';
    }
    
    // Parse số tiền từ định dạng tiền tệ Việt Nam
    function parseCurrency(str) {
        return parseInt(str.replace(/\D/g, ''));
    }
    
    // Tính tổng tiền của giỏ hàng
    function calculateTotal() {
        const items = cartItems.querySelectorAll('.cart-item');
        let subtotal = 0;
        
        items.forEach(item => {
            const price = parseInt(item.querySelector('.price-current').getAttribute('data-price'));
            const quantity = parseInt(item.querySelector('.quantity-input').value);
            const itemTotal = price * quantity;
            subtotal += itemTotal;
            
            // Cập nhật thành tiền cho từng mục
            item.querySelector('.item-total').textContent = formatCurrency(itemTotal);
        });
        
        // Cập nhật state
        state.subtotal = subtotal;
        
        // Tính giảm giá (nếu có)
        if (state.discountType === 'percentage') {
            state.discount = Math.round(subtotal * state.discountValue / 100);
        } else if (state.discountType === 'fixed') {
            state.discount = state.discountValue;
        } else if (state.discountType === 'freeship') {
            state.discount = state.shipping;
        }
        
        // Tính tổng cộng
        state.total = subtotal + state.shipping - state.discount;
        
        // Cập nhật giao diện
        subtotalEl.textContent = formatCurrency(state.subtotal);
        shippingEl.textContent = formatCurrency(state.shipping);
        
        if (state.discount > 0) {
            discountRowEl.style.display = 'flex';
            discountAmountEl.textContent = `-${formatCurrency(state.discount)}`;
        } else {
            discountRowEl.style.display = 'none';
        }
        
        totalEl.textContent = formatCurrency(state.total);
        
        // Kiểm tra giỏ hàng trống
        if (items.length === 0) {
            emptyCartEl.style.display = 'block';
            cartContainerEl.style.display = 'none';
        } else {
            emptyCartEl.style.display = 'none';
            cartContainerEl.style.display = 'block';
        }
    }
    
    // Xử lý sự kiện tăng số lượng
    function handleIncreaseQuantity(e) {
        const input = e.target.parentNode.querySelector('.quantity-input');
        input.value = parseInt(input.value) + 1;
        calculateTotal();
    }
    
    // Xử lý sự kiện giảm số lượng
    function handleDecreaseQuantity(e) {
        const input = e.target.parentNode.querySelector('.quantity-input');
        const currentValue = parseInt(input.value);
        if (currentValue > 1) {
            input.value = currentValue - 1;
            calculateTotal();
        }
    }
    
    // Xử lý sự kiện thay đổi số lượng bằng input
    function handleQuantityChange(e) {
        const input = e.target;
        let value = parseInt(input.value);
        
        // Đảm bảo giá trị là số và lớn hơn 0
        if (isNaN(value) || value < 1) {
            input.value = 1;
        }
        
        calculateTotal();
    }
    
    // Xử lý sự kiện xóa sản phẩm
    function handleRemoveItem(e) {
        const item = e.target.closest('.cart-item');
        item.remove();
        calculateTotal();
    }
    
    // Xử lý áp dụng mã giảm giá
    function applyDiscount() {
        const code = discountInput.value.trim().toUpperCase();
        
        if (code && discountCodes[code]) {
            const discountValue = discountCodes[code];
            
            if (discountValue === 'freeship') {
                state.discountType = 'freeship';
                state.discountValue = state.shipping;
                discountMessageEl.textContent = 'Áp dụng mã giảm giá thành công: Miễn phí vận chuyển!';
            } else if (typeof discountValue === 'number') {
                if (discountValue < 100) {
                    // Giảm theo phần trăm
                    state.discountType = 'percentage';
                    state.discountValue = discountValue;
                    discountMessageEl.textContent = `Áp dụng mã giảm giá thành công: Giảm ${discountValue}%!`;
                } else {
                    // Giảm theo số tiền cố định
                    state.discountType = 'fixed';
                    state.discountValue = discountValue;
                    discountMessageEl.textContent = `Áp dụng mã giảm giá thành công: Giảm ${formatCurrency(discountValue)}!`;
                }
            }
            
            discountMessageEl.style.display = 'block';
            discountInput.classList.add('discount-applied');
            
            // Cập nhật lại tổng tiền
            calculateTotal();
        } else {
            discountMessageEl.textContent = 'Mã giảm giá không hợp lệ!';
            discountMessageEl.style.display = 'block';
            discountMessageEl.className = 'mt-2 text-danger';
            
            // Reset trạng thái giảm giá
            state.discountType = null;
            state.discountValue = 0;
            state.discount = 0;
            discountInput.classList.remove('discount-applied');
            
            // Cập nhật lại tổng tiền
            calculateTotal();
            
            // Ẩn thông báo sau 3 giây
            setTimeout(() => {
                discountMessageEl.style.display = 'none';
            }, 3000);
        }
    }
    
    // Xử lý sự kiện thanh toán
    function handleCheckout() {
        alert('Đã chuyển đến trang thanh toán với tổng số tiền: ' + formatCurrency(state.total));
        // Tại đây bạn có thể chuyển hướng đến trang thanh toán thực tế
    }
    
    // Gắn các sự kiện
    document.querySelectorAll('.btn-increase').forEach(btn => {
        btn.addEventListener('click', handleIncreaseQuantity);
    });
    
    document.querySelectorAll('.btn-decrease').forEach(btn => {
        btn.addEventListener('click', handleDecreaseQuantity);
    });
    
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', handleQuantityChange);
    });
    
    document.querySelectorAll('.btn-remove').forEach(btn => {
        btn.addEventListener('click', handleRemoveItem);
    });
    
    applyDiscountBtn.addEventListener('click', applyDiscount);
    
    document.getElementById('checkout-btn').addEventListener('click', handleCheckout);
    
    // Khởi tạo tính toán ban đầu
    calculateTotal();
});