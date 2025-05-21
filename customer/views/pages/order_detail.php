<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../../models/user.php';
require_once __DIR__ . '/../../../models/order.php';

if (!isset($_GET['id'])) {
    header('Location: index.php?page=myorders');
    exit;
}

$order_id = intval($_GET['id']);
$order = order_get_details($order_id);

if (!$order) {
    header('Location: index.php?page=myorders');
    exit;
}

$user = user_get_by_id($_SESSION['user_id']);
?>

<body class="bg-light mt-5">
    <!-- Order Detail Header -->
    <div class="bg-primary text-white py-4 mb-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-0">Chi Tiết Đơn Hàng #<?= $order['id'] ?></h1>
                </div>
                <div class="col-md-4 text-md-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-md-end mb-0">
                            <li class="breadcrumb-item"><a href="/" class="text-white">Trang chủ</a></li>
                            <li class="breadcrumb-item"><a href="index.php?page=myprofile" class="text-white">Tài khoản</a></li>
                            <li class="breadcrumb-item"><a href="index.php?page=myorders" class="text-white">Đơn hàng của tôi</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">Chi tiết đơn hàng</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-4">
        <div class="row">
            <!-- Order Information -->
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">Thông tin đơn hàng</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="mb-2 text-muted">Mã đơn hàng</p>
                                <p class="mb-3 fw-bold">#<?= htmlspecialchars($order['id']) ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2 text-muted">Ngày đặt hàng</p>
                                <p class="mb-3 fw-bold"><?= date('d/m/Y H:i', strtotime($order['order_date'])) ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2 text-muted">Trạng thái đơn hàng</p>
                                <p class="mb-3">
                                    <?php
                                    $status_class = '';
                                    switch($order['status']) {
                                        case 'pending':
                                            $status_class = 'bg-warning';
                                            $status_text = 'Chờ xác nhận';
                                            break;
                                        case 'processing':
                                            $status_class = 'bg-info';
                                            $status_text = 'Đang xử lý';
                                            break;
                                        case 'shipped':
                                            $status_class = 'bg-primary';
                                            $status_text = 'Đang giao hàng';
                                            break;
                                        case 'delivered':
                                            $status_class = 'bg-success';
                                            $status_text = 'Đã giao hàng';
                                            break;
                                        case 'cancelled':
                                            $status_class = 'bg-danger';
                                            $status_text = 'Đã hủy';
                                            break;
                                        default:
                                            $status_class = 'bg-secondary';
                                            $status_text = 'Không xác định';
                                    }
                                    ?>
                                    <span class="badge <?= $status_class ?>"><?= $status_text ?></span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2 text-muted">Phương thức thanh toán</p>
                                <p class="mb-3 fw-bold"><?= htmlspecialchars($order['payment_method']) ?></p>
                            </div>
                        </div>

                        <h6 class="mb-3">Sản phẩm đã đặt</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-end">Đơn giá</th>
                                        <th class="text-end">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($order['items'] as $item): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" 
                                                     class="img-thumbnail me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                                <div>
                                                    <h6 class="mb-1"><?= htmlspecialchars($item['name']) ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center"><?= htmlspecialchars($item['quantity']) ?></td>
                                        <td class="text-end"><?= number_format($item['price'], 0, ',', '.') ?> ₫</td>
                                        <td class="text-end"><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?> ₫</td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end">Phí vận chuyển:</td>
                                        <td class="text-end"><?= number_format($order['shipping'], 0, ',', '.') ?> ₫</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold">Tổng cộng:</td>
                                        <td class="text-end fw-bold"><?= number_format($order['total'], 0, ',', '.') ?> ₫</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Information -->
            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">Thông tin giao hàng</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-3">Người nhận</h6>
                        <p class="mb-1"><?= htmlspecialchars($order['fullname']) ?></p>
                        <p class="mb-1"><?= htmlspecialchars($order['phone']) ?></p>
                        <p class="mb-1"><?= htmlspecialchars($order['address']) ?></p>
                        
                        <?php if (!empty($order['note'])): ?>
                        <hr>
                        <h6 class="mb-3">Ghi chú</h6>
                        <p class="mb-0"><?= nl2br(htmlspecialchars($order['note'])) ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Cần hỗ trợ?</h5>
                        <p class="card-text">Nếu bạn cần giúp đỡ về đơn hàng này, hãy liên hệ với đội ngũ chăm sóc khách hàng của chúng tôi.</p>
                        <a href="#" class="btn btn-outline-primary w-100">
                            <i class="fas fa-headset me-2"></i> Liên hệ hỗ trợ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html> 