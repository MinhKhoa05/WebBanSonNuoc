<link rel="stylesheet" href="views/assets/css/customer/products-section.css">


<?php
require_once __DIR__ . '/../../../models/product.php';
require_once __DIR__ . '/../../../models/category.php';
require_once __DIR__ . '/../../../models/brand.php';


$categories = category_select_all();
$products = product_select_all();
$brands = brand_select_all();
$featuredBrands = brand_select_featured(6);
// Số sản phẩm trên mỗi trang
$productsPerPage = 8;

// Tổng số sản phẩm
$totalProducts = count($products);

// Tổng số trang
$totalPages = ceil($totalProducts / $productsPerPage);

// Trang hiện tại
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$currentPage = max(1, min($currentPage, $totalPages)); // Đảm bảo trang nằm trong khoảng hợp lệ

// Lấy danh sách sản phẩm cho trang hiện tại
$startIndex = ($currentPage - 1) * $productsPerPage;
$productsOnPage = array_slice($products, $startIndex, $productsPerPage);

// var_dump($productsOnPage);
// die();

?>
<style>
    /* General Section Styling */
    #products {
        background-color: #f8f9fa;
        padding: 50px 0;
    }

    #products hr {
        opacity: 0.1;
        margin: 40px 0;
    }

    #products h2 {
        font-weight: 700;
        color: #333;
        position: relative;
        padding-bottom: 15px;
    }

    #products h2:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: linear-gradient(to right, #0d6efd, #0dcaf0);
        border-radius: 2px;
    }

    /* Brand Cards Styling */
    .card-brand {
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
    }

    .brand-img-container {
        height: 140px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 15px;
        overflow: hidden;
        background-color: #fff;
    }

    .brand-img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .card-brand:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .card-brand:hover .brand-img {
        transform: scale(1.05);
    }

    .card-brand .card-body {
        background-color: #f8f9fa;
        border-top: 1px solid #eee;
    }

    .card-brand .card-title {
        font-size: 14px;
        font-weight: 600;
        color: #333;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* Product Cards Styling */
    .card-product {
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .product-img {
        height: 220px;
        width: 100%;
        object-fit: cover;
        transition: transform 0.3s ease-in-out;
    }

    .card-product:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .card-product:hover .product-img {
        transform: scale(1.05);
    }

    .card-product .card-title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        height: 48px;
    }

    .card-product .card-text {
        font-size: 18px;
        color: #dc3545 !important;
    }

    .card-product .btn {
        border-radius: 5px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .card-product .btn:hover {
        background-color: #0d6efd;
        color: #fff;
    }

    /* Sidebar Styling */
    .card-sidebar,
    .card-price {
        height: auto;
        border-radius: 10px;
        overflow: hidden;

    }

    .card-header {
        font-weight: 600;
        border: none;
        padding: 12px 15px;
    }

    .sidebar-link {
        color: #333;
        text-decoration: none;
        display: block;
        transition: all 0.2s ease;
        padding: 8px 5px;
    }

    .sidebar-link:hover {
        color: #0d6efd;
        transform: translateX(5px);
    }

    .list-group-item {
        border-left: none;
        border-right: none;
        padding: 0.5rem 1rem;
    }

    .list-group-item:first-child {
        border-top: none;
    }

    /* Price Filter Styling */
    #priceRange {
        height: 6px;
        cursor: pointer;
    }

    #priceRange::-webkit-slider-thumb {
        background: #0d6efd;
    }

    #priceValue {
        font-weight: 600;
        color: #0d6efd;
    }

    /* Sort Options Styling */
    .form-select {
        border-color: #dee2e6;
        cursor: pointer;
        border-radius: 5px;
        background-color: #fff;
    }

    /* Pagination Styling */
    .pagination {
        margin-top: 30px;
    }

    .pagination .page-link {
        color: #0d6efd;
        border-color: #dee2e6;
        margin: 0 3px;
        border-radius: 5px;
    }

    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .pagination .btn {
        color: #333;
        border-radius: 5px;
        margin: 0 3px;
    }

    .pagination .btn:hover {
        background-color: #f8f9fa;
    }

    /* Animation for Lazy Loading */
    .lazy-load {
        animation: fadeIn 0.5s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    /* Responsive Adjustments */
    @media (max-width: 1199px) {
        .product-img {
            height: 200px;
        }
    }

    @media (max-width: 991px) {
        .brand-img-container {
            height: 120px;
        }

        .product-img {
            height: 180px;
        }

        .sidebar {
            margin-bottom: 30px;
        }
    }

    @media (max-width: 767px) {
        .brand-img-container {
            height: 100px;
        }

        .product-img {
            height: 160px;
        }

        #products h2 {
            font-size: 1.75rem;
        }
    }

    @media (max-width: 575px) {
        .brand-img-container {
            height: 80px;
        }

        .product-img {
            height: 150px;
        }

        #products h2 {
            font-size: 1.5rem;
        }

        .card-body {
            padding: 0.75rem;
        }

        .card-product .card-title {
            font-size: 14px;
            height: 42px;
        }

        .card-product .card-text {
            font-size: 16px;
        }

        .card-product .btn {
            font-size: 14px;
            padding: 0.25rem 0.5rem;
        }
    }
</style>
<!-- Products Section -->
<section id="products" class="py-5">
    <div class="container lazy-load">
        <hr>
        <h2 class="text-center mb-5">Thương hiệu nổi bật</h2>

        <!-- Featured Brands Section -->
        <div class="row mb-5">
            <?php if (!empty($featuredBrands) && is_array($featuredBrands)): ?>
                <?php foreach ($featuredBrands as $brand): ?>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
                        <div class="card card-brand border-0 shadow-sm text-center">
                            <?php
                            $imagePath = 'uploads/' . $brand['thumbnail'];
                            $imageUrl = file_exists($imagePath) && !empty($brand['thumbnail'])
                                ? $imagePath
                                : 'views/assets/images/default-logo.png';
                            ?>
                            <div class="brand-img-container">
                                <img src="<?= htmlspecialchars($imageUrl) ?>"
                                    alt="<?= htmlspecialchars($brand['name']) ?>"
                                    class="card-img-top brand-img p-3"
                                    onerror="this.onerror=null; this.src='views/assets/images/default-logo.png';">
                            </div>
                            <div class="card-body p-2">
                                <h6 class="card-title mb-0"><?= htmlspecialchars($brand['name']) ?></h6>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted text-center">Không có thương hiệu nổi bật nào để hiển thị.</p>
            <?php endif; ?>
        </div>

        <hr>
        <h2 class="text-center mb-5">Sản phẩm nổi bật</h2>

        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 sidebar">
                <div class="card card-sidebar border-0 shadow-sm mt-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">DANH MỤC SẢN PHẨM</h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <?php foreach ($categories as $cat): ?>
                                <li class="list-group-item">
                                    <a href="#" class="sidebar-link" data-filter="<?= htmlspecialchars($cat['id']) ?>">
                                        <i class="fa fa-angle-double-right text-danger me-2"></i>
                                        <?= htmlspecialchars($cat['name']) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <!-- Price Filter -->
                <div class="card card-price border-0 shadow-sm mt-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Lọc theo giá</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="priceRange">Khoảng giá:</label>
                            <input type="range" class="form-range" id="priceRange" min="0" max="10000000" step="100000">
                            <div class="d-flex justify-content-between">
                                <span>0đ</span>
                                <span id="priceValue">5,000,000đ</span>
                                <span>10,000,000đ</span>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-primary w-100 mt-2">Áp dụng</button>
                    </div>
                </div>
            </div>

            <!-- Main content - Fixed to use 9 columns to complete the 12-column grid -->
            <div class="col-lg-9">
                <!-- Sort Options -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <span class="me-2">Hiển thị <span id="productCount"><?= count($productsOnPage) ?></span> sản phẩm</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="me-2">Sắp xếp theo:</label>
                        <select class="form-select form-select-sm" style="width: auto">
                            <option value="newest">Mới nhất</option>
                            <option value="price-asc">Giá: Thấp đến cao</option>
                            <option value="price-desc">Giá: Cao đến thấp</option>
                            <option value="popular">Phổ biến nhất</option>
                        </select>
                    </div>
                </div>

                <!-- Products List - Row with properly sized columns -->
                <div class="row" id="productsList">
                    <?php if (!empty($productsOnPage) && is_array($productsOnPage)): ?>
                        <?php foreach ($productsOnPage as $product): ?>
                            <!-- Changed to col-lg-4 for 3 products per row on large screens -->
                            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                <div class="card card-product h-100 shadow">
                                    <img src="uploads/<?= htmlspecialchars($product['thumbnail']) ?>"
                                        class="card-img-top product-img" alt="<?= htmlspecialchars($product['name']) ?>">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                                        <p class="card-text text-danger fw-bold">
                                            <?= number_format($product['price'], 0, ',', '.') ?>₫
                                        </p>
                                        <a href="index.php?page=product-detail&id=<?= $product['id'] ?>" class="btn btn-outline-primary mt-auto">
                                            Xem chi tiết
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <p class="text-muted text-center">Không có sản phẩm nào để hiển thị.</p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Pagination -->
                <nav aria-label="Product pagination" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?= $currentPage == 1 ? 'disabled' : '' ?>">
                            <a class="btn border" href="?page=<?= $currentPage - 1 ?>" tabindex="-1" aria-disabled="true">
                                <i class="fa-solid fa-angles-left p-1"></i>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?= $currentPage == $totalPages ? 'disabled' : '' ?>">
                            <a class="btn border" href="?page=<?= $currentPage + 1 ?>">
                                <i class="fa-solid fa-angles-right p-1"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>