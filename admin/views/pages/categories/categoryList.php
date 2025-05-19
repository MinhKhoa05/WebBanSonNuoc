<?php
$categories = $data['categories'] ?? [];
?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản lý danh mục</h1>
        <button type="button" class="btn btn-primary" onclick="openAddCategoryModal()">
            <i class="fas fa-plus"></i> Thêm danh mục
        </button>
    </div>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách danh mục</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Hình ảnh</th>
                            <th>Tên danh mục</th>
                            <th>Danh mục cha</th>
                            <th>Mô tả</th>
                            <th>Thứ tự</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <tr>
                                    <td>#<?= htmlspecialchars($category['id']) ?></td>
                                    <td>
                                        <?php if (!empty($category['image'])): ?>
                                            <img src="../uploads/<?= htmlspecialchars($category['image']) ?>" class="img-thumbnail"
                                                alt="<?= htmlspecialchars($category['name']) ?>" style="max-width: 60px;">
                                        <?php else: ?>
                                            <span class="text-muted">Không có ảnh</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($category['name']) ?></td>
                                    <td>
                                        <?php if (!empty($category['parent_name'])): ?>
                                            <?= htmlspecialchars($category['parent_name']) ?>
                                        <?php else: ?>
                                            <span class="text-muted">Không có</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($category['description'])): ?>
                                            <?= mb_strlen($category['description']) > 50 ? 
                                                htmlspecialchars(mb_substr($category['description'], 0, 50)) . '...' : 
                                                htmlspecialchars($category['description']) ?>
                                        <?php else: ?>
                                            <span class="text-muted">Không có mô tả</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($category['sort_order'] ?? 0) ?></td>
                                    <td>
                                        <form method="post" action="index.php?page=category&action=toggle" style="display:inline;">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($category['id']) ?>">
                                            <input type="hidden" name="status"
                                                value="<?= (!empty($category['status']) && $category['status'] == 1) ? 0 : 1 ?>">
                                            <button type="submit"
                                                class="btn btn-sm <?= (!empty($category['status']) && $category['status'] == 1) ? 'btn-success' : 'btn-danger' ?>">
                                                <?= (!empty($category['status']) && $category['status'] == 1) ? 'Hiển thị' : 'Ẩn' ?>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-primary btn-action me-1"
                                            data-id="<?= $category['id'] ?>" 
                                            data-name="<?= htmlspecialchars($category['name']) ?>"
                                            data-description="<?= htmlspecialchars($category['description'] ?? '') ?>"
                                            data-parent-id="<?= $category['parent_id'] ?? 0 ?>" 
                                            data-status="<?= $category['status'] ?? 1 ?>"
                                            data-sort-order="<?= $category['sort_order'] ?? 0 ?>"
                                            data-image="<?= $category['image'] ?? '' ?>" 
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
                                <td colspan="8" class="text-center text-muted">Không có danh mục nào.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
// Hàm xác nhận xóa danh mục
function confirmDeleteCategory(categoryId) {
    if (confirm('Bạn có chắc chắn muốn xóa danh mục này? Tất cả sản phẩm thuộc danh mục này cũng sẽ bị ảnh hưởng.')) {
        window.location.href = `index.php?page=category&action=delete&id=${categoryId}`;
    }
}
</script>