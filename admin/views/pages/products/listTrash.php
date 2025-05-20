<?php
$deletedProducts = $data['deleted_products'] ?? [];
?>

<?php if (!empty($deletedProducts)): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>Mã SP</th>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Thương hiệu</th>
                    <th>Giá gốc</th>
                    <th>Giảm (%)</th>
                    <th>Tồn kho</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($deletedProducts as $product): ?>
                    <tr>
                        <td>#<?= htmlspecialchars($product['id']) ?></td>
                        <td>
                            <?php if (!empty($product['thumbnail'])): ?>
                                <img src="../uploads/<?= htmlspecialchars($product['thumbnail']) ?>" class="img-thumbnail"
                                    alt="<?= htmlspecialchars($product['name']) ?>" style="max-width: 60px;">
                            <?php else: ?>
                                <span class="text-muted">Không có ảnh</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= htmlspecialchars($product['brand_name'] ?? '-- null --') ?></td>
                        <td><?= number_format($product['price'], 0, ',', '.') ?> đ</td>
                        <td><?= htmlspecialchars($product['discount']) ?>%</td>
                        <td><?= htmlspecialchars($product['stock']) ?></td>
                        <td>
                            <!-- Form khôi phục -->
                            <form method="post" action="index.php?page=product&action=restore" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                <button type="submit" class="btn btn-sm btn-outline-success me-1">
                                    <i class="fas fa-undo"></i> Khôi phục
                                </button>
                            </form>

                            <button class="btn btn-sm btn-outline-danger"
                                onclick="confirmDelete(<?= $product['id'] ?>)">
                                <i class="fas fa-times"></i> Xóa vĩnh viễn
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="alert alert-info text-center">Không có sản phẩm nào trong thùng rác.</div>
<?php endif; ?>

