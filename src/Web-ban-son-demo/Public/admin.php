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
  <title>Admin - Quản Lý Sơn Nước</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>
  <div class="container-fluid">
    <div class="row">
    <?php
    switch ($pageParam) {
        case 'myprofile':
            require_once '../Views/layout/admin/sidebar.php';
            include '../Views/pages/admin/myprofile.php';
            break;
        case 'home':
            require_once '../Views/layout/admin/sidebar.php';
            include '../Views/pages/admin/home.php';
            break;
        case 'product':
            require_once '../Views/layout/admin/sidebar.php';
            include '../Views/pages/admin/products.php';
            break;
        case 'checkout':
            require_once '../Views/layout/admin/sidebar.php';
            include '../Views/pages/admin/checkout.php';
            break;
        case 'service':
            require_once '../Views/layout/admin/sidebar.php';
            include '../Views/pages/admin/services.php';
            break;
        case 'cart':
            require_once '../Views/layout/admin/sidebar.php';
            include '../Views/pages/admin/carts.php';
            break;
        case 'login':
          //   include '../Views/middlewares/RedirectIfAuthenticatedMiddleware.php';
            require_once '../Views/layout/admin/sidebar.php';
            include '../Views/pages/admin/login.php';
            break;
        case 'sign-up':
            include '../Views/middlewares/RedirectIfAuthenticatedMiddleware.php';
            require_once '../Views/layout/admin/sidebar.php';
            include '../Views/pages/admin/register.php';
            break;
        case 'users':
            include '../Views/middlewares/AuthMiddleware.php';
            require_once '../Views/layout/admin/sidebar.php';
            include '../Views/pages/admin/users.php';
            break;
        case 'about-us':
            require_once '../Views/layout/admin/sidebar.php';
            include '../Views/pages/admin/about.php';
            break;
        case 'contact':
            require_once '../Views/layout/admin/sidebar.php';
            include '../Views/pages/admin/contact.php';
            break;
        case 'dashboard':
            // include '../Views/middlewares/AuthMiddleware.php';
            require_once '../Views/layout/admin/sidebar.php';
            include '../Views/pages/admin/dashboard.php';
            break;
        default:
            require_once '../Views/layout/admin/sidebar.php';
            include '../Views/pages/admin/dashboard.php';
            // include '../Views/pages/admin/404.php'; // Uncomment this line to show 404 page
            break;
    }
  ?>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/admin/general.js"></script>
</body>
</html>