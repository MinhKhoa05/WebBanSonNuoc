<?php
session_start();
require_once __DIR__ . '/../../../models/cart.php'; // Đảm bảo đường dẫn đúng

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])): ?>
    <body>
        <div class="container py-5">
            <div class="text-center">
                <i class="bi bi-exclamation-circle" style="font-size: 5rem; color: #f00;"></i>
                <h3 class="mt-3 text-danger">Bạn cần đăng nhập để xem giỏ hàng</h3>
                <p class="text-muted">Vui lòng đăng nhập để tiếp tục mua sắm và quản lý giỏ hàng của bạn.</p>
                <a href="index.php?page=sign-in" class="btn btn-primary mt-3">Đăng nhập</a>
                <a href="index.php" class="btn btn-secondary mt-3">Quay lại trang chủ</a>
            </div>
        </div>
    </body>
    <?php
    exit;
endif;
?>

<?php
// Lấy giỏ hàng từ cơ sở dữ liệu
$user_id = $_SESSION['user_id'];
save_cart_to_database(isset($_SESSION['cart']) ? $_SESSION['cart'] : [], $user_id);

$cart = get_cart_from_database($user_id);
?>

<link rel="stylesheet" href="views/assets/css/customer/cartCSS.css">
<script src="views/assets/css/customer/cart.js"></script>

<body>
    <div class="container py-5">
        <h2 class="text-center mb-5 fw-bold text-primary">Giỏ hàng của bạn</h2>

        <?php if (!empty($cart)): ?>
            <form method="POST" action="controllers/cartController.php?action=update">
                <input type="hidden" name="update_cart" value="1">
                <div class="row">
                    <!-- Cart Items -->
                    <div class="col-lg-8">
                        <div class="card shadow-lg border-0 mb-4" id="cart-container">
                            <div class="card-body p-4">
                                <!-- Cart Header -->
                                <div class="row border-bottom pb-3 mb-3">
                                    <div class="col-md-6 fw-bold">Sản phẩm</div>
                                    <div class="col-md-2 text-center fw-bold">Đơn giá</div>
                                    <div class="col-md-2 text-center fw-bold">Số lượng</div>
                                    <div class="col-md-2 text-center fw-bold">Thành tiền</div>
                                </div>

                                <!-- Cart Items List -->
                                <div id="cart-items">
                                    <?php foreach ($cart as $item): ?>
                                        <div class="row cart-item p-3 align-items-center" data-id="<?= $item['product_id'] ?>">
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="position-relative me-3">
                                                        <img src="uploads/<?= htmlspecialchars($item['thumbnail']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="product-img rounded">
                                                    </div>
                                                    <div>
                                                        <h5 class="product-name mb-1"><?= htmlspecialchars($item['name']) ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-2 text-md-center mt-3 mt-md-0">
                                                <div class="price-current" data-price="<?= $item['price'] ?>">
                                                    <?= number_format($item['price'], 0, ',', '.') ?>₫
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-2 text-md-center mt-3 mt-md-0">
                                                <div class="input-group input-group-sm" style="max-width: 120px; margin: 0 auto;">
                                                    <input type="number" name="quantity[<?= $item['product_id'] ?>]" class="form-control text-center quantity-input" value="<?= $item['quantity'] ?>" min="1">
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-2 text-md-center mt-3 mt-md-0">
                                                <div class="fw-bold item-total">
                                                    <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>₫
                                                </div>
                                                <a href="controllers/cartController.php?action=remove&id=<?= $item['product_id'] ?>" class="btn btn-sm btn-link text-danger p-0 mt-2 btn-remove">
                                                    <i class="bi bi-trash"></i> Xóa
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cart Summary -->
                    <div class="col-lg-4">
                        <div class="card cart-total shadow-lg border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Tạm tính:</span>
                                    <span id="subtotal">
                                        <?= number_format(array_sum(array_map(function ($item) {
                                            return $item['price'] * $item['quantity'];
                                        }, $cart)), 0, ',', '.') ?>₫
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Phí vận chuyển:</span>
                                    <span id="shipping">50.000đ</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="fw-bold">Tổng cộng:</span>
                                    <span class="fw-bold fs-5 text-danger" id="total">
                                        <?= number_format(array_sum(array_map(function ($item) {
                                            return $item['price'] * $item['quantity'];
                                        }, $cart)) + 50000, 0, ',', '.') ?>₫
                                    </span>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Cập nhật giỏ hàng</button>
                                    <a href="index.php?page=checkout" class="btn btn-success">Thanh toán</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-cart-x" style="font-size: 5rem; color: #ccc;"></i>
                <h3 class="mt-3">Giỏ hàng của bạn đang trống</h3>
                <p class="text-muted">Hãy thêm sản phẩm vào giỏ hàng để tiến hành mua sắm</p>
                <a href="index.php" class="btn btn-primary mt-3">Mua sắm ngay</a>
            </div>
        <?php endif; ?> 
    </div>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>