document.addEventListener('DOMContentLoaded', function() {
    // Gửi yêu cầu khi người dùng click vào pagination
    document.querySelectorAll('#pagination .page-link').forEach(function(pageLink) {
        pageLink.addEventListener('click', function(e) {
            e.preventDefault();  // Ngừng hành động mặc định của thẻ <a>

            // Lấy page number từ data-page
            var page = this.getAttribute('data-page');
            if (page) {
                loadProducts(page);  // Gọi hàm load sản phẩm với page mới
            }
        });
    });

    // Hàm load sản phẩm mới qua AJAX
    function loadProducts(page) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'loadProducts.php?page=' + page, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('productList').innerHTML = xhr.responseText;
                updatePagination(page);
            }
        };
        xhr.send();
    }

    // Cập nhật pagination (các nút disabled hoặc active)
    function updatePagination(currentPage) {
        var paginationLinks = document.querySelectorAll('#pagination .page-item');
        paginationLinks.forEach(function(link) {
            var pageLink = link.querySelector('.page-link');
            if (pageLink) {
                var page = pageLink.getAttribute('data-page');
                if (page == currentPage) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            }
        });
    }
});
