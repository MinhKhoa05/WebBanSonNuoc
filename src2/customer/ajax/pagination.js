document.addEventListener('DOMContentLoaded', function () {
    const productList = document.getElementById('product-list');
    const pagination = document.getElementById('pagination');
    const sortSelect = document.getElementById('sort');
    const priceInput = document.getElementById('price');
    const categorySelect = document.getElementById('category');

    // Hàm tải sản phẩm
    function loadProducts(page = 1) {
        const sort = sortSelect?.value || '';
        const price = priceInput?.value || '';
        const category = categorySelect?.value || '';

        const url = `paginate-product.php?page=${page}&sort=${sort}&price=${price}&category=${category}`;
        
        fetch(url)
            .then(response => response.json())
            .then(data => {
                renderProducts(data.products);
                renderPagination(data.pagination);
            })
            .catch(err => console.error('Lỗi tải sản phẩm:', err));
    }

    // Hiển thị sản phẩm
    function renderProducts(products) {
        productList.innerHTML = '';

        if (!products.length) {
            productList.innerHTML = '<p>Không có sản phẩm phù hợp.</p>';
            return;
        }

        products.forEach(p => {
            const item = document.createElement('div');
            item.className = 'product-item mb-3';
            item.innerHTML = `
                <div class="card">
                    <div class="card-body">
                        <h5>${p.name}</h5>
                        <p>Giá: ${Number(p.price).toLocaleString()}đ</p>
                    </div>
                </div>
            `;
            productList.appendChild(item);
        });
    }

    // Hiển thị phân trang
    function renderPagination({ currentPage, totalPages }) {
        pagination.innerHTML = '';

        // Nút Previous
        pagination.innerHTML += `
            <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                <button type="button" class="btn border prev-page" data-page="${currentPage - 1}" ${currentPage === 1 ? 'disabled' : ''}>
                    <i class="fa-solid fa-angles-left p-1"></i>
                </button>
            </li>
        `;

        // Các nút trang
        for (let i = 1; i <= totalPages; i++) {
            pagination.innerHTML += `
                <li class="page-item ${i === currentPage ? 'active' : ''}">
                    <button type="button" class="btn page-link" data-page="${i}">${i}</button>
                </li>
            `;
        }

        // Nút Next
        pagination.innerHTML += `
            <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                <button type="button" class="btn border next-page" data-page="${currentPage + 1}" ${currentPage === totalPages ? 'disabled' : ''}>
                    <i class="fa-solid fa-angles-right p-1"></i>
                </button>
            </li>
        `;
    }

    // Sự kiện click vào nút phân trang
    pagination.addEventListener('click', function (e) {
        const btn = e.target.closest('button');
        if (btn && btn.dataset.page) {
            const page = parseInt(btn.dataset.page);
            if (!isNaN(page)) {
                loadProducts(page);
            }
        }
    });

    // Khi thay đổi filter
    [sortSelect, priceInput, categorySelect].forEach(el => {
        if (el) el.addEventListener('change', () => loadProducts(1));
    });

    // Lần đầu tải trang
    loadProducts();
});
