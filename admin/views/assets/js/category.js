document.addEventListener('DOMContentLoaded', function () {
    window.openEditCategoryModal = function (button) {
        const modal = new bootstrap.Modal(document.getElementById('categoryModal'));
        const form = document.getElementById('categoryForm');

        form.action = 'index.php?page=category&action=edit';

        document.getElementById('categoryId').value = button.dataset.id;
        document.getElementById('categoryName').value = button.dataset.name;
        document.getElementById('categoryDescription').value = button.dataset.description;
        document.getElementById('categoryStatus').value = button.dataset.status;

        document.getElementById('submitCategoryButton').textContent = 'Lưu thay đổi';
        document.getElementById('categoryModalLabel').textContent = 'Sửa danh mục';

        modal.show();
    };

    window.openAddCategoryModal = function () {
        const modal = new bootstrap.Modal(document.getElementById('categoryModal'));
        const form = document.getElementById('categoryForm');

        form.action = 'index.php?page=category&action=add';
        form.reset();

        document.getElementById('categoryId').value = '';
        document.getElementById('categoryStatus').value = '1';

        document.getElementById('submitCategoryButton').innerHTML = '<i class="fas fa-plus-circle me-1"></i> Thêm';
        document.getElementById('categoryModalLabel').textContent = 'Thêm danh mục mới';

        modal.show();
    };

    window.confirmDeleteCategory = function (id) {
        Swal.fire({
            title: 'Bạn có chắc muốn xóa danh mục này?',
            text: 'Xóa danh mục có thể ảnh hưởng đến sản phẩm liên quan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Có, xóa nó!',
            cancelButtonText: 'Hủy',
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'index.php?page=category&action=delete';

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