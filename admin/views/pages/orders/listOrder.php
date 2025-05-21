<?php
$orders = $data['orders'] ?? []; // Dữ liệu đơn hàng

// Hàm map trạng thái sang badge tương ứng
function getStatusBadge($status)
{
    return match ($status) {
        'pending' => '<span class="badge bg-warning text-dark">Chờ xử lý</span>',
        'delivering' => '<span class="badge bg-info">Đang giao</span>',
        'completed' => '<span class="badge bg-success">Hoàn thành</span>',
        'cancelled' => '<span class="badge bg-danger">Đã hủy</span>',
        default => '<span class="badge bg-secondary">Không rõ</span>',
    };
}
?>

<!-- Recent Orders Table -->
<div class="table-responsive">
    <table class="table table-striped align-middle text-center">
        <thead>
            <tr>
                <th>Mã đơn</th>
                <th class="text-start">Khách hàng</th>
                <th>Ngày đặt</th>
                <th>Trạng thái</th>
                <th class="text-end">Tổng tiền</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($orders)): ?>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td>#<?= htmlspecialchars($order['id']) ?></td>
                        <td class="text-start"><?= htmlspecialchars($order['user_name'] ?? $order['user_id']) ?></td>
                        <td><?= htmlspecialchars(date('d/m/Y', strtotime($order['order_date']))) ?></td>
                        <td><?= getStatusBadge($order['status']) ?></td>
                        <td class="text-end fw-bold"><?= number_format($order['total'], 0, ',', '.') ?> đ</td>
                        <td>
                            <a href="index.php?page=order&action=view&id=<?= (int) $order['id'] ?>"
                                class="btn btn-sm btn-primary" title="Xem chi tiết">
                                <i class="fas fa-eye"></i>
                            </a>

                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center text-muted">Không có đơn hàng nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>