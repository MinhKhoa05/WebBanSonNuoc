<?php
$orders = $data['orders'] ?? [];

// Các trạng thái có thể chuyển đổi
$statusOptions = [
    'pending' => 'Chờ xử lý',
    'delivering' => 'Đang giao',
    'completed' => 'Hoàn thành',
];

// Các màu sắc tương ứng với trạng thái
$statusColors = [
    'pending' => 'warning',
    'delivering' => 'info',
    'completed' => 'success',
    'default' => 'secondary'
];
?>

<!-- Tiêu đề trang -->
<div class="container-fluid px-4 py-3">
    <div class="row align-items-center mb-4">
        <div class="col">
            <h3 class="fw-bold"><i class="fas fa-shopping-cart me-2"></i>Quản lý đơn hàng</h3>
        </div>
        <div class="col-auto">
            <!-- <form class="d-flex" action="" method="GET">
                <input type="hidden" name="page" value="order">
                <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="Tìm mã đơn, tên khách hàng..." aria-label="Tìm kiếm">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form> -->
        </div>
    </div>

    <!-- Card chứa bảng đơn hàng -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0 fw-bold text-primary">Danh sách đơn hàng</h5>
                </div>
                <!-- <div class="col-auto">
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-filter me-1"></i> Lọc
                        </button>
                        <ul class="dropdown-menu shadow" aria-labelledby="filterDropdown">
                            <li><a class="dropdown-item" href="#">Tất cả đơn hàng</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <?php foreach ($statusOptions as $key => $label): ?>
                                <li><a class="dropdown-item" href="#"><?= $label ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-3">Mã đơn</th>
                            <th class="text-start">Khách hàng</th>
                            <th class="text-center">Ngày đặt</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-end">Tổng tiền</th>
                            <th class="text-center pe-3">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($orders)): ?>
                            <?php foreach ($orders as $order): ?>
                                <?php 
                                    $statusColor = $statusColors[$order['status']] ?? $statusColors['default'];
                                    $statusText = $statusOptions[$order['status']] ?? 'Không rõ'; 
                                ?>
                                <tr>
                                    <td class="ps-3 fw-bold">#<?= htmlspecialchars($order['id']) ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-2 bg-light rounded-circle">
                                                <span class="avatar-text"><?= substr(htmlspecialchars($order['user_name'] ?? $order['user_id']), 0, 1) ?></span>
                                            </div>
                                            <div>
                                                <span class="fw-semibold"><?= htmlspecialchars($order['user_name'] ?? $order['user_id']) ?></span>
                                                <?php if (!empty($order['phone'])): ?>
                                                    <div class="text-muted small"><?= htmlspecialchars($order['phone']) ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="d-block"><?= htmlspecialchars(date('d/m/Y', strtotime($order['order_date']))) ?></span>
                                        <small class="text-muted"><?= htmlspecialchars(date('H:i', strtotime($order['order_date']))) ?></small>
                                    </td>
                                    <td class="text-center">
                                        <form class="d-inline-block status-form" method="POST" action="index.php?page=order&action=update_status" data-current="<?= $order['status'] ?>">
                                            <input type="hidden" name="id" value="<?= (int)$order['id'] ?>">
                                            <select name="status" class="form-select form-select-sm border border-<?= $statusColor ?> text-<?= $statusColor ?>" style="min-width: 140px; font-weight: 500;" onchange="confirmStatusChange(this)">
                                                <?php foreach ($statusOptions as $key => $label): ?>
                                                    <option value="<?= $key ?>" class="text-<?= $statusColors[$key] ?>" <?= $order['status'] === $key ? 'selected' : '' ?>>
                                                        <?= $label ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="text-end fw-bold"><?= number_format($order['total'], 0, ',', '.') ?> ₫</td>
                                    <td class="text-center pe-3">
                                        <button class="btn btn-sm btn-outline-primary me-1" type="button" data-bs-toggle="collapse" data-bs-target="#orderDetail<?= $order['id'] ?>" aria-expanded="false" aria-controls="orderDetail<?= $order['id'] ?>" title="Xem chi tiết">
                                            <i class="fas fa-eye"></i> Chi tiết
                                        </button>
                                    </td>
                                </tr>
                                <tr class="collapse" id="orderDetail<?= $order['id'] ?>">
                                    <td colspan="6" class="p-0">
                                        <div class="card m-2 border-0 shadow-sm">
                                            <div class="card-header bg-light py-2">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h6 class="mb-0">Chi tiết đơn hàng #<?= htmlspecialchars($order['id']) ?></h6>
                                                    </div>
                                                    <div class="col-auto">
                                                        <span class="badge bg-<?= $statusColor ?> rounded-pill"><?= $statusText ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <table class="table table-striped mb-0">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th class="ps-3 text-start">Sản phẩm</th>
                                                            <th class="text-center">Đơn giá</th>
                                                            <th class="text-center">Số lượng</th>
                                                            <th class="text-end pe-3">Thành tiền</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (!empty($order['items'])): ?>
                                                            <?php foreach ($order['items'] as $item): ?>
                                                                <tr>
                                                                    <td class="ps-3 text-start">
                                                                        <div class="d-flex align-items-center">
                                                                            <?php if (!empty($item['product_image'])): ?>
                                                                                <img src="<?= htmlspecialchars($item['product_image']) ?>" alt="" class="img-thumbnail me-2" style="width: 50px; height: 50px; object-fit: cover;">
                                                                            <?php else: ?>
                                                                                <div class="bg-light rounded me-2" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                                                                    <i class="fas fa-box text-secondary"></i>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                            <div>
                                                                                <span class="fw-semibold"><?= htmlspecialchars($item['product_name'] ?? 'Không rõ') ?></span>
                                                                                <?php if (!empty($item['product_code'])): ?>
                                                                                    <div class="text-muted small">SKU: <?= htmlspecialchars($item['product_code']) ?></div>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center"><?= number_format($item['price'], 0, ',', '.') ?> ₫</td>
                                                                    <td class="text-center"><?= (int)$item['quantity'] ?></td>
                                                                    <td class="text-end pe-3 fw-semibold"><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?> ₫</td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            <tr class="border-top">
    <td colspan="3" class="text-end fw-bold">Tổng tiền sản phẩm:</td>
    <td class="text-end pe-3 fw-bold"><?= number_format($order['total'] - 30000, 0, ',', '.') ?> ₫</td>
</tr>
<tr>
    <td colspan="3" class="text-end fw-bold">Phí vận chuyển:</td>
    <td class="text-end pe-3 fw-bold"><?= number_format(30000, 0, ',', '.') ?> ₫</td>
</tr>
<tr>
    <td colspan="3" class="text-end fw-bold fs-5 text-primary">Tổng cộng:</td>
    <td class="text-end pe-3 fw-bold fs-5 text-primary"><?= number_format($order['total'], 0, ',', '.') ?> ₫</td>
</tr>

                                                        <?php else: ?>
                                                            <tr>
                                                                <td colspan="4" class="text-center text-muted py-3">Không có sản phẩm trong đơn hàng này.</td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php if (!empty($order['address']) || !empty($order['note'])): ?>
                                            <div class="card-footer bg-white">
                                                <div class="row g-3">
                                                    <?php if (!empty($order['address'])): ?>
                                                    <div class="col-md-6">
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0">
                                                                <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-1">Địa chỉ giao hàng</h6>
                                                                <p class="mb-0 text-muted"><?= htmlspecialchars($order['address']) ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (!empty($order['note'])): ?>
                                                    <div class="col-md-6">
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0">
                                                                <i class="fas fa-sticky-note text-warning me-2"></i>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-1">Ghi chú</h6>
                                                                <p class="mb-0 text-muted"><?= htmlspecialchars($order['note']) ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="py-5">
                                        <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                                        <h5>Không có đơn hàng nào</h5>
                                        <p class="text-muted">Chưa có đơn hàng nào được tạo.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .avatar {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .avatar-text {
        font-weight: bold;
        text-transform: uppercase;
    }
    
    .form-select {
        background-position: right 0.5rem center;
    }
    
    /* Animation for status changes */
    .status-form select {
        transition: all 0.3s ease;
    }
    
    /* Custom scrollbar for tables */
    .table-responsive::-webkit-scrollbar {
        height: 8px;
    }
    
    .table-responsive::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .table-responsive::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 10px;
    }
    
    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: #aaa;
    }
</style>

<script>
  document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(button => {
    const targetId = button.getAttribute('data-bs-target');
    const collapseEl = document.querySelector(targetId);
    const icon = button.querySelector('i');

    if (!collapseEl) return;

    // Bootstrap 5 dùng event 'shown.bs.collapse' và 'hidden.bs.collapse'
    collapseEl.addEventListener('shown.bs.collapse', () => {
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    });

    collapseEl.addEventListener('hidden.bs.collapse', () => {
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    });
});

    
    // Xác nhận thay đổi trạng thái
    function confirmStatusChange(selectElement) {
        const currentValue = selectElement.getAttribute('data-current');
        const newValue = selectElement.value;
        
        if (currentValue !== newValue) {
            const statusMap = {
                'pending': 'Chờ xử lý',
                'delivering': 'Đang giao',
                'completed': 'Hoàn thành',
            };
            
            if (confirm(`Bạn có chắc muốn thay đổi trạng thái từ "${statusMap[currentValue]}" sang "${statusMap[newValue]}"?`)) {
                selectElement.closest('form').submit();
            } else {
                selectElement.value = currentValue;
            }
        }
    }
    
    // Khởi tạo tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Hiệu ứng khi nhấp vào nút xem chi tiết
    document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(button => {
        button.addEventListener('click', function() {
            const icon = this.querySelector('i');
            if (this.getAttribute('aria-expanded') === 'true') {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
</script>