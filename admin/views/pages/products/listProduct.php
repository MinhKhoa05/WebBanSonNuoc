<?php
$products = $data['products'] ?? [];
?>

<div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Mã SP</th>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Giá gốc</th>
                <th>Giá bán (giảm)</th>
                <th>Tồn kho</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
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
                        <td><?= htmlspecialchars($product['category_name'] ?? '') ?></td>
                        <td><?= number_format($product['price'], 0, ',', '.') ?> đ</td>
                        <td>
                            <?= number_format($product['final_price'], 0, ',', '.') ?> đ
                            <small class="text-muted">(<?= $product['discount'] ?>%)</small>
                        </td>
                        <td><?= htmlspecialchars($product['stock']) ?></td>
                        <td>
                            <form method="post" action="index.php?page=product&action=toggle" style="display:inline;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
                                <input type="hidden" name="view"
                                    value="<?= (!empty($product['view']) && $product['view'] == 1) ? 0 : 1 ?>">
                                <button type="submit"
                                    class="btn btn-sm <?= (!empty($product['view']) && $product['view'] == 1) ? 'btn-success' : 'btn-danger' ?>">
                                    <?= (!empty($product['view']) && $product['view'] == 1) ? 'Đang bán' : 'Ngừng bán' ?>
                                </button>
                            </form>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary btn-action me-1"
                                data-id="<?= (int) $product['id'] ?>"
                                data-name="<?= htmlspecialchars($product['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                data-description="<?= htmlspecialchars($product['description'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                data-price="<?= htmlspecialchars($product['price'] ?? '0', ENT_QUOTES, 'UTF-8') ?>"
                                data-discount="<?= htmlspecialchars($product['discount'] ?? '0', ENT_QUOTES, 'UTF-8') ?>"
                                data-stock="<?= htmlspecialchars($product['stock'] ?? '0', ENT_QUOTES, 'UTF-8') ?>"
                                data-category="<?= htmlspecialchars($product['category_id'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                data-thumbnail="<?= htmlspecialchars($product['thumbnail'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                onclick="openEditProductModal(this)">
                                <i class="fas fa-edit"></i> Sửa
                            </button>

                            <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete(<?= $product['id'] ?>)">
                                <i class="fas fa-trash"></i> Xóa
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="text-center text-muted">Không có sản phẩm nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>