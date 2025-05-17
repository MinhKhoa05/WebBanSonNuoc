<?php $categories = $data['categories'] ?? []; ?>

<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="productForm" method="POST" enctype="multipart/form-data">
                <!-- Hidden ID: phân biệt sửa hay thêm -->
                <input type="hidden" id="productId" name="id">

                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Thông tin sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>

                <div class="modal-body">
                    <!-- Tên sản phẩm -->
                    <div class="mb-3">
                        <label for="productName" class="form-label">Tên sản phẩm <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="productName" name="name" required>
                    </div>

                    <!-- Mô tả -->
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Mô tả <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control" id="productDescription" name="description" rows="3"
                            required></textarea>
                    </div>

                    <!-- Danh mục -->
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Danh mục <span
                                class="text-danger">*</span></label>
                        <select class="form-select" id="productCategory" name="category_id" required>
                            <option value="" disabled selected>-- Chọn danh mục --</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Giá và giảm giá -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="productPrice" class="form-label">Giá (VNĐ) <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="productPrice" name="price" min="0" step="1000"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="productDiscount" class="form-label">Giảm giá</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="productDiscount" name="discount" min="0"
                                    max="100" step="1">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tồn kho -->
                    <div class="mb-3">
                        <label for="productStock" class="form-label">Số lượng tồn kho <span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="productStock" name="stock" min="0" step="1"
                            required>
                    </div>

                    <!-- Ảnh sản phẩm -->
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Ảnh sản phẩm</label>
                        <input type="file" class="form-control" id="productImage" name="thumbnail"
                            accept=".jpg,.jpeg,.png,.gif,.webp">
                        <div class="text-center mt-3">
                            <img id="currentProductImage" src="" alt="Ảnh hiện tại" class="img-thumbnail shadow-sm"
                                style="max-width: 120px; display: none;">
                            <div class="form-text mt-1" id="imageHelpText">
                                <span id="imageNote">Bắt buộc khi thêm mới, để trống nếu không thay đổi khi sửa.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
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

<script>
    document.getElementById('productImage').addEventListener('change', function (event) {
        const input = event.target;
        const preview = document.getElementById('currentProductImage');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = "";
            preview.style.display = 'none';
        }
    });
</script>