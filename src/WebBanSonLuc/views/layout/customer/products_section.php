<link rel="stylesheet" href="views/assets/css/customer/products-section.css">

<?php
require_once __DIR__ . '/../../../models/product.php';
require_once __DIR__ . '/../../../models/category.php';

$categories = category_select_all();
$products = product_select_all();

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

<!-- Products Section -->
<section id="products" class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Sản phẩm nổi bật</h2>

        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm mt-4">
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
                <div class="card border-0 shadow-sm mt-4">
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
                                <div class="card h-100 shadow">
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