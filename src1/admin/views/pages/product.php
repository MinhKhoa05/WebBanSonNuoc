<?php
$products = $data['products'] ?? [];
$categories = $data['categories'] ?? [];
?>

<style>
    .img-thumbnail {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 8px;
    }

    .table td,
    .table th {
        vertical-align: middle !important;
        text-align: center;
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.4em 0.7em;
        border-radius: 0.5rem;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.25rem 0.6rem;
    }

    .modal .form-label {
        font-weight: 500;
    }

    .modal .form-control,
    .modal .form-select {
        border-radius: 0.5rem;
    }

    #currentProductImage {
        border: 1px solid #ddd;
        padding: 4px;
        border-radius: 6px;
        background: #f8f8f8;
    }
</style>

<div class="row" id="productManagement">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Quản lý sản phẩm</h6>
                <button class="btn btn-primary" onclick="openAddProductModal()">
                    <i class="fas fa-plus me-1"></i> Thêm sản phẩm
                </button>
            </div>
            <div class="card-body">
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
                                            <img src="../uploads/<?= htmlspecialchars($product['thumbnail']) ?>" class="img-thumbnail" alt="<?= htmlspecialchars($product['name']) ?>">
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

                                            <form method="POST" action="index.php?page=product&action=delete" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
                                                <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
                                                <button type="submit" class="btn btn-sm btn-outline-danger btn-action">
                                                    <i class="fas fa-trash"></i> Xóa
                                                </button>
                                            </form>
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
            </div>
        </div>
    </div>
</div>

<!-- Modal Thêm/Sửa sản phẩm -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="productForm" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="productId" name="id" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Thêm sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="productName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="productDescription" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Danh mục</label>
                        <select class="form-select" id="productCategory" name="category_id" required>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Giá bán</label>
                        <input type="number" class="form-control" id="productPrice" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="productDiscount" class="form-label">Giảm giá (%)</label>
                        <input type="number" class="form-control" id="productDiscount" name="discount">
                    </div>
                    <div class="mb-3">
                        <label for="productStock" class="form-label">Tồn kho</label>
                        <input type="number" class="form-control" id="productStock" name="stock" required>
                    </div>
                    <div class="mb-3">
                        <label for="productStatus" class="form-label">Trạng thái</label>
                        <select class="form-select" id="productStatus" name="status" required>
                            <option value="1">Còn hàng</option>
                            <option value="0">Hết hàng</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" id="productImage" name="thumbnail" accept=".jpg,.jpeg,.png,.gif,.webp">
                        <div class="text-center mt-2">
                            <img id="currentProductImage" src="" alt="Hình ảnh hiện tại" style="max-width:100px; max-height:100px; display:none;">
                            <div class="form-text mt-1" id="imageHelpText">Bắt buộc với thêm mới, để trống nếu không thay đổi hình ảnh khi sửa.</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary" id="submitButton">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openEditProductModal(product) {
        const modal = new bootstrap.Modal(document.getElementById('productModal'));
        const form = document.getElementById('productForm');

        form.action = 'index.php?page=product&action=edit';

        document.getElementById('productId').value = product.id;
        document.getElementById('productName').value = product.name;
        document.getElementById('productDescription').value = product.description;
        document.getElementById('productCategory').value = product.category_id;
        document.getElementById('productPrice').value = product.price;
        document.getElementById('productDiscount').value = product.discount;
        document.getElementById('productStock').value = product.stock;
        document.getElementById('productStatus').value = product.status;

        const img = document.getElementById('currentProductImage');
        if (product.thumbnail) {
            img.src = '../uploads/' + product.thumbnail;
            img.style.display = 'block';
            document.getElementById('imageHelpText').textContent = 'Để trống nếu không thay đổi hình ảnh';
        } else {
            img.style.display = 'none';
            document.getElementById('imageHelpText').textContent = 'Bạn có thể thêm hình ảnh cho sản phẩm';
        }

        document.getElementById('submitButton').textContent = 'Lưu thay đổi';

        modal.show();
    }

    function openAddProductModal() {
        const modal = new bootstrap.Modal(document.getElementById('productModal'));
        const form = document.getElementById('productForm');

        form.action = 'index.php?page=product&action=add';

        form.reset();
        document.getElementById('productId').value = '';
        document.getElementById('currentProductImage').style.display = 'none';
        document.getElementById('imageHelpText').textContent = 'Bắt buộc với thêm mới, để trống nếu không thay đổi hình ảnh khi sửa.';
        document.getElementById('submitButton').textContent = 'Thêm';

        modal.show();
    }
</script>
