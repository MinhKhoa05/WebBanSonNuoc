// Lọc sản phẩm theo danh mục
// document.addEventListener('DOMContentLoaded', function () {
//     const sidebarLinks = document.querySelectorAll('.sidebar-link');
//     const productsList = document.getElementById('productsList');
//     const productCount = document.getElementById('productCount');

//     sidebarLinks.forEach(link => {
//         link.addEventListener('click', function (e) {
//             e.preventDefault();
            
//             // Add active class to the clicked link and remove from others
//             sidebarLinks.forEach(l => l.classList.remove('active'));
//             this.classList.add('active');
            
//             const categoryId = this.getAttribute('data-filter');
            
//             // Show loading indicator
//             productsList.innerHTML = '<div class="col-12 text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';

//             // Send AJAX request to get products by category
//             fetch(`customer/ajax/filter-products.php?category_id=${categoryId}`)
//                 .then(response => {
//                     if (!response.ok) {
//                         throw new Error('Network response was not ok');
//                     }
//                     return response.json();
//                 })
//                 .then(data => {
//                     // Clear current product list
//                     productsList.innerHTML = '';
                    
//                     // Update product count
//                     if (productCount) {
//                         productCount.textContent = data.length;
//                     }

//                     // Display new products
//                     if (data.length > 0) {
//                         data.forEach(product => {
//                             // Create thumbnail URL with error fallback
//                             const thumbnailUrl = product.thumbnail ? 
//                                 `uploads/${product.thumbnail}` : 
//                                 'customer/views/assets/images/default-product.png';
                            
//                             // Format price
//                             const formattedPrice = new Intl.NumberFormat('vi-VN').format(product.price) + '₫';
                            
//                             const productHTML = `
//                                 <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
//                                     <div class="card card-product h-100 shadow">
//                                         <img src="${thumbnailUrl}" class="card-img-top product-img" 
//                                             alt="${product.name}"
//                                             onerror="this.onerror=null; this.src='customer/views/assets/images/default-product.png';">
//                                         <div class="card-body d-flex flex-column">
//                                             <h5 class="card-title">${product.name}</h5>
//                                             <p class="card-text text-danger fw-bold">
//                                                 ${formattedPrice}
//                                             </p>
//                                             <a href="index.php?page=product-detail&id=${product.id}" class="btn btn-outline-primary mt-auto">
//                                                 Xem chi tiết
//                                             </a>
//                                         </div>
//                                     </div>
//                                 </div>
//                             `;
//                             productsList.insertAdjacentHTML('beforeend', productHTML);
//                         });
//                     } else {
//                         productsList.innerHTML = '<div class="col-12"><p class="text-muted text-center">Không có sản phẩm nào trong danh mục này.</p></div>';
//                     }
//                 })
//                 .catch(error => {
//                     console.error('Error:', error);
//                     productsList.innerHTML = '<div class="col-12"><p class="text-danger text-center">Đã xảy ra lỗi khi tải sản phẩm. Vui lòng thử lại sau.</p></div>';
//                 });
//         });
//     });
// });

// Lọc sản phẩm theo từ khóa giá
document.addEventListener('DOMContentLoaded', function () {
    const priceRange = document.getElementById('priceRange');
    const priceValue = document.getElementById('priceValue');
    const applyPriceFilter = document.getElementById('applyPriceFilter');
    const productsList = document.getElementById('productsList');

    // Cập nhật giá trị hiển thị khi thay đổi thanh trượt
    priceRange.addEventListener('input', function () {
        priceValue.textContent = new Intl.NumberFormat('vi-VN').format(this.value) + 'đ';
    });

    // Xử lý khi nhấn nút "Áp dụng"
    applyPriceFilter.addEventListener('click', function () {
        const maxPrice = priceRange.value;

        // Gửi yêu cầu AJAX để lọc sản phẩm theo giá
        fetch(`filter-products.php?max_price=${maxPrice}`)
            .then(response => response.json())
            .then(data => {
                // Xóa danh sách sản phẩm hiện tại
                productsList.innerHTML = '';

                // Hiển thị sản phẩm mới
                if (data.length > 0) {
                    data.forEach(product => {
                        const productHTML = `
                            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                <div class="card card-product h-100 shadow">
                                    <img src="uploads/${product.thumbnail}" class="card-img-top product-img" alt="${product.name}">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">${product.name}</h5>
                                        <p class="card-text text-danger fw-bold">
                                            ${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(product.price)}
                                        </p>
                                        <a href="index.php?page=product-detail&id=${product.id}" class="btn btn-outline-primary mt-auto">
                                            Xem chi tiết
                                        </a>
                                    </div>
                                </div>
                            </div>
                        `;
                        productsList.insertAdjacentHTML('beforeend', productHTML);
                    });
                } else {
                    productsList.innerHTML = '<div class="col-12"><p class="text-muted text-center">Không có sản phẩm nào để hiển thị.</p></div>';
                }
            })
            .catch(error => console.error('Error:', error));
    });
});