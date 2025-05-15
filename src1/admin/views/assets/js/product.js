function openEditProductModal(product) {
    const modal = new bootstrap.Modal(document.getElementById('productModal'));
    const form = document.getElementById('productForm');

    form.action = 'index.php?page=product&action=edit';

    document.getElementById('productId').value = product.id;
    document.getElementById('productName').value = product.name;
    document.getElementById('productDescription').value = product.description;
    document.getElementById('productCategory').value = product.category_id;
    document.getElementById('productPrice').value = product.price;
    document.getElementById('productDiscount').value = product.discount;
    document.getElementById('productStock').value = product.stock;
    document.getElementById('productStatus').value = product.status;

    const img = document.getElementById('currentProductImage');
    if (product.thumbnail) {
        img.src = '../uploads/' + product.thumbnail;
        img.style.display = 'block';
        document.getElementById('imageHelpText').textContent = 'Để trống nếu không thay đổi hình ảnh';
    } else {
        img.style.display = 'none';
        document.getElementById('imageHelpText').textContent = 'Bạn có thể thêm hình ảnh cho sản phẩm';
    }

    document.getElementById('submitButton').textContent = 'Lưu thay đổi';

    modal.show();
}

function openAddProductModal() {
    const modal = new bootstrap.Modal(document.getElementById('productModal'));
    const form = document.getElementById('productForm');

    form.action = 'index.php?page=product&action=add';

    form.reset();
    document.getElementById('productId').value = '';
    document.getElementById('currentProductImage').style.display = 'none';
    document.getElementById('imageHelpText').textContent = 'Bắt buộc với thêm mới, để trống nếu không thay đổi hình ảnh khi sửa.';
    document.getElementById('submitButton').textContent = 'Thêm';

    modal.show();
}