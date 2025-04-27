<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'customer/views/middlewares/checkAuthen.php';
require_once __DIR__ . '/../../../models/cart.php';
require_once __DIR__ . '/../../../models/product.php';


// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['user_id'])) {
    echo <<<HTML
    <body>
        <div class="container py-5">
            <div class="text-center">
                <i class="bi bi-exclamation-circle" style="font-size: 5rem; color: #f00;"></i>
                <h3 class="mt-3 text-danger">Bạn cần đăng nhập để xem giỏ hàng</h3>
                <p class="text-muted">Vui lòng đăng nhập để tiếp tục mua sắm và quản lý giỏ hàng của bạn.</p>
                <a href="index.php?page=login" class="btn btn-primary mt-3">Đăng nhập</a>
                <a href="index.php" class="btn btn-secondary mt-3">Quay lại trang chủ</a>
            </div>
        </div>
    </body>
    HTML;
    exit;
}

// Lấy thông tin người dùng từ session
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'] ?? '';

// Lấy giỏ hàng của người dùng
$cart = cart_select_by_user($user_id);
?>
<link rel="stylesheet" href="customer/views/assets/css/cartCSS.css">

<body>
    <div class="container py-5">
        <h2 class="text-center mb-5 fw-bold text-primary">Giỏ hàng của bạn</h2>

        <?php if (!empty($cart)): ?>
            <form method="POST" action="customer/controllers/cartController.php?action=update">
                <input type="hidden" name="update_cart" value="1">
                <div class="row">
                    <!-- Cart Items -->
                    <div class="col-lg-8">
                        <div class="card shadow-lg border-0 mb-4" id="cart-container">
                            <div class="card-body p-4">
                                <div class="row border-bottom pb-3 mb-3">
                                    <div class="col-md-6 fw-bold">Sản phẩm</div>
                                    <div class="col-md-2 text-center fw-bold">Đơn giá</div>
                                    <div class="col-md-2 text-center fw-bold">Số lượng</div>
                                    <div class="col-md-2 text-center fw-bold">Thành tiền</div>
                                </div>

                                <?php foreach ($cart as $item): ?>
                                    <?php
                                    // Lấy thông tin sản phẩm từ product_id
                                    $product = product_select_by_id($item['product_id']);
                                    ?>
                                    <div class="row cart-item p-3 align-items-center" data-id="<?= $item['product_id'] ?>">
                                        <div class="col-md-6 d-flex align-items-center">
                                            <img src="uploads/<?= htmlspecialchars($product['thumbnail']) ?>"
                                                alt="<?= htmlspecialchars($product['name']) ?>"
                                                class="product-img rounded me-3">
                                            <h5 class="product-name mb-1"><?= htmlspecialchars($product['name']) ?></h5>
                                        </div>
                                        <div class="col-6 col-md-2 text-md-center mt-3 mt-md-0">
                                            <div class="price-current" data-price="<?= $product['price'] ?>">
                                                <?= number_format($product['price'], 0, ',', '.') ?>₫
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-2 text-md-center mt-3 mt-md-0">
                                            <div class="quantity-control d-flex align-items-center justify-content-center">
                                                <label for="quantity-<?= htmlspecialchars($item['product_id']) ?>" class="me-2"></label>
                                                <input type="number"
                                                    id="quantity-<?= htmlspecialchars($item['product_id']) ?>"
                                                    name="quantity[<?= htmlspecialchars($item['product_id']) ?>]"
                                                    class="form-control text-center quantity-input"
                                                    value="<?= isset($item['quantity']) ? htmlspecialchars($item['quantity']) : 1 ?>"
                                                    min="1"
                                                    style="width: 70px; margin: 0 auto;">
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-2 text-md-center mt-3 mt-md-0">
                                            <div class="fw-bold item-total" id="total-<?= htmlspecialchars($item['product_id']) ?>">
                                                <?= number_format($product['price'] * $item['quantity'], 0, ',', '.') ?>₫
                                            </div>
                                            <input type="hidden" class="product-price" data-id="<?= htmlspecialchars($item['product_id']) ?>" value="<?= $product['price'] ?>">
                                            <a href="#" class="btn btn-sm btn-link text-danger p-0 mt-2 remove-item" data-id="<?= htmlspecialchars($item['product_id']) ?>">
                                                <i class="bi bi-trash"></i> Xóa
                                            </a>
                                        </div>

                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Cart Summary -->
                    <div class="col-lg-4">
                        <div class="card cart-total shadow-lg border-0">
                            <div class="card-body">
                                <?php
                                $subtotal = array_sum(array_map(fn($item) => product_select_by_id($item['product_id'])['price'] * $item['quantity'], $cart));
                                $shipping = 50000;
                                $total = $subtotal + $shipping;
                                ?>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Tạm tính:</span>
                                    <span id="subtotal"><?= number_format($subtotal, 0, ',', '.') ?>₫</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Phí vận chuyển:</span>
                                    <span id="shipping"><?= number_format($shipping, 0, ',', '.') ?>₫</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="fw-bold">Tổng cộng:</span>
                                    <span class="fw-bold fs-5 text-danger"
                                        id="total"><?= number_format($total, 0, ',', '.') ?>₫</span>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="customer/views/assets/js/carts.js"></script>
    <script src="customer/ajax/cart.js"></script>

</body>

</html>