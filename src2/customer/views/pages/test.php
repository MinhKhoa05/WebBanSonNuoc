<?php
// filepath: c:\xampp\htdocs\WebBanSonLuc\views\pages\customer\cart.php
session_start();
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>

<div class="container py-5">
    <h1 class="mb-4">Giỏ hàng</h1>
    <?php if (!empty($cart)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart as $item): ?>
                    <tr>
                        <td><img src="uploads/<?= htmlspecialchars($item['thumbnail']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="width: 80px; height: 80px;"></td>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td><?= number_format($item['price'], 0, ',', '.') ?>₫</td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>₫</td>
                        <td>
                            <a href="index.php?page=cart&action=remove&id=<?= $item['id'] ?>" class="btn btn-danger btn-sm">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">Giỏ hàng của bạn đang trống.</p>
    <?php endif; ?>
</div>