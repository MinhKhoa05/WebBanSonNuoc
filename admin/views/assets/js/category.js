document.addEventListener('DOMContentLoaded', function () {
    window.openAddCategoryModal = function () {
        const modal = new bootstrap.Modal(document.getElementById('categoryModal'));
        const form = document.getElementById('categoryForm');

        // Thiết lập form cho thêm mới
        form.reset();
        form.action = 'index.php?page=category&action=add';

        // Cập nhật tiêu đề và nút submit
        document.getElementById('categoryModalLabel').textContent = 'Thêm danh mục';
        document.getElementById('categorySubmitButton').textContent = 'Thêm mới';

        // Ẩn hình ảnh hiện tại (nếu có)
        const img = document.getElementById('currentCategoryImage');
        img.style.display = 'none';
        img.src = '';
        document.getElementById('categoryImageHelpText').textContent = 'Hình ảnh đại diện cho danh mục (không bắt buộc)';

        // Hiển thị modal
        modal.show();
    };

    // Hàm mở modal chỉnh sửa danh mục
    window.openEditCategoryModal = function (button) {
        try {
            // Kiểm tra xem button có tồn tại không
            if (!button) {
                console.error('Button không được cung cấp cho hàm openEditCategoryModal');
                return;
            }

            // Lấy tham chiếu đến modal và form
            const modalElement = document.getElementById('categoryModal');
            if (!modalElement) {
                console.error('Không tìm thấy phần tử với ID categoryModal');
                return;
            }

            const modal = new bootstrap.Modal(modalElement);

            const form = document.getElementById('categoryForm');
            if (!form) {
                console.error('Không tìm thấy phần tử với ID categoryForm');
                return;
            }

            // Thiết lập form cho chỉnh sửa
            form.reset();
            form.action = 'index.php?page=category&action=edit';

            // Cập nhật các trường dữ liệu từ button
            document.getElementById('categoryId').value = button.dataset.id;
            document.getElementById('categoryName').value = button.dataset.name;
            document.getElementById('categoryDescription').value = button.dataset.description || '';

            // Thiết lập danh mục cha nếu có
            const parentSelect = document.getElementById('categoryParent');
            if (parentSelect) {
                parentSelect.value = button.dataset.parentId || '0';
            }

            // Thiết lập trạng thái
            const statusSelect = document.getElementById('categoryStatus');
            if (statusSelect) {
                statusSelect.value = button.dataset.status || '1';
            }

            // Thiết lập thứ tự hiển thị
            document.getElementById('categorySortOrder').value = button.dataset.sortOrder || '0';

            // Cập nhật hình ảnh nếu có
            const img = document.getElementById('currentCategoryImage');
            if (button.dataset.image) {
                img.src = '../uploads/' + button.dataset.image;
                img.style.display = 'block';
                document.getElementById('categoryImageHelpText').textContent = 'Để trống nếu không thay đổi hình ảnh';
            } else {
                img.style.display = 'none';
                img.src = '';
                document.getElementById('categoryImageHelpText').textContent = 'Bạn có thể thêm hình ảnh cho danh mục';
            }

            // Cập nhật tiêu đề và nút submit
            document.getElementById('categoryModalLabel').textContent = 'Chỉnh sửa danh mục';
            document.getElementById('categorySubmitButton').textContent = 'Lưu thay đổi';

            // Hiển thị modal
            modal.show();
            console.log('Modal đã được mở để chỉnh sửa danh mục có ID:', button.dataset.id);
        } catch (error) {
            console.error('Lỗi khi mở modal chỉnh sửa danh mục:', error);
        }
    };

    window.confirmDelete = function (id) {
        Swal.fire({
            title: 'Bạn có chắc muốn xóa danh mục này?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Có, xóa nó!',
            cancelButtonText: 'Hủy',
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'index.php?page=cattegory&action=delete';

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