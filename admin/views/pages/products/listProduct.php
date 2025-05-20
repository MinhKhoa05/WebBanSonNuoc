<?php
$categories = $data['categories'] ?? [];
$productsByCategory = $data['products_by_category'] ?? [];
?>

<?php if (!empty($categories)): ?>
    <?php foreach ($categories as $category): ?>

        <h5 class="mt-5 mb-3 d-flex justify-content-between align-items-center px-3 py-2 rounded"
            style="background-color: #d4edda; font-weight: 600; color: #155724;">
            <span><?= htmlspecialchars($category['name']) ?></span>
            <div>
                <button class="btn btn-sm btn-outline-success me-2"
                    onclick="openEditCategoryModal(<?= (int) $category['id'] ?>, '<?= htmlspecialchars($category['name'], ENT_QUOTES) ?>')">
                    <i class="fas fa-edit"></i> Sửa
                </button>
                <button class="btn btn-sm btn-outline-danger" onclick="confirmDeleteCategory(<?= (int) $category['id'] ?>)">
                    <i class="fas fa-trash"></i> Xóa
                </button>
            </div>
        </h5>

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Mã SP</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Thương hiệu</th>
                        <th>Giá gốc</th>
                        <th>Giá bán (giảm)</th>
                        <th>Tồn kho</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($productsByCategory[$category['id']]['products'])): ?>
                        <?php foreach ($productsByCategory[$category['id']]['products'] as $product): ?>
                            <tr>
                                <td>#<?= htmlspecialchars($product['id'] ?? '') ?></td>
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
                                        data-brand="<?= htmlspecialchars($product['brand_id'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                        data-category="<?= htmlspecialchars($product['category_id'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                        data-thumbnail="<?= htmlspecialchars($product['thumbnail'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                        onclick="openEditProductModal(this)">
                                        <i class="fas fa-edit"></i> Sửa
                                    </button>

                                    <form method="post" action="index.php?page=product&action=soft_delete" class="d-inline"
                                        onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này không?');">
                                        <input type="hidden" name="id" value="<?= (int) $product['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i> Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted">Không có sản phẩm nào trong danh mục này.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="text-center text-muted">Không có danh mục nào.</div>
<?php endif; ?>