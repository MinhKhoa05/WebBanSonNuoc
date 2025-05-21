<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../../models/user.php';
require_once __DIR__ . '/../../../models/order.php';

$user = user_get_by_id($_SESSION['user_id']);
$orders = order_get_by_user_id($_SESSION['user_id']);
?>

<body class="bg-light mt-5">
    <!-- Orders Header -->
    <div class="bg-primary text-white py-4 mb-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-0">Đơn Hàng Của Tôi</h1>
                </div>
                <div class="col-md-4 text-md-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-md-end mb-0">
                            <li class="breadcrumb-item"><a href="/" class="text-white">Trang chủ</a></li>
                            <li class="breadcrumb-item"><a href="index.php?page=myprofile" class="text-white">Tài khoản</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">Đơn hàng của tôi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <?php if (empty($orders)): ?>
                <div class="text-center py-5">
                    <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
                    <h5>Bạn chưa có đơn hàng nào</h5>
                    <p class="text-muted">Hãy mua sắm để có đơn hàng đầu tiên của bạn!</p>
                    <a href="index.php?page=home" class="btn btn-primary mt-3">
                        <i class="fas fa-shopping-cart me-2"></i>Mua sắm ngay
                    </a>
                </div>
                <?php else: ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Mã đơn hàng</th>
                                <th scope="col">Ngày đặt</th>
                                <th scope="col">Người nhận</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                            <tr>
                                <td>#<?= htmlspecialchars($order['id']) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($order['order_date'])) ?></td>
                                <td><?= htmlspecialchars($order['user_name']) ?></td>
                                <td><?= number_format($order['total'], 0, ',', '.') ?> ₫</td>
                                <td>
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
                                </td>
                                <td>
                                    <a href="index.php?page=order_detail&id=<?= $order['id'] ?>" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-eye me-1"></i> Chi tiết
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html> 