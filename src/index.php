<?php
// Bao gồm các file cần thiết cho trang customer
require_once 'views/layout/customer/header.php';
require_once 'controllers/userController.php';

?>
<?php
// Router
$pageRaw = $_GET['page'] ?? '';
$parsedUrl = parse_url($pageRaw);
$pageParam = $parsedUrl['path'] ?? '';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PaintMaster</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">   
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">   -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <link rel="stylesheet" href="views/assets/css/customer/home.css">
    <link rel="stylesheet" href="views/assets/css/customer/products-section.css">

    <!-- <script src="views/assets/js/customer/home.js"></script> -->
</head>
<body>
<?php
// Điều hướng đến các trang cụ thể
switch ($pageParam) {
    case 'myprofile':
        include 'views/middlewares/checkAuthen.php';
        include 'views/pages/customer/myprofile.php';
        break;
    case 'home':
        include 'views/pages/customer/home.php';
        break;
    case 'product-detail':
        include 'views/pages/customer/product-details.php';
        break;
    case 'checkout':
        include 'views/pages/customer/checkout.php';
        break;
    case 'service':
        include 'views/pages/customer/services.php';
        break;
    case 'cart':
        include 'views/pages/customer/cart.php';
        break;
    case 'about-us':
        include 'views/pages/customer/about-us.php';
        break;
    case 'contact':
        include 'views/pages/customer/contact.php';
        break;
    case 'login':
        include 'views/middlewares/redirectIfAuthen.php';
        include 'views/pages/customer/login.php';
        break;
    case 'sign-in':
        include 'views/middlewares/redirectIfAuthen.php';
        include 'views/pages/customer/register.php';
        break;
    default:
        include 'views/pages/customer/home.php';
        break;
}
?>

<script src="ajax/lazyloading.js"></script>
</body>
</html>
<?php
// Bao gồm footer chung
require_once 'views/layout/customer/footer.php';
?>