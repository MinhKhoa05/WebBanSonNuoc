<?php
// filepath: c:\xampp\htdocs\src1\customer\controllers\paymentController.php

require_once __DIR__ . '/../../models/order.php';
require_once __DIR__ . '/../../models/order_detail.php';
require_once __DIR__ . '/../../models/cart.php';
require_once __DIR__ . '/../../models/product.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header('Location: ../../index.php?page=login');
    exit;
}

// Lấy giỏ hàng từ DB
$cart_items = cart_select_by_user($user_id);

// Nếu giỏ hàng rỗng, chuyển về trang giỏ hàng
if (empty($cart_items)) {
    header('Location: ../../index.php?page=cart');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $note = $_POST['note'] ?? '';
    $payment_method = $_POST['payment_method'] ?? 'cod';

    // Tính tổng tiền
    $subtotal = 0;
    foreach ($cart_items as $item) {
        $product = product_select_by_id($item['product_id']);
        $subtotal += $product['price'] * $item['quantity'];
    }
    $shipping = 30000;
    $total = $subtotal + $shipping;
    $order_date = date('Y-m-d H:i:s');
    $status = 'pending';

    // Thêm đơn hàng mới - chỉ sử dụng các trường có trong bảng orders
    order_insert($user_id, $order_date, $total, $status);
    
    // Lưu thông tin người dùng vào bảng khác nếu cần
    // Ví dụ: bạn có thể lưu thông tin giao hàng vào bảng shipping_info hoặc customer_info

    // Lấy ID đơn hàng vừa thêm
    $order = pdo_query_one("SELECT id FROM orders WHERE user_id = ? ORDER BY id DESC LIMIT 1", $user_id);
    $order_id = $order ? $order['id'] : null;

    if ($order_id) {
        // Lưu chi tiết đơn hàng
        foreach ($cart_items as $item) {
            $product = product_select_by_id($item['product_id']);
            order_detail_insert($order_id, $item['product_id'], $product['name'], $product['price'], $item['quantity'], $product['price'] * $item['quantity']);
        }

        // Có thể lưu thông tin giao hàng vào bảng riêng nếu cần
        // shipping_info_insert($order_id, $fullname, $phone, $address, $note, $payment_method, $shipping);

        // Xóa giỏ hàng
        cart_delete_by_user($user_id);

        // Lưu ID đơn hàng vào session để hiển thị ở trang cảm ơn
        $_SESSION['last_order_id'] = $order_id;

        // Chuyển hướng sang trang cảm ơn
        header('Location: ../../index.php?page=thankyou');
        exit;
    } else {
        $_SESSION['error'] = "Đặt hàng thất bại. Vui lòng thử lại!";
        header('Location: ../../index.php?page=payment');
        exit;
    }
}
?>