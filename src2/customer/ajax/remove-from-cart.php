<?php
session_start();
require_once __DIR__ . '/../../models/cart.php';

// Hiển thị lỗi để debug (chỉ dùng trong môi trường phát triển)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Kiểm tra cả product_id và user_id
if (!isset($_POST['product_id'])) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'Thiếu product_id'
    ]);
    exit;
}

if (!isset($_SESSION['user_id'])) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'Bạn chưa đăng nhập'
    ]);
    exit;
}

// Lấy các giá trị
$productId = $_POST['product_id'];
$userId = $_SESSION['user_id'];

try {
    // Xóa sản phẩm khỏi cơ sở dữ liệu
    cart_delete($userId, $productId);
    
    // Kiểm tra nếu giỏ hàng tồn tại trong session
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]); // Xóa sản phẩm khỏi giỏ hàng
    }
    
    // Tính lại tổng số sản phẩm trong giỏ hàng
    $cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
    
    // Cập nhật tổng tiền nếu cần
    $subtotal = 0;
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            if (isset($item['price']) && isset($item['quantity'])) {
                $subtotal += $item['price'] * $item['quantity'];
            }
        }
    }
    
    // Trả về phản hồi JSON
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'cartCount' => $cartCount,
        'subtotal' => $subtotal,
        'total' => $subtotal + (isset($_SESSION['shipping_fee']) ? $_SESSION['shipping_fee'] : 50000)
    ]);
} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'Đã xảy ra lỗi: ' . $e->getMessage()
    ]);
}
?>