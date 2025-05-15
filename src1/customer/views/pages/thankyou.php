<?php
// filepath: c:\xampp\htdocs\src1\customer\views\pages\thankyou.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Hiển thị thông tin đơn hàng vừa đặt thành công
$order_id = $_SESSION['last_order_id'] ?? null;
$order_total = $_SESSION['order_total'] ?? null;

// Nếu không có thông tin đơn hàng, chuyển về trang chủ
if (!$order_id) {
    header('Location: index.php');
    exit;
}
?>

<div class="container py-5">
    <div class="text-center">
        <i class="bi bi-check-circle" style="font-size: 5rem; color: #28a745;"></i>
        <h2 class="mt-3 text-success">Cảm ơn bạn đã đặt hàng!</h2>
        <p class="lead">Đơn hàng của bạn đã được ghi nhận. Chúng tôi sẽ liên hệ xác nhận và giao hàng trong thời gian sớm nhất.</p>
        <div class="my-4">
            <h5>Mã đơn hàng: <span class="text-primary">#<?= htmlspecialchars($order_id) ?></span></h5>
            <?php if ($order_total): ?>
                <h5>Tổng tiền: <span class="text-danger"><?= number_format($order_total, 0, ',', '.') ?>₫</span></h5>
            <?php endif; ?>
        </div>
        <a href="index.php" class="btn btn-primary mt-3">Tiếp tục mua sắm</a>
    </div>
</div>