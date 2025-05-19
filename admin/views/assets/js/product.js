document.addEventListener('DOMContentLoaded', function () {
    window.openEditCategoryModal = function (button) {
        const modal = new bootstrap.Modal(document.getElementById('categoryModal'));
        const form = document.getElementById('categoryForm');

        form.action = 'index.php?page=category&action=edit';

        document.getElementById('categoryId').value = button.dataset.id;
        document.getElementById('categoryName').value = button.dataset.name;
        document.getElementById('categoryDescription').value = button.dataset.description;
        
        // Nếu có ảnh danh mục
        const img = document.getElementById('currentCategoryImage');
        if (button.dataset.thumbnail) {
            img.src = '../uploads/' + button.dataset.thumbnail;
            img.style.display = 'block';
            document.getElementById('categoryImageHelpText').textContent = 'Để trống nếu không thay đổi hình ảnh';
        } else {
            img.style.display = 'none';
            img.src = '';
            document.getElementById('categoryImageHelpText').textContent = 'Bạn có thể thêm hình ảnh cho danh mục';
        }

        // Nếu có trường status cho danh mục
        if (document.getElementById('categoryStatus')) {
            document.getElementById('categoryStatus').value = button.dataset.status || '1';
        }

        document.getElementById('categorySubmitButton').textContent = 'Lưu thay đổi';

        modal.show();
    };

    window.openAddCategoryModal = function () {
        const modal = new bootstrap.Modal(document.getElementById('categoryModal'));
        const form = document.getElementById('categoryForm');

        form.action = 'index.php?page=category&action=add';
        form.reset();

        document.getElementById('categoryId').value = '';
        
        // Ẩn hình ảnh hiện tại
        document.getElementById('currentCategoryImage').style.display = 'none';
        document.getElementById('categoryImageHelpText').textContent = 'Bạn có thể thêm hình ảnh cho danh mục';
        
        // Nếu có trường status, đặt mặc định là active (1)
        if (document.getElementById('categoryStatus')) {
            document.getElementById('categoryStatus').value = '1';
        }

        document.getElementById('categorySubmitButton').textContent = 'Thêm';

        modal.show();
    };

    window.confirmDeleteCategory = function (id) {
        Swal.fire({
            title: 'Bạn có chắc muốn xóa danh mục này?',
            text: 'Xóa danh mục có thể ảnh hưởng đến các sản phẩm liên quan!',
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