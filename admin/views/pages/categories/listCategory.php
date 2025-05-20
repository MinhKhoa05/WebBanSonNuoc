<?php
$categories = $data['categories'] ?? [];
?>

<div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Mã DM</th>
                <th>Tên danh mục</th>
                <th>Mô tả</th>
                <th>Số sản phẩm</th>
                <!-- <th>Trạng thái</th> -->
                <th>Ngày tạo</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td>#<?= htmlspecialchars($category['id']) ?></td>
                        <td><?= htmlspecialchars($category['name']) ?></td>
                        <td><?= htmlspecialchars($category['description'] ?? 'Không có mô tả') ?></td>
                        <td><?= htmlspecialchars($category['product_count']) ?></td>                           
                        <!-- <td>
                            <form method="post" action="index.php?page=category&action=toggle" style="display:inline;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($category['id']) ?>">
                                <input type="hidden" name="status"
                                    value="<?= (!empty($category['status']) && $category['status'] == 1) ? 0 : 1 ?>">
                                <button type="submit"
                                    class="btn btn-sm <?= (!empty($category['status']) && $category['status'] == 1) ? 'btn-success' : 'btn-danger' ?>">
                                    <?= (!empty($category['status']) && $category['status'] == 1) ? 'Hoạt động' : 'Đã khóa' ?>
                                </button>
                            </form>
                        </td> -->
                        <td><?= date('d/m/Y', strtotime($category['created_at'] ?? 'now')) ?></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary btn-action me-1"
                                data-id="<?= (int) $category['id'] ?>"
                                data-name="<?= htmlspecialchars($category['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                data-description="<?= htmlspecialchars($category['description'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                data-status="<?= htmlspecialchars($category['status'] ?? '1', ENT_QUOTES, 'UTF-8') ?>"
                                onclick="openEditCategoryModal(this)">
                                <i class="fas fa-edit"></i> Sửa
                            </button>

                            <button class="btn btn-sm btn-outline-danger" onclick="confirmDeleteCategory(<?= $category['id'] ?>)">
                                <i class="fas fa-trash"></i> Xóa
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center text-muted">Không có danh mục nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>