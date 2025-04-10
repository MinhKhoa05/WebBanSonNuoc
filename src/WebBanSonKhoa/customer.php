<?php
// Bao gồm các file cần thiết cho trang customer
require_once 'views/customer/layout/header.php';

$pageRaw = $_GET['page'] ?? '';
$parsedUrl = parse_url($pageRaw);
$pageParam = $parsedUrl['path'] ?? '';

// Điều hướng đến các trang cụ thể
switch ($pageParam) {
    case 'myprofile':
        include 'views/customer/myprofile.php';
        break;
    case 'home':
        include 'views/customer/layout/home.php';
        break;
    case 'product':
        include 'views/customer/products.php';
        break;
    case 'checkout':
        include 'views/customer/checkout.php';
        break;
    case 'service':
        include 'views/customer/services.php';
        break;
    case 'cart':
        include 'views/customer/cart.php';
        break;
    case 'about-us':
        include 'views/customer/about-us.php';
        break;
    default:
        include 'views/customer/layout/home.php';
        break;
}

// Bao gồm footer chung
require_once 'views/customer/layout/footer.php';
?>