<div class="modal fade" id="brandModal" tabindex="-1" aria-labelledby="brandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="brandForm" method="POST" enctype="multipart/form-data">
                <!-- Hidden ID: phân biệt sửa hay thêm -->
                <input type="hidden" id="brandId" name="id">

                <div class="modal-header">
                    <h5 class="modal-title" id="brandModalLabel">Thông tin thương hiệu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>

                <div class="modal-body">
                    <!-- Tên thương hiệu -->
                    <div class="mb-3">
                        <label for="brandName" class="form-label">Tên thương hiệu <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="brandName" name="name" required>
                    </div>

                    <!-- Hình ảnh -->
                    <div class="mb-3">
                        <label for="brandThumbnail" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" id="brandThumbnail" name="thumbnail" accept="image/*">
                        <div id="thumbnailPreviewContainer" class="mt-2 d-none">
                            <img id="thumbnailPreview" src="" alt="Thumbnail Preview" class="img-thumbnail" style="max-height: 150px">
                            <button type="button" class="btn btn-sm btn-outline-danger mt-1" id="removeThumbnail">
                                <i class="fas fa-times"></i> Xóa ảnh
                            </button>
                        </div>
                        <small class="form-text text-muted">Tải lên hình ảnh logo thương hiệu</small>
                    </div>

                    <!-- Mô tả -->
                    <div class="mb-3">
                        <label for="brandDescription" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="brandDescription" name="description" rows="3"></textarea>
                    </div>

                    <!-- Nổi bật -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="brandIsFeatured" name="is_featured" value="1">
                        <label class="form-check-label" for="brandIsFeatured">Thương hiệu nổi bật</label>
                        <small class="form-text text-muted d-block">Thương hiệu nổi bật sẽ được hiển thị ở trang chủ</small>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary" id="submitBrandButton">
                        <i class="fas fa-save me-1"></i> Lưu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>