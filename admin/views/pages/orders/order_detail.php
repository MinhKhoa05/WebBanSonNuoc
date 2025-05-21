<?php
$orderItems = $data['orderItems'] ?? [];
$order = $data['order'] ?? null;

if (!$order) {
    echo '<div class="alert alert-danger">Không tìm thấy đơn hàng.</div>';
    return;
}
?>

<div class="container mt-5">
    <h2>Chi tiết đơn hàng #<?= htmlspecialchars($order['id']) ?></h2>

    <div class="mb-4">
        <p><strong>Khách hàng:</strong> <?= htmlspecialchars($order['user_name'] ?? 'Không rõ') ?></p>
        <p><strong>Ngày đặt:</strong> <?= date('d/m/Y H:i', strtotime($order['order_date'])) ?></p>
        <p><strong>Trạng thái:</strong>
            <?php
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
            echo getStatusBadge($order['status']);
            ?>
        </p>
        <p><strong>Tổng tiền:</strong> <span class="text-danger fw-bold"><?= number_format($order['total'], 0, ',', '.') ?> đ</span></p>
        <?php if (!empty($order['note'])): ?>
            <p><strong>Ghi chú:</strong> <?= nl2br(htmlspecialchars($order['note'])) ?></p>
        <?php endif; ?>
    </div>

    <h4>Danh sách sản phẩm</h4>
    <?php if (!empty($orderItems)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderItems as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['product_name'] ?? 'Không rõ') ?></td>
                        <td><?= number_format($item['price'], 0, ',', '.') ?> đ</td>
                        <td><?= (int)$item['quantity'] ?></td>
                        <td><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?> đ</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-muted">Không có sản phẩm nào trong đơn hàng này.</p>
    <?php endif; ?>

    <a href="index.php?page=order" class="btn btn-secondary mt-3">← Quay lại danh sách</a>
</div>
