document.addEventListener('DOMContentLoaded', function () {
    window.openEditProductModal = function (button) {
        const modal = new bootstrap.Modal(document.getElementById('productModal'));
        const form = document.getElementById('productForm');

        form.action = 'index.php?page=product&action=edit';

        document.getElementById('productId').value = button.dataset.id;
        document.getElementById('productName').value = button.dataset.name;
        document.getElementById('productDescription').value = button.dataset.description;
        document.getElementById('productCategory').value = button.dataset.category;
        document.getElementById('productBrand').value = button.dataset.brand; // Add this line
        document.getElementById('productPrice').value = button.dataset.price;
        document.getElementById('productDiscount').value = button.dataset.discount;
        document.getElementById('productStock').value = button.dataset.stock;

        const img = document.getElementById('currentProductImage');
        if (button.dataset.thumbnail) {
            img.src = '../uploads/' + button.dataset.thumbnail;
            img.style.display = 'block';
            document.getElementById('imageHelpText').textContent = 'Để trống nếu không thay đổi hình ảnh';
        } else {
            img.style.display = 'none';
            img.src = '';
            document.getElementById('imageHelpText').textContent = 'Bạn có thể thêm hình ảnh cho sản phẩm';
        }

        document.getElementById('submitButton').textContent = 'Lưu thay đổi';

        modal.show();
    };

    window.openAddProductModal = function () {
        const modal = new bootstrap.Modal(document.getElementById('productModal'));
        const form = document.getElementById('productForm');

        form.action = 'index.php?page=product&action=add';
        form.reset();

        document.getElementById('productId').value = '';
        document.getElementById('productDiscount').value = 0;

        document.getElementById('currentProductImage').style.display = 'none';
        document.getElementById('imageHelpText').textContent = 'Bắt buộc với thêm mới, để trống nếu không thay đổi hình ảnh khi sửa.';
        document.getElementById('submitButton').textContent = 'Thêm';

        const discountTypeGroup = document.getElementById('discountTypeGroup');
        if (discountTypeGroup) {
            discountTypeGroup.style.display = 'none';
        }

        modal.show();
    };

    window.confirmDelete = function (id) {
        Swal.fire({
            title: 'Bạn có chắc muốn xóa vĩnh viễn sản phẩm này?',
            text: 'Thao tác này không thể hoàn tác!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Có, xóa nó!',
            cancelButtonText: 'Hủy',
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'index.php?page=product&action=delete';
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