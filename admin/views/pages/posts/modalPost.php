<?php
$categories = $data['categories'] ?? [];
?>

<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="postForm" method="POST" enctype="multipart/form-data" action="index.php?page=post&action=add">
                <!-- Hidden ID: phân biệt sửa hay thêm -->
                <input type="hidden" id="postId" name="id">

                <div class="modal-header">
                    <h5 class="modal-title" id="postModalLabel">Thông tin bài viết</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>

                <div class="modal-body">
                    <!-- Tiêu đề -->
                    <div class="mb-3">
                        <label for="postTitle" class="form-label">Tiêu đề <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="postTitle" name="title" required>
                    </div>

                    <!-- Nội dung -->
                    <div class="mb-3">
                        <label for="postContent" class="form-label">Nội dung <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control" id="postContent" name="content" rows="10"
                            required></textarea>
                    </div>

                    <div class="row">
                        <!-- Danh mục -->
                        <div class="col-md-6 mb-3">
                            <label for="postCategory" class="form-label">Danh mục <span
                                    class="text-danger">*</span></label>
                            <select class="form-select" id="postCategory" name="category_id" required>
                                <option value="" disabled selected>-- Chọn danh mục --</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Loại bài viết -->
                        <div class="col-md-3 mb-3">
                            <label for="postType" class="form-label">Loại bài viết <span
                                    class="text-danger">*</span></label>
                            <select class="form-select" id="postType" name="category" required>
                                <option value="news" selected>Tin tức</option>
                                <option value="blog">Blog</option>
                            </select>
                        </div>

                        <!-- Trạng thái -->
                        <div class="col-md-3 mb-3">
                            <label for="postStatus" class="form-label">Trạng thái <span
                                    class="text-danger">*</span></label>
                            <select class="form-select" id="postStatus" name="status" required>
                                <option value="draft" selected>Bản nháp</option>
                                <option value="published">Xuất bản</option>
                            </select>
                        </div>
                    </div>

                    <!-- Ảnh đại diện -->
                    <div class="mb-3">
                        <label for="postImage" class="form-label">Ảnh đại diện</label>
                        <input type="file" class="form-control" id="postImage" name="thumbnail"
                            accept=".jpg,.jpeg,.png,.gif,.webp">
                        <div class="text-center mt-3">
                            <img id="currentPostImage" src="" alt="Ảnh hiện tại" class="img-thumbnail shadow-sm"
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
    document.getElementById('postImage').addEventListener('change', function(event) {
        const input = event.target;
        const preview = document.getElementById('currentPostImage');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
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