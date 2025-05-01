<?php
require_once __DIR__ . '/../../../models/product.php';
require_once __DIR__ . '/../../../models/category.php';
require_once __DIR__ . '/../../../models/brand.php';

// Kiểm tra xem có tham số category_id được truyền không
if (!isset($_GET['category_id']) || empty($_GET['category_id'])) {
    // Nếu không có category_id, chuyển hướng về trang chủ
    header('Location: index.php');
    exit;
}

$category_id = (int)$_GET['category_id'];

// Lấy tất cả danh mục
$categories = category_select_all();
$brands = brand_select_all();

// Lấy thông tin danh mục hiện tại
$current_category = null;
foreach ($categories as $cat) {
    if ($cat['id'] == $category_id) {
        $current_category = $cat;
        break;
    }
}

// Nếu không tìm thấy danh mục, chuyển hướng về trang chủ
if (!$current_category) {
    header('Location: index.php');
    exit;
}

// Phân trang
$itemsPerPage = 12; // Số sản phẩm hiển thị trên mỗi trang
$currentPage = isset($_GET['trang']) ? (int)$_GET['trang'] : 1;

// Lấy sản phẩm theo danh mục bằng hàm từ model
// Giả sử có hàm product_select_by_category trong models/product.php
// Nếu chưa có, bạn cần thêm hàm này vào file product.php
// $productsByCategory = product_select_by_category($category_id);

// Thay thế bằng cách lấy tất cả sản phẩm và lọc theo category_id
$allProducts = product_select_all();
$productsByCategory = array_filter($allProducts, function ($product) use ($category_id) {
    return $product['category_id'] == $category_id;
});

$totalProducts = count($productsByCategory);
$totalPages = ceil($totalProducts / $itemsPerPage);

// Đảm bảo trang hiện tại hợp lệ
if ($currentPage < 1) {
    $currentPage = 1;
} elseif ($currentPage > $totalPages && $totalPages > 0) {
    $currentPage = $totalPages;
}

// Lấy sản phẩm cho trang hiện tại
$offset = ($currentPage - 1) * $itemsPerPage;
$productsOnPage = array_slice($productsByCategory, $offset, $itemsPerPage);
?>

<!-- CSS tùy chỉnh nếu cần -->
<link rel="stylesheet" href="customer/views/assets/css/products-section.css">

<!-- Main Content -->
<section class="py-4">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($current_category['name']) ?></li>
                    </ol>
                </nav>
                <h1 class="text-center mb-4"><?= htmlspecialchars($current_category['name']) ?></h1>
            </div>
        </div>

        <div class="row">
            <!-- Products grid -->
            <div class="col-lg-12">
                <!-- Sort Options -->
                <!-- <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <span class="me-2">Hiển thị <span id="productCount"><?= count($productsOnPage) ?></span> / <?= $totalProducts ?> sản phẩm</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="me-2">Sắp xếp theo:</label>
                        <select class="form-select form-select-sm sort-select" style="width: auto">
                            <option value="newest">Mới nhất</option>
                            <option value="price-asc">Giá: Thấp đến cao</option>
                            <option value="price-desc">Giá: Cao đến thấp</option>
                        </select>
                    </div>
                </div> -->

                <!-- Products grid -->
                <div class="row">
                    <?php if (!empty($productsOnPage)): ?>
                        <?php foreach ($productsOnPage as $product): ?>
                            <div class="col-lg-2 col-md-6 col-sm-6 mb-4">
                                <div class="card card-product h-100">
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

                <!-- Phân trang -->
                <?php if ($totalPages > 1): ?>
                    <nav aria-label="Phân trang" class="my-4">
                        <ul class="pagination justify-content-center">
                            <!-- Nút Previous -->
                            <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="index.php?page=product-all&category_id=<?= $category_id ?>&trang=<?= $currentPage - 1 ?>">
                                    &laquo; Trước
                                </a>
                            </li>
                            
                            <!-- Các số trang -->
                            <?php
                            // Hiển thị tối đa 5 số trang
                            $startPage = max(1, $currentPage - 2);
                            $endPage = min($totalPages, $startPage + 4);
                            if ($endPage - $startPage < 4) {
                                $startPage = max(1, $endPage - 4);
                            }
                            ?>
                            
                            <?php if ($startPage > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="index.php?page=product-all&category_id=<?= $category_id ?>&trang=1">1</a>
                                </li>
                                <?php if ($startPage > 2): ?>
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>
                            
                            <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                                <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                                    <a class="page-link" href="index.php?page=product-all&category_id=<?= $category_id ?>&trang=<?= $i ?>">
                                        <?= $i ?>
                                    </a>
                                </li>
                            <?php endfor; ?>
                            
                            <?php if ($endPage < $totalPages): ?>
                                <?php if ($endPage < $totalPages - 1): ?>
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                <?php endif; ?>
                                <li class="page-item">
                                    <a class="page-link" href="index.php?page=product-all&category_id=<?= $category_id ?>&trang=<?= $totalPages ?>"><?= $totalPages ?></a>
                                </li>
                            <?php endif; ?>
                            
                            <!-- Nút Next -->
                            <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                                <a class="page-link" href="index.php?page=product-all&category_id=<?= $category_id ?>&trang=<?= $currentPage + 1 ?>">
                                    Tiếp &raquo;
                                </a>
                            </li>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<script>
    // JavaScript cho chức năng sắp xếp sản phẩm (nếu cần triển khai ở client-side)
    document.addEventListener('DOMContentLoaded', function() {
        const sortSelect = document.querySelector('.sort-select');
        if (sortSelect) {
            sortSelect.addEventListener('change', function() {
                const sortValue = this.value;
                const currentUrl = new URL(window.location.href);
                currentUrl.searchParams.set('sort', sortValue);
                window.location.href = currentUrl.toString();
            });
            
            // Giữ tùy chọn đã chọn khi tải lại trang
            const urlParams = new URLSearchParams(window.location.search);
            const sortParam = urlParams.get('sort');
            if (sortParam) {
                sortSelect.value = sortParam;
            }
        }
    });
</script>