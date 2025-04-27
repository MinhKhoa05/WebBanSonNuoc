<?php
require_once __DIR__ . '/../../models/product.php';
require_once __DIR__ . '/../../models/category.php';

// Lấy các tham số từ yêu cầu
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$categoryId = isset($_GET['category']) ? (int) $_GET['category'] : null;
$priceMax = isset($_GET['price']) ? (int) $_GET['price'] : null;
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'newest';

// Số sản phẩm mỗi trang
$productsPerPage = 8;

// Lấy tất cả sản phẩm từ cơ sở dữ liệu
$products = product_select_all(); // Hàm trả về mảng sản phẩm

// === LỌC SẢN PHẨM === //
if ($categoryId) {
    $products = array_filter($products, function ($product) use ($categoryId) {
        return $product['category_id'] == $categoryId;
    });
}

if ($priceMax) {
    $products = array_filter($products, function ($product) use ($priceMax) {
        return $product['price'] <= $priceMax;
    });
}

// === SẮP XẾP SẢN PHẨM === //
if ($sort === 'newest') {
    usort($products, function ($a, $b) {
        return strtotime($b['created_at']) - strtotime($a['created_at']);
    });
} elseif ($sort === 'price_asc') {
    usort($products, function ($a, $b) {
        return $a['price'] - $b['price'];
    });
} elseif ($sort === 'price_desc') {
    usort($products, function ($a, $b) {
        return $b['price'] - $a['price'];
    });
}

// === PHÂN TRANG === //
$totalProducts = count($products);
$totalPages = ceil($totalProducts / $productsPerPage);
$startIndex = ($page - 1) * $productsPerPage;
$productsOnPage = array_slice($products, $startIndex, $productsPerPage);

// === TRẢ KẾT QUẢ DẠNG JSON === //
$response = [
    'products' => $productsOnPage,
    'pagination' => [
        'currentPage' => $page,
        'totalPages' => $totalPages,
        'totalProducts' => $totalProducts
    ]
];

header('Content-Type: application/json');
echo json_encode($response);
?>
