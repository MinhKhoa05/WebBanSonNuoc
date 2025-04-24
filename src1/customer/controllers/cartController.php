<!-- <?php
// session_start();
// require_once __DIR__ . '/../models/product.php'; // Đảm bảo đường dẫn đúng
// require_once __DIR__ . '/../models/cart.php'; // File chứa các hàm xử lý giỏ hàng trong database

// $action = isset($_GET['action']) ? $_GET['action'] : '';

// if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
//     $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
//     $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

//     // Kiểm tra nếu giỏ hàng chưa tồn tại
//     if (!isset($_SESSION['cart'])) {
//         $_SESSION['cart'] = [];
//     }

//     // Kiểm tra nếu sản phẩm đã tồn tại trong giỏ hàng
//     if (isset($_SESSION['cart'][$productId])) {
//         $_SESSION['cart'][$productId]['quantity'] += $quantity;
//     } else {
//         // Lấy thông tin sản phẩm từ cơ sở dữ liệu
//         $product = product_select_by_id($productId);
//         if ($product) {
//             $_SESSION['cart'][$productId] = [
//                 'id' => $product['id'],
//                 'name' => $product['name'],
//                 'price' => $product['price'],
//                 'thumbnail' => $product['thumbnail'],
//                 'quantity' => $quantity
//             ];
//         }
//     }

//     // Lưu giỏ hàng vào cơ sở dữ liệu
//     save_cart_to_database($_SESSION['carts'], $_SESSION['user_id']);

//     // Chuyển hướng về trang giỏ hàng
//     header('Location: ../index.php?page=cart');
//     exit;
// }

// if ($action === 'remove' && isset($_GET['id'])) {
//     $productId = (int)$_GET['id'];
//     if (isset($_SESSION['cart'][$productId])) {
//         unset($_SESSION['cart'][$productId]);
//     }
//     header('Location: ../index.php?page=cart');
//     exit;
// }

// if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
//     foreach ($_POST['quantity'] as $productId => $quantity) {
//         if (isset($_SESSION['cart'][$productId])) {
//             $_SESSION['cart'][$productId]['quantity'] = max(1, (int)$quantity); // Đảm bảo số lượng >= 1
//         }
//     }
//     header('Location: ../index.php?page=cart');
//     exit;
// }
?> -->
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../models/cart.php';

$action = $_GET['action'] ?? '';

if (!isset($_SESSION['user_id'])) {
    // Redirect về trang đăng nhập nếu chưa đăng nhập
    header('Location: ../../index.php?page=sign-in');
    exit;
}

$user_id = $_SESSION['user_id'];

switch ($action) {
    case 'add':
        $product_id = $_POST['product_id'] ?? 0;
        $quantity = $_POST['quantity'] ?? 1;

        if ($product_id > 0 && $quantity > 0) {
            cart_insert($user_id, $product_id, $quantity);
            header('Location: ../../index.php?page=cart'); // hoặc back về sản phẩm
            exit;
        } else {
            die('Dữ liệu không hợp lệ');
        }
        // break;

    // thêm các action như update, remove nếu cần
}
?>