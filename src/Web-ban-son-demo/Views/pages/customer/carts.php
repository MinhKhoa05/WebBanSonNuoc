<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng - PaintMaster</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #222;
        }
        
        .product-img {
            max-width: 100px;
            height: auto;
        }
        
        .cart-item {
            border-bottom: 1px solid #eee;
        }
        
        .cart-item:last-child {
            border-bottom: none;
        }
        
        .cart-header {
            background-color: #f8f9fa;
            font-weight: bold;
            border-bottom: 2px solid #dee2e6;
        }
        
        .btn-primary {
            background-color: #0066cc;
            border-color: #0066cc;
        }
        
        .btn-primary:hover {
            background-color: #0055b3;
            border-color: #0055b3;
        }
        
        .discount-badge {
            position: absolute;
            top: 0;
            right: 0;
            background-color: #dc3545;
            color: white;
            padding: 2px 8px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .product-name {
            font-weight: bold;
            color: #333;
        }
        
        .product-description {
            font-size: 14px;
            color: #666;
        }
        
        .price-original {
            text-decoration: line-through;
            color: #999;
            font-size: 14px;
        }
        
        .price-current {
            font-weight: bold;
            color: #333;
        }
        
        .cart-total {
            background-color: #f8f9fa;
        }

        .quantity-input {
            width: 40px;
            text-align: center;
        }

        .btn-quantity {
            cursor: pointer;
        }

        /* Thêm hiệu ứng hover cho nút xóa */
        .btn-remove:hover {
            transform: scale(1.1);
        }

        /* Hiệu ứng khi áp dụng mã giảm giá */
        .discount-applied {
            background-color: #d4edda;
            transition: background-color 0.3s;
        }
    </style>
</head>
<body>
    <!-- Main Content -->
    <div class="container py-4">
        <h2 class="text-center mb-4">Giỏ hàng của bạn</h2>
        
        <!-- Cart Items -->
        <div class="card mb-4 shadow" id="cart-container">
            <div class="card-body pt-0">
                <!-- Cart Header -->
                <div class="row card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <div class="col-md-6 m-0 font-weight-bold">Sản phẩm</div>
                    <div class="col-md-2 text-center">Đơn giá</div>
                    <div class="col-md-2 text-center">Số lượng</div>
                    <div class="col-md-2 text-center">Thành tiền</div>
                </div>
                
                <!-- Cart Items List -->
                <div id="cart-items">
                    <!-- Cart Item 1 -->
                    <div class="row cart-item p-3 align-items-center" data-id="1">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="position-relative me-3">
                                    <img src="/api/placeholder/100/100" alt="Sơn Jotun Majestic" class="product-img rounded">
                                    <span class="discount-badge">-10%</span>
                                </div>
                                <div>
                                    <h5 class="product-name mb-1">Sơn ngoại thất chống thấm Jotun Majestic</h5>
                                    <p class="product-description mb-0">Chống thấm mưa, chịu được môi trường biển</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 text-md-center mt-3 mt-md-0">
                            <div class="d-md-none fw-bold mb-1">Đơn giá:</div>
                            <div class="price-original">980.000đ</div>
                            <div class="price-current" data-price="920000">920.000đ</div>
                        </div>
                        <div class="col-6 col-md-2 text-md-center mt-3 mt-md-0">
                            <div class="d-md-none fw-bold mb-1">Số lượng:</div>
                            <div class="input-group input-group-sm" style="max-width: 120px; margin: 0 auto;">
                                <button class="btn btn-outline-secondary btn-decrease" type="button">-</button>
                                <input type="text" class="form-control text-center quantity-input" value="1" min="1">
                                <button class="btn btn-outline-secondary btn-increase" type="button">+</button>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 text-md-center mt-3 mt-md-0">
                            <div class="d-md-none fw-bold mb-1">Thành tiền:</div>
                            <div class="fw-bold item-total">920.000đ</div>
                            <button class="btn btn-sm btn-link text-danger p-0 mt-2 btn-remove">
                                <i class="bi bi-trash"></i> Xóa
                            </button>
                        </div>
                    </div>
                    
                    <!-- Cart Item 2 -->
                    <div class="row cart-item p-3 align-items-center" data-id="2">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="position-relative me-3">
                                    <img src="/api/placeholder/100/100" alt="Sơn TOA" class="product-img rounded">
                                </div>
                                <div>
                                    <h5 class="product-name mb-1">Sơn nội thất cao cấp TOA</h5>
                                    <p class="product-description mb-0">Sơn nội thất cao cấp không mùi, kháng bẩn</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 text-md-center mt-3 mt-md-0">
                            <div class="d-md-none fw-bold mb-1">Đơn giá:</div>
                            <div class="price-current" data-price="765000">765.000đ</div>
                        </div>
                        <div class="col-6 col-md-2 text-md-center mt-3 mt-md-0">
                            <div class="d-md-none fw-bold mb-1">Số lượng:</div>
                            <div class="input-group input-group-sm" style="max-width: 120px; margin: 0 auto;">
                                <button class="btn btn-outline-secondary btn-decrease" type="button">-</button>
                                <input type="text" class="form-control text-center quantity-input" value="2" min="1">
                                <button class="btn btn-outline-secondary btn-increase" type="button">+</button>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 text-md-center mt-3 mt-md-0">
                            <div class="d-md-none fw-bold mb-1">Thành tiền:</div>
                            <div class="fw-bold item-total">1.530.000đ</div>
                            <button class="btn btn-sm btn-link text-danger p-0 mt-2 btn-remove">
                                <i class="bi bi-trash"></i> Xóa
                            </button>
                        </div>
                    </div>
                    
                    <!-- Cart Item 3 -->
                    <div class="row cart-item p-3 align-items-center" data-id="3">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="position-relative me-3">
                                    <img src="/api/placeholder/100/100" alt="Sơn lót đa năng" class="product-img rounded">
                                    <span class="discount-badge">-5%</span>
                                </div>
                                <div>
                                    <h5 class="product-name mb-1">Sơn lót đa năng Shield Kote</h5>
                                    <p class="product-description mb-0">Sơn lót đa năng cho cả nội thất và ngoại thất</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 text-md-center mt-3 mt-md-0">
                            <div class="d-md-none fw-bold mb-1">Đơn giá:</div>
                            <div class="price-original">550.000đ</div>
                            <div class="price-current" data-price="522500">522.500đ</div>
                        </div>
                        <div class="col-6 col-md-2 text-md-center mt-3 mt-md-0">
                            <div class="d-md-none fw-bold mb-1">Số lượng:</div>
                            <div class="input-group input-group-sm" style="max-width: 120px; margin: 0 auto;">
                                <button class="btn btn-outline-secondary btn-decrease" type="button">-</button>
                                <input type="text" class="form-control text-center quantity-input" value="1" min="1">
                                <button class="btn btn-outline-secondary btn-increase" type="button">+</button>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 text-md-center mt-3 mt-md-0">
                            <div class="d-md-none fw-bold mb-1">Thành tiền:</div>
                            <div class="fw-bold item-total">522.500đ</div>
                            <button class="btn btn-sm btn-link text-danger p-0 mt-2 btn-remove">
                                <i class="bi bi-trash"></i> Xóa
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Cart Actions and Summary -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="d-flex">
                    <input type="text" class="form-control shadow" id="discount-code" placeholder="Mã giảm giá">
                    <button class="btn btn-outline-secondary ms-2 shadow" id="apply-discount">Áp dụng</button>
                </div>
                <div id="discount-message" class="mt-2 text-success" style="display: none;"></div>
            </div>
            <div class="col-md-6">
                <div class="card cart-total shadow mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tạm tính:</span>
                            <span id="subtotal">2.972.500đ</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Phí vận chuyển:</span>
                            <span id="shipping">50.000đ</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2" id="discount-row" style="display: none;">
                            <span>Giảm giá:</span>
                            <span id="discount-amount">0đ</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="fw-bold">Tổng cộng:</span>
                            <span class="fw-bold fs-5" id="total">3.022.500đ</span>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" id="checkout-btn">Tiến hành thanh toán</button>
                            <a href="#" class="btn btn-outline-secondary">Tiếp tục mua sắm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Empty Cart (Hidden by default) -->
        <div class="text-center py-5" id="empty-cart" style="display: none;">
            <i class="bi bi-cart-x" style="font-size: 5rem; color: #ccc;"></i>
            <h3 class="mt-3">Giỏ hàng của bạn đang trống</h3>
            <p class="text-muted">Hãy thêm sản phẩm vào giỏ hàng để tiến hành mua sắm</p>
            <a href="#" class="btn btn-primary mt-3">Mua sắm ngay</a>
        </div>
    </div>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <!-- Cart JavaScript -->
    <script>
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
    </script>
</body>
</html>