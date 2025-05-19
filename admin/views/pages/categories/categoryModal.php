<?php /* Không cần lấy dữ liệu bổ sung cho modal danh mục */ ?>

<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="categoryForm" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="categoryId" name="id">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Thêm danh mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Tên danh mục</label>
                        <input type="text" class="form-control" id="categoryName" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="categoryDescription" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="categoryDescription" name="description" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="categoryParent" class="form-label">Danh mục cha</label>
                        <select class="form-select" id="categoryParent" name="parent_id">
                            <option value="0">-- Không có danh mục cha --</option>
                            <?php if(isset($categories) && !empty($categories)): ?>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="categoryStatus" class="form-label">Trạng thái</label>
                        <select class="form-select" id="categoryStatus" name="status">
                            <option value="1">Hiển thị</option>
                            <option value="0">Ẩn</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="categoryImage" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" id="categoryImage" name="image" accept=".jpg,.jpeg,.png,.gif,.webp">
                        <div class="text-center mt-3">
                            <img id="currentCategoryImage" src="" class="img-thumbnail shadow-sm" style="max-width:120px; display:none;">
                            <div class="form-text mt-1" id="categoryImageHelpText">
                                Hình ảnh đại diện cho danh mục (không bắt buộc)
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="categorySortOrder" class="form-label">Thứ tự hiển thị</label>
                        <input type="number" class="form-control" id="categorySortOrder" name="sort_order" min="0" value="0">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary" id="categorySubmitButton">
                        <i class="fas fa-save me-1"></i> Lưu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

