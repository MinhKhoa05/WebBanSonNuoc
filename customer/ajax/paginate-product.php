<?php
require_once __DIR__ . '/../../models/product.php';
require_once __DIR__ . '/../../models/pdo.php';

// Lấy các tham số trang và bộ lọc với giá trị mặc định
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';
$price = isset($_GET['price']) ? (int)$_GET['price'] : 0;
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Số sản phẩm trên mỗi trang
$perPage = 3;
$offset = ($page - 1) * $perPage;

// Lấy tổng số sản phẩm sau khi áp dụng bộ lọc
$totalItems = product_filter_count($category, $price);

// Tính tổng số trang
$totalPages = ceil($totalItems / $perPage);

// Lấy danh sách sản phẩm sau khi áp dụng bộ lọc và phân trang
$products = product_filter($category, $price, null, $sort, $offset, $perPage);

// Xử lý sản phẩm để đảm bảo định dạng nhất quán
$formattedProducts = [];
foreach ($products as $product) {
    $formattedProducts[] = [
        'id' => $product['id'],
        'name' => $product['name'],
        'price' => $product['price'],
        'discount' => $product['discount'] ?? 0,
        'category_id' => $product['category_id'],
        'category_name' => $product['category_name'] ?? '',
        'thumbnail' => $product['thumbnail'] ?? '',
        'description' => $product['description'] ?? ''
    ];
}

// Chuẩn bị phản hồi
$response = [
    'products' => $formattedProducts,
    'pagination' => [
        'currentPage' => $page,
        'totalPages' => $totalPages,
        'perPage' => $perPage,
        'totalItems' => $totalItems
    ]
];

// Trả về phản hồi JSON
header('Content-Type: application/json');
echo json_encode($response);
