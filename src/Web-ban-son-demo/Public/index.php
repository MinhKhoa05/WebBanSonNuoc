<?php
// require_once __DIR__ . '/../Config/database.php';
// require_once __DIR__ . '/../Controllers/UserController.php';

// $database = new Database();
// $db = $database->getConnection();

// $userDAO = new UserDAO($database);
// $userService = new UserService($userDAO);
// $userController = new UserController($userService);
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
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  
  <link rel="stylesheet" href="../assets/css/customer/style-home.css">
  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<!-- <div class="container bg-white" style="margin-top: 108px;"> -->
<body>
<?php
  switch ($pageParam) {
        case 'myprofile':
            require_once '../Views/layout/customer/header.php';
            include '../Views/pages/customer/myprofile.php';
            break;
        case 'home':
            require_once '../Views/layout/customer/header.php';
            include '../Views/pages/customer/home.php';
            break;
        case 'product':
            require_once '../Views/layout/customer/header.php';
            include '../Views/pages/customer/products.php';
            break;
        case 'checkout':
            require_once '../Views/layout/customer/header.php';
            include '../Views/pages/customer/checkout.php';
            break;
        case 'service':
            require_once '../Views/layout/customer/header.php';
            include '../Views/pages/customer/services.php';
            break;
        case 'cart':
            require_once '../Views/layout/customer/header.php';
            include '../Views/pages/customer/carts.php';
            break;
        case 'login':
            //   include '../Views/middlewares/RedirectIfAuthenticatedMiddleware.php';
            require_once '../Views/layout/customer/header.php';
            include '../Views/pages/customer/login.php';
            break;
        case 'sign-up':
            include '../Views/middlewares/RedirectIfAuthenticatedMiddleware.php';
            require_once '../Views/layout/customer/header.php';
            include '../Views/pages/customer/register.php';
            break;
        case 'users':
            include '../Views/middlewares/AuthMiddleware.php';
            require_once '../Views/layout/customer/header.php';
            include '../Views/pages/customer/users.php';
            break;
        case 'about-us':
            require_once '../Views/layout/customer/header.php';
            include '../Views/pages/customer/about.php';
            break;
        case 'contact':
            require_once '../Views/layout/customer/header.php';
            include '../Views/pages/customer/contact.php';
            break;
        case 'dashboard':
            include '../Views/middlewares/AuthMiddleware.php';
            require_once '../Views/layout/customer/header.php';
            include '../Views/pages/customer/dashboard.php';
            break;
        default:
            require_once '../Views/layout/customer/header.php';
            include '../Views/pages/customer/home.php';
            // include '../Views/pages/customer/404.php'; // Uncomment this line to show 404 page
            break;
  }
?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/customer/home.js"></script>
</body>
</html>

<?php
require_once '../Views/layout/customer/footer.php';
?>