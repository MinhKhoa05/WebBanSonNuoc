<?php
// Place this file at customer/ajax/filter-products.php
require_once __DIR__ . '/../../models/product.php';

// Initialize response array
$response = [];

// Check if category ID is provided
if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {
    $category_id = (int) $_GET['category_id'];
    
    // Get products by category ID
    $products = product_select_by_category_id($category_id);
    
    // If products found, return them as JSON
    if ($products && is_array($products)) {
        $response = $products;
    }
}
if (isset($_GET['max_price'])) {
    $maxPrice = (int)$_GET['max_price'];

    // Lấy danh sách sản phẩm có giá <= maxPrice
    $products = product_select_by_price($maxPrice);

    // Nếu có sản phẩm, trả về dưới dạng JSON
    if ($products && is_array($products)) {
        $response = $products;
    }
}
// Set content type header
header('Content-Type: application/json');

// Return the response as JSON
echo json_encode($response);
?>