<?php
$orders = $data['orders'] ?? [];
?>

<div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Mã đơn hàng</th>
                <th>Người dùng</th>
                <th>Ngày đặt</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ghi chú</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($orders)): ?>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td>#<?= htmlspecialchars($order['id']) ?></td>
                        <td><?= htmlspecialchars($order['user_id']) // Bạn có thể thay bằng tên user nếu join bảng user ?></td>
                        <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($order['order_date']))) ?></td>
                        <td><?= number_format($order['total'], 0, ',', '.') ?> đ</td>
                        <td>
                            <form method="post" action="index.php?page=order&action=update_status" class="d-flex align-items-center gap-2">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($order['id']) ?>">
                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="pending" <?= $order['status'] === 'pending' ? 'selected' : '' ?>>Chờ xử lý</option>
                                    <option value="delivering" <?= $order['status'] === 'delivering' ? 'selected' : '' ?>>Đang giao</option>
                                    <option value="completed" <?= $order['status'] === 'completed' ? 'selected' : '' ?>>Hoàn thành</option>
                                </select>
                            </form>
                        </td>
                        <td><?= nl2br(htmlspecialchars($order['note'] ?? '')) ?></td>
                        <td>
                            <a href="index.php?page=order&action=edit&id=<?= (int)$order['id'] ?>" class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <form method="post" action="index.php?page=order&action=soft_delete" style="display:inline;" onsubmit="return confirm('Bạn có chắc muốn xóa đơn hàng này?');">
                                <input type="hidden" name="id" value="<?= (int)$order['id'] ?>">
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center text-muted">Không có đơn hàng nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
