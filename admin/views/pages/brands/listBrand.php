<?php
$brands = $data['brands'] ?? [];
?>

<div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Mã TH</th>
                <th>Tên thương hiệu</th>
                <th>Hình ảnh</th>
                <th>Mô tả</th>
                <th>Số sản phẩm</th>
                <th>Nổi bật</th>
                <th>Ngày tạo</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($brands)): ?>
                <?php foreach ($brands as $brand): ?>
                    <tr>
                        <td>#<?= htmlspecialchars($brand['id']) ?></td>
                        <td><?= htmlspecialchars($brand['name']) ?></td>
                        <td>
                            <?php if (!empty($brand['thumbnail'])): ?>
                                <img src="<?= htmlspecialchars($brand['thumbnail']) ?>" alt="<?= htmlspecialchars($brand['name']) ?>" class="brand-thumbnail">
                            <?php else: ?>
                                <span class="text-muted">Không có ảnh</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($brand['description'] ?? 'Không có mô tả') ?></td>
                        <td>
                            <?php 
                                $brandModel = new BrandModel();
                                $productCount = $brandModel->count_products($brand['id']);
                                echo $productCount;
                            ?>
                        </td>
                        <td>
                            <form method="post" action="index.php?page=brand&action=toggle_featured" style="display:inline;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($brand['id']) ?>">
                                <input type="hidden" name="is_featured"
                                    value="<?= (!empty($brand['is_featured']) && $brand['is_featured'] == 1) ? 0 : 1 ?>">
                                <button type="submit"
                                    class="btn btn-sm <?= (!empty($brand['is_featured']) && $brand['is_featured'] == 1) ? 'btn-success' : 'btn-secondary' ?>">
                                    <?= (!empty($brand['is_featured']) && $brand['is_featured'] == 1) ? 'Nổi bật' : 'Bình thường' ?>
                                </button>
                            </form>
                        </td>
                        <td><?= date('d/m/Y', strtotime($brand['created_at'] ?? 'now')) ?></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary btn-action me-1"
                                data-id="<?= (int) $brand['id'] ?>"
                                data-name="<?= htmlspecialchars($brand['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                data-description="<?= htmlspecialchars($brand['description'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                data-thumbnail="<?= htmlspecialchars($brand['thumbnail'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                data-is-featured="<?= htmlspecialchars($brand['is_featured'] ?? '0', ENT_QUOTES, 'UTF-8') ?>"
                                onclick="openEditBrandModal(this)">
                                <i class="fas fa-edit"></i> Sửa
                            </button>

                            <button class="btn btn-sm btn-outline-danger" onclick="confirmDeleteBrand(<?= $brand['id'] ?>)">
                                <i class="fas fa-trash"></i> Xóa
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center text-muted">Không có thương hiệu nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include_once 'modalBrand.php'; ?>