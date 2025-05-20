<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="categoryForm" method="POST" action="index.php?page=product&action=add_category">
                <input type="hidden" id="categoryId" name="id">

                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Thêm danh mục mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Tên danh mục <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="categoryName" name="name" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary" id="submitCategoryButton">
                        <i class="fas fa-save me-1"></i> Thêm
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>