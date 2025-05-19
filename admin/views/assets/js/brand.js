document.addEventListener('DOMContentLoaded', function () {
    // Handle thumbnail preview
    const thumbnailInput = document.getElementById('brandThumbnail');
    const thumbnailPreview = document.getElementById('thumbnailPreview');
    const thumbnailPreviewContainer = document.getElementById('thumbnailPreviewContainer');
    const removeThumbnailBtn = document.getElementById('removeThumbnail');

    if (thumbnailInput) {
        thumbnailInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    thumbnailPreview.src = e.target.result;
                    thumbnailPreviewContainer.classList.remove('d-none');
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    if (removeThumbnailBtn) {
        removeThumbnailBtn.addEventListener('click', function() {
            thumbnailInput.value = '';
            thumbnailPreviewContainer.classList.add('d-none');
        });
    }

    // Modal functions
    window.openEditBrandModal = function (button) {
        const modal = new bootstrap.Modal(document.getElementById('brandModal'));
        const form = document.getElementById('brandForm');

        form.action = 'index.php?page=brand&action=edit';
        form.enctype = 'multipart/form-data';

        document.getElementById('brandId').value = button.dataset.id;
        document.getElementById('brandName').value = button.dataset.name;
        document.getElementById('brandDescription').value = button.dataset.description;
        
        // Handle featured checkbox
        const isFeatured = parseInt(button.dataset.isFeatured);
        document.getElementById('brandIsFeatured').checked = isFeatured === 1;

        // Handle thumbnail preview for edit
        const thumbnailPath = button.dataset.thumbnail;
        if (thumbnailPath) {
            thumbnailPreview.src = thumbnailPath;
            thumbnailPreviewContainer.classList.remove('d-none');
        } else {
            thumbnailPreviewContainer.classList.add('d-none');
        }

        document.getElementById('submitBrandButton').innerHTML = '<i class="fas fa-save me-1"></i> Lưu thay đổi';
        document.getElementById('brandModalLabel').textContent = 'Sửa thương hiệu';

        modal.show();
    };

    window.openAddBrandModal = function () {
        const modal = new bootstrap.Modal(document.getElementById('brandModal'));
        const form = document.getElementById('brandForm');

        form.action = 'index.php?page=brand&action=add';
        form.enctype = 'multipart/form-data';
        form.reset();

        document.getElementById('brandId').value = '';
        thumbnailPreviewContainer.classList.add('d-none');

        document.getElementById('submitBrandButton').innerHTML = '<i class="fas fa-plus-circle me-1"></i> Thêm';
        document.getElementById('brandModalLabel').textContent = 'Thêm thương hiệu mới';

        modal.show();
    };

    window.confirmDeleteBrand = function (id) {
        Swal.fire({
            title: 'Bạn có chắc muốn xóa thương hiệu này?',
            text: 'Xóa thương hiệu có thể ảnh hưởng đến sản phẩm liên quan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Có, xóa nó!',
            cancelButtonText: 'Hủy',
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'index.php?page=brand&action=delete';

                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'id';
                input.value = id;
                form.appendChild(input);

                document.body.appendChild(form);
                form.submit();
            }
        });
    };
});