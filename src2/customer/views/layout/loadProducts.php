<?php
require_once __DIR__ . '/../../../models/product.php';

// Lấy các danh mục, sản phẩm, thương hiệu, v.v.
$products = product_select_all();

// Số sản phẩm trên mỗi trang
$productsPerPage = 8;

// Tổng số sản phẩm
$totalProducts = count($products);

// Tổng số trang
$totalPages = ceil($totalProducts / $productsPerPage);

// Trang hiện tại
$currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$currentPage = max(1, min($currentPage, $totalPages)); // Đảm bảo trang nằm trong khoảng hợp lệ

// Lấy danh sách sản phẩm cho trang hiện tại
$startIndex = ($currentPage - 1) * $productsPerPage;
$productsOnPage = array_slice($products, $startIndex, $productsPerPage);
?>

<div class="row">
    <?php
    // Hiển thị sản phẩm
    if (!empty($productsOnPage)) {
        foreach ($productsOnPage as $product) {
            ?>
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
            <?php
        }
    } else {
        echo "<p>Không có sản phẩm nào để hiển thị.</p>";
    }
    ?>
</div>

/** 
<!-- Pagination -->
<nav aria-label="Product pagination" class="mt-4">
    <ul class="pagination justify-content-center">
        <!-- Previous -->
        <li class="page-item <?= $currentPage == 1 ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $currentPage - 1 ?>" aria-disabled="<?= $currentPage == 1 ? 'true' : 'false' ?>">
                <i class="fa-solid fa-angles-left"></i>
            </a>
        </li>

        <!-- Page Numbers -->
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <!-- Next -->
        <li class="page-item <?= $currentPage == $totalPages ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $currentPage + 1 ?>" aria-disabled="<?= $currentPage == $totalPages ? 'true' : 'false' ?>">
                <i class="fa-solid fa-angles-right"></i>
            </a>
        </li>
    </ul>
</nav>*/
