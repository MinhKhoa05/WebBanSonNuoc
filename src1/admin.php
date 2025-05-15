<?php
// Khởi động session ở phần đầu của file
session_start();

// Bao gồm các file cần thiết cho trang customer
// require_once 'views/customer/layout/header.php';

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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="admin/views/assets/css/admin.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php
            include 'admin/views/layout/sidebar.php'; // Sidebar
            ?>
            <!-- Main content -->
            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <?php
                include 'admin/views/layout/topbar.php';

                // Điều hướng đến các trang cụ thể
                switch ($pageParam) {
                    case 'dashboard':
                        include 'admin/views/pages/dashboard.php';
                        break;
                    case 'myprofile':
                        include 'admin/views/pages/myprofile.php';
                        break;
                    case 'customer':
                        include 'admin/views/pages/customers.php';
                        break;
                    case 'product':
                        include 'admin/views/pages/products.php';
                        break;
                    case 'checkout':
                        include 'admin/views/checkout.php';
                        break;
                    case 'service':
                        include 'admin/views/services.php';
                        break;
                    case 'cart':
                        include 'admin/views/cart.php';
                        break;
                    case 'about-us':
                        include 'admin/views/about-us.php';
                        break;
                    default:
                        include 'admin/views/pages/dashboard.php';
                        break;
                }
                ?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>