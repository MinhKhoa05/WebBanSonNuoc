document.addEventListener('DOMContentLoaded', function () {
    // Gán sự kiện cho các nút xóa
    const attachRemoveEvents = () => {
        const removeButtons = document.querySelectorAll('.remove-item');

        removeButtons.forEach(button => {
            // Tránh gán sự kiện lặp lại
            button.removeEventListener('click', handleRemoveClick);
            button.addEventListener('click', handleRemoveClick);
        });
    };

    // Hàm xử lý sự kiện click nút xóa
    function handleRemoveClick(e) {
        e.preventDefault();

        const productId = this.getAttribute('data-id');

        // Hiển thị xác nhận trước khi xóa
        if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')) {
            // Gửi yêu cầu AJAX để xóa sản phẩm
            fetch('customer/ajax/remove-from-cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `product_id=${encodeURIComponent(productId)}`
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Lỗi kết nối');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Xóa sản phẩm khỏi giao diện
                        const cartItem = document.querySelector(`.cart-item[data-id="${productId}"]`);
                        if (cartItem) {
                            cartItem.remove();
                        }

                        // Cập nhật số lượng sản phẩm trong giỏ hàng ở tất cả các vị trí
                        updateCartCount(data.cartCount);

                        // Cập nhật tổng tiền
                        updateCartTotals();

                        // Hiển thị thông báo thành công
                        showNotification('Đã xóa sản phẩm khỏi giỏ hàng', 'success');

                        // Kiểm tra nếu giỏ hàng rỗng
                        if (data.cartCount === 0) {
                            showEmptyCartMessage();
                        }
                    } else {
                        showNotification('Không thể xóa sản phẩm: ' + (data.message || 'Đã xảy ra lỗi'), 'error');
                    }
                })
                .catch(error => {
                    console.error('Lỗi khi xóa sản phẩm:', error);
                    showNotification('Đã xảy ra lỗi khi xóa sản phẩm', 'error');
                });
        }
    }

    // Hàm cập nhật số lượng giỏ hàng ở tất cả các vị trí
    function updateCartCount(count) {
        // Cập nhật ở header
        const cartCountElements = document.querySelectorAll('.cart-count, #cartCount');
        cartCountElements.forEach(element => {
            if (element) {
                element.textContent = count;
            }
        });

        // Ẩn badge nếu số lượng = 0
        if (count === 0) {
            cartCountElements.forEach(element => {
                if (element) {
                    element.classList.add('d-none');
                }
            });
        } else {
            cartCountElements.forEach(element => {
                if (element) {
                    element.classList.remove('d-none');
                }
            });
        }
    }

    // Hàm cập nhật tổng tiền
    function updateCartTotals() {
        let subtotal = 0;
    
        // Tính tổng tiền từ các sản phẩm còn lại
        document.querySelectorAll('.cart-item').forEach(item => {
            const priceElement = item.querySelector('.product-price');
            const quantityElement = item.querySelector('.quantity-input');
    
            if (priceElement && quantityElement) {
                // Lấy chuỗi giá và xử lý đúng
                let priceText = priceElement.value || priceElement.textContent;
                // Loại bỏ ký tự tiền tệ và giữ lại số và dấu chấm
                priceText = priceText.replace(/[^\d.,]/g, '');
                // Loại bỏ dấu chấm phân cách hàng nghìn
                priceText = priceText.replace(/\./g, '');
                // Chuyển dấu phẩy thành dấu chấm (nếu có)
                priceText = priceText.replace(/,/g, '.');
                
                // Chuyển đổi thành số
                const price = parseFloat(priceText);
                const quantity = parseInt(quantityElement.value || quantityElement.textContent, 10);
    
                if (!isNaN(price) && !isNaN(quantity)) {
                    subtotal += price * quantity;
                }
            }
        });
    
        // Xử lý tương tự cho phí vận chuyển
        let shipping = 50000; // Giá mặc định
        const shippingElement = document.getElementById('shipping');
        if (shippingElement) {
            let shippingText = shippingElement.textContent;
            shippingText = shippingText.replace(/[^\d.,]/g, '');
            shippingText = shippingText.replace(/\./g, '');
            shippingText = shippingText.replace(/,/g, '.');
            
            const parsedShipping = parseFloat(shippingText);
            if (!isNaN(parsedShipping)) {
                shipping = parsedShipping;
            }
        }
        
        const total = subtotal + shipping;
    
        // Cập nhật hiển thị
        const subtotalElements = document.querySelectorAll('#subtotal, .subtotal');
        subtotalElements.forEach(element => {
            if (element) {
                element.textContent = subtotal.toLocaleString('vi-VN') + '₫';
            }
        });
    
        const totalElements = document.querySelectorAll('#total, .total');
        totalElements.forEach(element => {
            if (element) {
                element.textContent = total.toLocaleString('vi-VN') + '₫';
            }
        });
    }
    // Hiển thị thông báo khi giỏ hàng trống
    function showEmptyCartMessage() {
        const cartContainer = document.querySelector('.cart-container, .cart-items');
        if (cartContainer) {
            cartContainer.innerHTML = '<div class="alert alert-info text-center py-3">Giỏ hàng của bạn đang trống</div>';
        }

        // Ẩn phần thanh toán nếu có
        const checkoutSection = document.querySelector('.checkout-section');
        if (checkoutSection) {
            checkoutSection.classList.add('d-none');
        }
    }

    // Hiển thị thông báo
    function showNotification(message, type) {
        // Tạo thông báo toast
        const toast = document.createElement('div');
        toast.className = `toast align-items-center text-white bg-${type === 'success' ? 'success' : 'danger'} border-0 position-fixed bottom-0 end-0 m-3`;
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');

        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;

        // Thêm vào body
        document.body.appendChild(toast);

        // Hiển thị và tự động ẩn sau 3 giây
        const bsToast = new bootstrap.Toast(toast, { autohide: true, delay: 3000 });
        bsToast.show();

        // Xóa khỏi DOM sau khi ẩn
        toast.addEventListener('hidden.bs.toast', function () {
            document.body.removeChild(toast);
        });
    }

    // Khởi tạo sự kiện
    attachRemoveEvents();
});