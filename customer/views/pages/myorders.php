<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../../models/user.php';
require_once __DIR__ . '/../../../models/order.php';
require_once __DIR__ . '/../../../models/order_detail.php';

$user = user_get_by_id($_SESSION['user_id']);
$orders = order_get_by_user_id($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Đơn hàng của tôi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <style>
        .table td,
        .table th {
            vertical-align: middle;
        }

        .btn-toggle-icon i {
            transition: transform 0.3s ease;
        }
    </style>
</head>

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
                            <li class="breadcrumb-item"><a href="index.php?page=myprofile" class="text-white">Tài khoản</a>
                            </li>
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
                                            switch ($order['status']) {
                                                case 'pending':
                                                    $status_class = 'bg-warning';
                                                    $status_text = 'Chờ xác nhận';
                                                    break;
                                                case 'processing':
                                                    $status_class = 'bg-info';
                                                    $status_text = 'Đang xử lý';
                                                    break;
                                                case 'delivering':
                                                    $status_class = 'bg-primary';
                                                    $status_text = 'Đang giao hàng';
                                                    break;
                                                case 'completed':
                                                    $status_class = 'bg-success';
                                                    $status_text = 'Đã giao hàng';
                                                    break;
                                                default:
                                                    $status_class = 'bg-secondary';
                                                    $status_text = 'Không xác định';
                                            }
                                            ?>
                                            <span class="badge <?= $status_class ?>"><?= $status_text ?></span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-secondary collapsed btn-toggle-icon" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#orderDetail<?= $order['id'] ?>"
                                                aria-expanded="false" aria-controls="orderDetail<?= $order['id'] ?>">
                                                <i class="fas fa-eye me-1"></i> Chi tiết
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="p-0">
                                            <div class="collapse bg-light border rounded p-3" id="orderDetail<?= $order['id'] ?>">
                                                <p class="mb-1"><strong>📍 Địa chỉ:</strong> <?= htmlspecialchars($order['address'] ?? 'Chưa cung cấp') ?></p>
                                                <p class="mb-3"><strong>📝 Ghi chú:</strong> <?= htmlspecialchars($order['note'] ?? 'Không có') ?></p>

                                                <?php $items = order_detail_select_by_order_id($order['id']); ?>
                                                <?php if (!empty($items)): ?>
                                                    <div class="table-responsive">
                                                        <table class="table table-sm table-striped table-hover mb-0">
                                                            <thead class="table-secondary">
                                                                <tr>
                                                                    <th>Sản phẩm</th>
                                                                    <th>Giá</th>
                                                                    <th>Số lượng</th>
                                                                    <th>Thành tiền</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($items as $item): ?>
                                                                    <tr>
                                                                        <td><?= htmlspecialchars($item['product_name'] ?? 'Không rõ') ?></td>
                                                                        <td><?= number_format($item['price'], 0, ',', '.') ?> ₫</td>
                                                                        <td><?= (int) $item['quantity'] ?></td>
                                                                        <td><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?> ₫</td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php else: ?>
                                                    <p class="text-muted">Không có sản phẩm trong đơn hàng này.</p>
                                                <?php endif; ?>
                                            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(button => {
                const targetId = button.getAttribute('data-bs-target');
                const collapseEl = document.querySelector(targetId);
                const icon = button.querySelector('i');

                if (!collapseEl) return;

                collapseEl.addEventListener('shown.bs.collapse', () => {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                    button.classList.remove('collapsed');
                });

                collapseEl.addEventListener('hidden.bs.collapse', () => {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                    button.classList.add('collapsed');
                });
            });
        });
    </script>
</body>

</html>
