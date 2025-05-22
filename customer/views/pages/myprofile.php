<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../../models/user.php';
require_once __DIR__ . '/../../../models/order.php';
$user = user_get_by_id($_SESSION['user_id']);
$recent_orders = order_get_by_user_id($_SESSION['user_id']);

?>

<body class="bg-light mt-5">
    <!-- Profile Header -->
    <div class="bg-primary text-white py-4 mb-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-0">Tài Khoản Của Tôi</h1>
                </div>
                <div class="col-md-4 text-md-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-md-end mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-white">Trang chủ</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">Tài khoản của tôi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body text-center py-4">
                        <div class="mb-3">
                            <img src="/api/placeholder/150/150" alt="Avatar" class="rounded-circle img-thumbnail">
                        </div>
                        <h5 class="mb-1"><?= htmlspecialchars($user['name']) ?></h5>
                        <p class="text-muted mb-3">Thành viên Bạc</p>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary" type="button">Chỉnh sửa hồ sơ</button>
                        </div>
                    </div>
                </div>

                <div class="list-group shadow-sm mb-4">
                    <!-- <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-user me-2"></i> Thông tin tài khoản
                    </a>
                    <a href="index.php?page=myorders" class="list-group-item list-group-item-action">
                        <i class="fas fa-clipboard-list me-2"></i> Đơn hàng của tôi -->
                        <!-- <span class="badge bg-primary rounded-pill float-end"></span> -->
                    <!-- </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-map-marker-alt me-2"></i> Địa chỉ giao hàng
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-heart me-2"></i> Sản phẩm yêu thích
                        <span class="badge bg-primary rounded-pill float-end">8</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-comments me-2"></i> Đánh giá của tôi
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-gift me-2"></i> Phiếu giảm giá
                        <span class="badge bg-primary rounded-pill float-end">2</span>
                    </a> -->
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-lock me-2"></i> Đổi mật khẩu
                    </a>
                    <a href="customer/controllers/logoutController.php" class="list-group-item list-group-item-action text-danger">
                        <i class="fas fa-sign-out-alt me-2"></i> Đăng xuất
                    </a>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Cần hỗ trợ?</h5>
                        <p class="card-text">Nếu bạn cần giúp đỡ, hãy liên hệ với đội ngũ chăm sóc khách hàng của chúng
                            tôi.</p>
                        <a href="#" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-headset me-2"></i> Liên hệ hỗ trợ
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Profile Content -->
            <div class="col-lg-9">
                <!-- Profile Overview -->
                <!-- <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">Tổng quan tài khoản</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3 col-6">
                                <div class="border rounded text-center p-3">
                                    <div class="fs-2 text-primary mb-2">
                                        <i class="fas fa-shopping-bag"></i>
                                    </div>
                                    <h6 class="mb-1">4</h6>
                                    <p class="small text-muted mb-0">Đơn hàng</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="border rounded text-center p-3">
                                    <div class="fs-2 text-primary mb-2">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    <h6 class="mb-1">8</h6>
                                    <p class="small text-muted mb-0">Sản phẩm yêu thích</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="border rounded text-center p-3">
                                    <div class="fs-2 text-primary mb-2">
                                        <i class="fas fa-comment"></i>
                                    </div>
                                    <h6 class="mb-1">5</h6>
                                    <p class="small text-muted mb-0">Đánh giá</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="border rounded text-center p-3">
                                    <div class="fs-2 text-primary mb-2">
                                        <i class="fas fa-coins"></i>
                                    </div>
                                    <h6 class="mb-1">1.250</h6>
                                    <p class="small text-muted mb-0">Điểm tích lũy</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- Personal Information -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Thông tin cá nhân</h5>
                        <button class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-edit me-1"></i> Chỉnh sửa
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p class="mb-2 text-muted small">Họ và tên</p>
                                <p class="mb-3 fw-bold"><?= htmlspecialchars($user['name']) ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2 text-muted small">Email</p>
                                <p class="mb-3 fw-bold"><?= htmlspecialchars($user['email']) ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2 text-muted small">Số điện thoại</p>
                                <p class="mb-3 fw-bold"><?= htmlspecialchars($user['phone']) ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2 text-muted small">Ngày tham gia</p>
                                <p class="mb-3 fw-bold"><?= htmlspecialchars($user['created_at']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Đơn hàng gần đây</h5>
                        <a href="index.php?page=myorders" class="btn btn-sm btn-outline-primary">
                            Xem tất cả
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table mb-0">
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
                                    <?php foreach ($recent_orders as $order): ?>
                                    <tr>
                                        <td>#<?= htmlspecialchars($order['id']) ?></td>
                                        <td><?= date('d/m/Y', strtotime($order['order_date'])) ?></td>
                                        <td>
                                            <div class="small">
                                                <div class="fw-bold"><?= htmlspecialchars($order['user_name']) ?></div>
                                                <div class="text-muted"><?= isset($order['phone']) ? htmlspecialchars($order['phone']) : 'N/A' ?></div>
                                            </div>
                                        </td>
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
                                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#orderModal<?= $order['id'] ?>">
                                                Chi tiết
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Order Detail Modal -->
                                    <div class="modal fade" id="orderModal<?= $order['id'] ?>" tabindex="-1" aria-labelledby="orderModalLabel<?= $order['id'] ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="orderModalLabel<?= $order['id'] ?>">Chi tiết đơn hàng #<?= $order['id'] ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
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
                                                                <span class="badge <?= $status_class ?>"><?= $status_text ?></span>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="mb-2 text-muted">Phương thức thanh toán</p>
                                                            <p class="mb-3 fw-bold"><?= htmlspecialchars($order['payment_method']) ?></p>
                                                        </div>
                                                    </div>

                                                    <h6 class="mb-3">Thông tin giao hàng</h6>
                                                    <p class="mb-1"><?= htmlspecialchars($order['user_name']) ?></p>
                                                    <p class="mb-1"><?= isset($order['phone']) ? htmlspecialchars($order['phone']) : 'N/A' ?></p>
                                                    <p class="mb-1"><?= htmlspecialchars($order['address']) ?></p>
                                                    
                                                    <?php if (!empty($order['note'])): ?>
                                                    <hr>
                                                    <h6 class="mb-3">Ghi chú</h6>
                                                    <p class="mb-0"><?= nl2br(htmlspecialchars($order['note'])) ?></p>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Địa chỉ giao hàng</h5>
                        <button class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-plus me-1"></i> Thêm địa chỉ mới
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md">
                                <div class="border rounded p-3 position-relative">
                                    <span class="badge bg-primary position-absolute top-0 end-0 mt-2 me-2">Mặc
                                        định</span>
                                    <h6 class="mb-1">Địa chỉ nhà riêng</h6>
                                    <p class="mb-1">Nguyễn Văn A</p>
                                    <p class="mb-1">Số 123, Đường Nguyễn Huệ, Phường Bến Nghé, Quận 1</p>
                                    <p class="mb-1">TP. Hồ Chí Minh</p>
                                    <p class="mb-1">Điện thoại: 0123 456 789</p>
                                    <div class="mt-3">
                                        <a href="#" class="btn btn-sm btn-outline-secondary me-1">Chỉnh sửa</a>
                                        <a href="#" class="btn btn-sm btn-outline-danger">Xóa</a>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="border rounded p-3">
                                    <h6 class="mb-1">Địa chỉ công ty</h6>
                                    <p class="mb-1">Công ty TNHH XYZ</p>
                                    <p class="mb-1">Số 456, Đường Lê Lợi, Phường Bến Thành, Quận 1</p>
                                    <p class="mb-1">TP. Hồ Chí Minh</p>
                                    <p class="mb-1">Điện thoại: 0987 654 321</p>
                                    <div class="mt-3">
                                        <a href="#" class="btn btn-sm btn-outline-secondary me-1">Chỉnh sửa</a>
                                        <a href="#" class="btn btn-sm btn-outline-danger">Xóa</a>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS Bundle with Popper -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>