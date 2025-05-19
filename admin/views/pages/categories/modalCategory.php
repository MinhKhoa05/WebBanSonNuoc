<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="categoryForm" method="POST">
                <!-- Hidden ID: phân biệt sửa hay thêm -->
                <input type="hidden" id="categoryId" name="id">

                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Thông tin danh mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>

                <div class="modal-body">
                    <!-- Tên danh mục -->
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Tên danh mục <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="categoryName" name="name" required>
                    </div>

                    <!-- Mô tả -->
                    <div class="mb-3">
                        <label for="categoryDescription" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="categoryDescription" name="description" rows="3"></textarea>
                    </div>

                    <!-- Trạng thái -->
                    <div class="mb-3">
                        <label for="categoryStatus" class="form-label">Trạng thái</label>
                        <select class="form-select" id="categoryStatus" name="status" required>
                            <option value="1">Hoạt động</option>
                            <option value="0">Không hoạt động</option>
                        </select>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary" id="submitCategoryButton">
                        <i class="fas fa-save me-1"></i> Lưu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>