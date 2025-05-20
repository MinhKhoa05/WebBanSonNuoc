<?php
// Bao gồm các file cần thiết cho trang customer
// require_once 'customer/views/layout/header.php';
// require_once 'customer/controllers/userController.php';

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">   -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- <link rel="stylesheet" href="customer/views/assets/css/products-section.css"> -->
</head>

<body>
    <?php
    require_once 'customer/views/layout/header.php';

    // Điều hướng đến các trang cụ thể
    switch ($pageParam) {
        case 'myprofile':
            include 'customer/views/middlewares/checkAuthen.php';
            include 'customer/views/pages/myprofile.php';
            break;
        case 'home':
            include 'customer/views/pages/home.php';
            break;
        case 'product-detail':
            include 'customer/views/pages/product-details.php';
            break;
        case 'payment':
            include 'customer/views/pages/payment.php';
            break;
        case 'thankyou':
            include 'customer/views/pages/thankyou.php';
            break;
        case 'checkout':
            include 'customer/views/pages/checkout.php';
            break;
        case 'post':
            include 'customer/views/pages/post.php';
            break;
        case 'post_detail':
            if (isset($_GET['slug'])) {
                $slug = $_GET['slug'];
                require_once __DIR__.'/models/post.php';
                $post = post_select_by_slug($slug); // Hàm lấy bài viết từ DB theo slug
                $GLOBALS['post'] = $post;  // Đưa bài viết ra toàn cục để view dùng
            }
            include 'customer/views/pages/post_detail.php'; // Hiển thị trang chi tiết
            break;

        case 'cart':
            include 'customer/views/pages/cart.php';
            break;
        case 'about-us':
            include 'customer/views/pages/about-us.php';
            break;
        case 'contact':
            include 'customer/views/pages/contact.php';
            break;
        case 'login':
            include 'customer/views/middlewares/redirectIfAuthen.php';
            include 'customer/views/pages/login.php';
            break;
        case 'sign-in':
            include 'customer/views/middlewares/redirectIfAuthen.php';
            include 'customer/views/pages/register.php';
            break;
        case 'product-all':
            include 'customer/views/pages/product-all.php';
            break;
        default:
            include 'customer/views/pages/home.php';
            break;
    }
    ?>

    <!-- <script src="customer/ajax/lazyloading.js"></script> -->
</body>

</html>
<?php
// Bao gồm footer chung
require_once 'customer/views/layout/footer.php';
?>