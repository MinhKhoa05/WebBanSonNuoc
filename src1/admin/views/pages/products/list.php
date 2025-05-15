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
                <th>Giá bán</th>
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
                            <img src="../uploads/<?= htmlspecialchars($product['thumbnail']) ?>" class="img-thumbnail"
                                alt="<?= htmlspecialchars($product['name']) ?>">
                        </td>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= htmlspecialchars($product['category_name']) ?></td>
                        <td><?= number_format($product['price'], 0, ',', '.') ?> đ</td>
                        <td><?= htmlspecialchars($product['stock']) ?></td>
                        <td>
                            <?php if ($product['status'] === 'active'): ?>
                                <span class="badge bg-success">Còn hàng</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Hết hàng</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary btn-action me-1" onclick='openEditProductModal(<?= json_encode([
                                'id' => $product['id'],
                                'name' => $product['name'],
                                'description' => $product['description'],
                                'price' => $product['price'],
                                'discount' => $product['discount'],
                                'stock' => $product['stock'],
                                'status' => $product['status'] === 'active' ? 1 : 0,
                                'category_id' => $product['category_id'],
                                'thumbnail' => $product['thumbnail']
                            ]) ?>)'>
                                <i class="fas fa-edit"></i> Sửa
                            </button>

                            <button class="btn btn-sm btn-outline-danger btn-action"
                                onclick="confirmDelete(<?= $product['id'] ?>)">
                                <i class="fas fa-trash"></i> Xóa
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">Không có sản phẩm nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>