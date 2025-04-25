// Hàm tải sản phẩm qua AJAX
function loadProducts(page = 1) {
    $.ajax({
        url: 'get_products.php', // Đường dẫn đến API PHP
        method: 'GET',
        data: { page: page },
        dataType: 'json',
        success: function (response) {
            const productsList = $('#productsList');
            const pagination = $('#pagination');

            // Xóa nội dung cũ
            productsList.empty();
            pagination.empty();

            // Hiển thị sản phẩm
            if (response.products.length > 0) {
                response.products.forEach(product => {
                    const productCard = `
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card h-100 shadow-sm">
                                <img src="uploads/${product.thumbnail}" class="card-img-top product-img" alt="${product.name}">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">${product.name}</h5>
                                    <p class="card-text text-danger fw-bold">
                                        ${parseInt(product.price).toLocaleString()}₫
                                    </p>
                                    <a href="product-detail.php?id=${product.id}" class="btn btn-outline-primary mt-auto">
                                        Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    `;
                    productsList.append(productCard);
                });
            } else {
                productsList.append('<p class="text-muted text-center">Không có sản phẩm nào để hiển thị.</p>');
            }

            // Hiển thị phân trang
            if (response.totalPages > 1) {
                // Nút "Trước"
                pagination.append(`
                    <li class="page-item ${response.currentPage === 1 ? 'disabled' : ''}">
                        <a class="page-link" href="#" data-page="${response.currentPage - 1}">Trước</a>
                    </li>
                `);

                // Các trang
                for (let i = 1; i <= response.totalPages; i++) {
                    pagination.append(`
                        <li class="page-item ${i === response.currentPage ? 'active' : ''}">
                            <a class="page-link" href="#" data-page="${i}">${i}</a>
                        </li>
                    `);
                }

                // Nút "Sau"
                pagination.append(`
                    <li class="page-item ${response.currentPage === response.totalPages ? 'disabled' : ''}">
                        <a class="page-link" href="#" data-page="${response.currentPage + 1}">Sau</a>
                    </li>
                `);
            }
        },
        error: function () {
            alert('Không thể tải sản phẩm. Vui lòng thử lại sau.');
        }
    });
}

// Xử lý sự kiện khi nhấn vào nút phân trang
$(document).on('click', '.page-link', function (e) {
    e.preventDefault();
    const page = $(this).data('page');
    if (page) {
        loadProducts(page);
    }
});

// Tải sản phẩm khi trang được tải
$(document).ready(function () {
    loadProducts(1); // Tải trang đầu tiên
});

// Hàm xử lý sự kiện khi người dùng thay đổi giá trị của thanh trượt giá
document.addEventListener('DOMContentLoaded', function() {
    const priceRange = document.getElementById('priceRange');
    const priceValue = document.getElementById('priceValue');
    
    priceRange.addEventListener('input', function() {
        priceValue.textContent = new Intl.NumberFormat('vi-VN').format(this.value) + 'đ';
    });
});
