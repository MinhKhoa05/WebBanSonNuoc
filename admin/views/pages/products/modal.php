<?php
$categories = $data['categories'] ?? [];
?>

<!-- Modal Thêm/Sửa sản phẩm -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- To rộng hơn -->
        <div class="modal-content">
            <form id="productForm" method="POST" enctype="multipart/form-data" novalidate>
                <input type="hidden" id="productId" name="id" value="">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="productModalLabel">Thêm sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="productName" class="form-label fw-semibold">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="productName" name="name" placeholder="Nhập tên sản phẩm" required>
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label fw-semibold">Mô tả</label>
                        <textarea class="form-control" id="productDescription" name="description" rows="3" placeholder="Mô tả chi tiết sản phẩm" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="productCategory" class="form-label fw-semibold">Danh mục</label>
                        <select class="form-select" id="productCategory" name="category_id" required>
                            <option value="" disabled selected>-- Chọn danh mục --</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="productPrice" class="form-label fw-semibold">Giá bán (VNĐ)</label>
                            <input type="number" min="0" step="1000" class="form-control" id="productPrice" name="price" placeholder="0" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="productDiscount" class="form-label fw-semibold">Giảm giá (%)</label>
                            <div class="input-group">
                                <input type="number" min="0" max="100" step="1" class="form-control" id="productDiscount" name="discount" placeholder="0">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="productStock" class="form-label fw-semibold">Tồn kho</label>
                            <input type="number" min="0" step="1" class="form-control" id="productStock" name="stock" placeholder="0" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="productStatus" class="form-label fw-semibold">Trạng thái</label>
                            <select class="form-select" id="productStatus" name="status" required>
                                <option value="1">Còn hàng</option>
                                <option value="0">Hết hàng</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label fw-semibold">Hình ảnh</label>
                        <input type="file" class="form-control" id="productImage" name="thumbnail" accept=".jpg,.jpeg,.png,.gif,.webp" >
                        <div class="text-center mt-3">
                            <img id="currentProductImage" src="" alt="Hình ảnh hiện tại" class="img-thumbnail shadow-sm" style="max-width:120px; display:none;">
                            <div class="form-text mt-1" id="imageHelpText">
                                Bắt buộc với thêm mới, để trống nếu không thay đổi hình ảnh khi sửa.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary" id="submitButton">
                        <i class="fas fa-save me-1"></i> Lưu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
