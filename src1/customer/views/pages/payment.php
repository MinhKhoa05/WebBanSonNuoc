<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'customer/views/middlewares/checkAuthen.php';
require_once __DIR__ . '/../../../models/cart.php';
require_once __DIR__ . '/../../../models/product.php';
require_once __DIR__ . '/../../../models/user.php'; // Để lấy thông tin user

// Kiểm tra đăng nhập
if (!isset($_SESSION['user_id'])) {
    echo <<<HTML
    <body>
        <div class="container py-5">
            <div class="text-center">
                <i class="bi bi-exclamation-circle" style="font-size: 5rem; color: #f00;"></i>
                <h3 class="mt-3 text-danger">Bạn cần đăng nhập để thanh toán</h3>
                <p class="text-muted">Vui lòng đăng nhập để tiếp tục mua sắm và thanh toán giỏ hàng của bạn.</p>
                <a href="index.php?page=login" class="btn btn-primary mt-3">Đăng nhập</a>
                <a href="index.php" class="btn btn-secondary mt-3">Quay lại trang chủ</a>
            </div>
        </div>
    </body>
    HTML;
    exit;
}

$user_id = $_SESSION['user_id'];
$user_info = user_get_by_id($user_id); // Lấy thông tin user

// Lấy giỏ hàng từ DB
$cart_items = cart_select_by_user($user_id);

// Nếu giỏ hàng rỗng
if (empty($cart_items)) {
    echo <<<HTML
    <body>
        <div class="container py-5">
            <div class="text-center">
                <i class="bi bi-cart-x" style="font-size: 5rem; color: #ccc;"></i>
                <h3 class="mt-3">Giỏ hàng của bạn đang trống</h3>
                <p class="text-muted">Hãy thêm sản phẩm vào giỏ hàng để tiến hành thanh toán</p>
                <a href="index.php" class="btn btn-primary mt-3">Mua sắm ngay</a>
            </div>
        </div>
    </body>
    HTML;
    exit;
}

// Tính tổng tiền
$subtotal = 0;
$shipping = 30000; // Phí vận chuyển cố định
foreach ($cart_items as $item) {
    $product = product_select_by_id($item['product_id']);
    $subtotal += $product['price'] * $item['quantity'];
}
$total = $subtotal + $shipping;
?>

<div class="container py-4">
    <h2 class="my-5 text-center">Thanh toán đơn hàng</h2>
    <form method="post" id="payment-form" action="customer/controllers/paymentController.php">
        <div class="row">
            <!-- Thông tin khách hàng -->
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Thông tin khách hàng</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Họ và tên (Người nhận) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="fullname" name="fullname"
                                value="<?= isset($user_info['fullname']) ? htmlspecialchars($user_info['fullname']) : '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại (Người nhận) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="<?= isset($user_info['phone']) ? htmlspecialchars($user_info['phone']) : '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ nhận hàng <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="<?= isset($user_info['address']) ? htmlspecialchars($user_info['address']) : '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label">Ghi chú</label>
                            <textarea class="form-control" id="note" name="note" rows="3" placeholder="Ghi chú về đơn hàng, vd: thời gian hay chỉ dẫn địa điểm giao hàng chi tiết hơn"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Phương thức thanh toán -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Phương thức thanh toán</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                            <label class="form-check-label" for="cod">
                                <i class="bi bi-cash-coin me-2"></i> Thanh toán khi nhận hàng (COD)
                            </label>
                            <div class="text-muted small mt-1">Bạn sẽ thanh toán bằng tiền mặt khi nhận được hàng</div>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" id="bank" value="bank">
                            <label class="form-check-label" for="bank">
                                <i class="bi bi-bank me-2"></i> Chuyển khoản ngân hàng
                            </label>
                            <div class="text-muted small mt-1">Thông tin tài khoản sẽ được gửi qua email sau khi đặt hàng</div>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" id="momo" value="momo">
                            <label class="form-check-label" for="momo">
                                <i class="bi bi-wallet2 me-2"></i> Thanh toán qua Ví MoMo
                            </label>
                            <div class="text-muted small mt-1">Quét mã QR để thanh toán qua ứng dụng MoMo</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Đơn hàng -->
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Thông tin đơn hàng</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-end">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cart_items as $item): ?>
                                        <?php $product = product_select_by_id($item['product_id']); ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="uploads/<?= htmlspecialchars($product['thumbnail']) ?>"
                                                         alt="<?= htmlspecialchars($product['name']) ?>"
                                                         style="width: 50px; height: 50px; object-fit: cover;"
                                                         class="me-2 rounded">
                                                    <div>
                                                        <div class="fw-bold"><?= htmlspecialchars($product['name']) ?></div>
                                                        <small class="text-muted"><?= number_format($product['price'], 0, ',', '.') ?>₫</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center"><?= $item['quantity'] ?></td>
                                            <td class="text-end"><?= number_format($product['price'] * $item['quantity'], 0, ',', '.') ?>₫</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Tổng giá trị đơn hàng -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tạm tính:</span>
                            <span><?= number_format($subtotal, 0, ',', '.') ?>₫</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Phí vận chuyển:</span>
                            <span><?= number_format($shipping, 0, ',', '.') ?>₫</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="fw-bold">Tổng cộng:</span>
                            <span class="fw-bold fs-4 text-danger"><?= number_format($total, 0, ',', '.') ?>₫</span>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                            <label class="form-check-label" for="terms">
                                Tôi đã đọc và đồng ý với <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">điều khoản dịch vụ</a>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-success w-100 py-2 fs-5">
                            <i class="bi bi-bag-check me-2"></i> Đặt hàng
                        </button>
                        <div class="text-center mt-3">
                            <a href="index.php?page=cart" class="text-decoration-none">
                                <i class="bi bi-arrow-left"></i> Quay lại giỏ hàng
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modal Điều khoản -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Điều khoản dịch vụ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>1. Điều khoản thanh toán</h5>
                <p>Khi bạn quyết định mua hàng từ chúng tôi, bạn đồng ý thanh toán đầy đủ số tiền của đơn hàng.</p>
                <h5>2. Chính sách giao hàng</h5>
                <p>Chúng tôi cam kết giao hàng trong vòng 3-5 ngày làm việc. Trong trường hợp có sự chậm trễ, chúng tôi sẽ thông báo đến bạn.</p>
                <h5>3. Chính sách đổi trả</h5>
                <p>Quý khách có quyền đổi trả sản phẩm trong vòng 7 ngày kể từ ngày nhận hàng nếu sản phẩm không đúng mô tả.</p>
                <h5>4. Bảo mật thông tin</h5>
                <p>Chúng tôi cam kết bảo mật thông tin cá nhân của quý khách và không chia sẻ cho bên thứ ba trừ khi được sự đồng ý.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="document.getElementById('terms').checked = true;">Đồng ý</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            const invalidFields = form.querySelectorAll(':invalid');
            if (invalidFields.length > 0) {
                invalidFields[0].focus();
                alert('Vui lòng điền đầy đủ thông tin bắt buộc trước khi đặt hàng.');
            }
        } else {
            if (!confirm('Bạn có chắc chắn muốn đặt hàng?')) {
                event.preventDefault();
            }
        }
    });
});
</script>