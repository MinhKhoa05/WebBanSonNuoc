window.openEditCategoryModal = function (id, name) {
    const modal = new bootstrap.Modal(document.getElementById('categoryModal'));
    const form = document.getElementById('categoryForm');

    form.reset();
    form.action = 'index.php?page=product&action=edit_category';

    document.getElementById('categoryId').value = id;
    document.getElementById('categoryName').value = name;
    document.getElementById('submitCategoryButton').innerHTML = '<i class="fas fa-save me-1"></i> Lưu';
    document.getElementById('categoryModalLabel').textContent = 'Chỉnh sửa danh mục';

    modal.show();
};

window.openAddCategoryModal = function (id, name) {
    const modal = new bootstrap.Modal(document.getElementById('categoryModal'));
    const form = document.getElementById('categoryForm');

    form.reset();
    form.action = 'index.php?page=product&action=add_category';

    document.getElementById('submitCategoryButton').innerHTML = '<i class="fas fa-save me-1"></i> Lưu';
    document.getElementById('categoryModalLabel').textContent = 'Thêm danh mục';

    modal.show();
};

window.confirmDeleteCategory = function (id) {
    Swal.fire({
        title: 'Bạn có chắc muốn xóa danh mục này?',
        text: 'Thao tác này không thể hoàn tác!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'index.php?page=product&action=delete_category';

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
