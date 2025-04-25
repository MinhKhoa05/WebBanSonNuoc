<?php
require_once __DIR__ . '/../../../models/product.php';
require_once __DIR__ . '/../../../models/category.php';
require_once __DIR__ . '/../../../models/brand.php';

$categories = category_select_all();
$brands = brand_select_all();
$featuredBrands = brand_select_featured(6);

// Để hiển thị ban đầu, lấy dữ liệu cho trang đầu tiên
$productsPerPage = 8;
$products = product_select_all();
$totalProducts = count($products);
$totalPages = ceil($totalProducts / $productsPerPage);
$currentPage = 1;
$productsOnPage = array_slice($products, 0, $productsPerPage);
?>

<link rel="stylesheet" href="customer/views/assets/css/products-section.css">


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
                                : 'customer/views/assets/images/default-logo.png';
                            ?>
                            <div class="brand-img-container">
                                <img src="<?= htmlspecialchars($imageUrl) ?>" alt="<?= htmlspecialchars($brand['name']) ?>"
                                    class="card-img-top brand-img p-3"
                                    onerror="this.onerror=null; this.src='customer/views/assets/images/default-logo.png';">
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
                <?php include 'customer/views/layout/sidebar.php'; ?>
            </div>

            <!-- Main content - Fixed to use 9 columns to complete the 12-column grid -->
            <div class="col-lg-9">
                <!-- Sort Options -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <span class="me-2">Hiển thị <span id="productCount"><?= count($productsOnPage) ?></span> sản
                            phẩm</span>
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

                <!-- Sản phẩm nổi bật-->
                <div class="row" id="productsList">
                    <?php if (!empty($productsOnPage) && is_array($productsOnPage)): ?>
                        <?php foreach ($productsOnPage as $product): ?>
                            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                <div class="card card-product h-100 shadow">
                                    <img src="uploads/<?= htmlspecialchars($product['thumbnail']) ?>"
                                        class="card-img-top product-img" alt="<?= htmlspecialchars($product['name']) ?>"
                                        onerror="this.onerror=null; this.src='customer/views/assets/images/default-product.png';">
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
                <nav aria-label="Product pagination" class="my-4">
                    <ul class="pagination justify-content-center" id="pagination">
                        <li class="page-item <?= $currentPage == 1 ? 'disabled' : '' ?>">
                            <button type="button" class="btn border prev-page" data-page="<?= $currentPage - 1 ?>" <?= $currentPage == 1 ? 'disabled' : '' ?>>
                                <i class="fa-solid fa-angles-left p-1"></i>
                            </button>
                        </li>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                                <button type="button" class="btn page-link" data-page="<?= $i ?>"><?= $i ?></button>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?= $currentPage == $totalPages ? 'disabled' : '' ?>">
                            <button type="button" class="btn border next-page" data-page="<?= $currentPage + 1 ?>" <?= $currentPage == $totalPages ? 'disabled' : '' ?>>
                                <i class="fa-solid fa-angles-right p-1"></i>
                            </button>
                        </li>
                    </ul>
                </nav>

                <!-- Category 1 -->
                <div>
                    <?php foreach ($categories as $cat): ?>
                        <hr>
                        <h2 id="category-<?= htmlspecialchars($cat['id']) ?>" class="text-center mb-5">
                            <?= htmlspecialchars($cat['name']) ?>
                        </h2>
                        <div class="row">
                            <?php
                            // Lọc sản phẩm theo danh mục
                            $productsByCategory = array_filter($products, function ($product) use ($cat) {
                                return $product['category_id'] == $cat['id'];
                            });
                            ?>

                            <?php if (!empty($productsByCategory)): ?>
                                <?php foreach ($productsByCategory as $product): ?>
                                    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                        <div class="card card-product h-100 shadow">
                                            <img src="uploads/<?= htmlspecialchars($product['thumbnail']) ?>"
                                                class="card-img-top product-img" alt="<?= htmlspecialchars($product['name']) ?>"
                                                onerror="this.onerror=null; this.src='customer/views/assets/images/default-product.png';">
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
                                    <p class="text-muted text-center">Không có sản phẩm nào trong danh mục này.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <script src="customer/views/assets/js/products.js"></script> -->
<script src="customer/ajax/filter-products.js"></script>
<script src="customer/ajax/pagination.js"></script>
<script src="customer/ajax/lazyloading.js"></script>