<?php
    require_once __DIR__ . '/../../../models/category.php';
    $categories = category_select_all(); // <- hàm này sẽ lấy danh sách Danh mục
?>

<!-- Products Section -->
<section id="products" class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Sản phẩm nổi bật</h2>

        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3">
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

            <!-- Main content -->
            <div class="col-lg-8">
                <!-- Sort Options -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <span class="me-2">Hiển thị <span id="productCount">12</span> sản phẩm</span>
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

                <!-- Products List -->
                <div class="row" id="productsList">
                    <!-- Product Cards - Render here -->
                    Hiển thị các sản phẩm ở đây
                </div>

                <!-- Pagination -->
                <nav aria-label="Product pagination" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Trước</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Sau</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>