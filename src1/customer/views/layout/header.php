<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['user_id']);
$userName = $isLoggedIn ? $_SESSION['user_name'] : '';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>ColorHomes Paint</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="views/assets/css/customer/home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" style="position: fixed; width: 100%; z-index: 999;">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="bi bi-droplet-fill me-2"></i>ColorHomes Paint
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Trang chủ</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=service">Dịch vụ</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=about-us">Về chúng tôi</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=contact">Liên hệ</a></li>
            </ul>

            <div class="d-flex align-items-center">
                <?php if (!$isLoggedIn): ?>
                    <a href="index.php?page=login" class="btn btn-primary me-2">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Đăng nhập
                    </a>
                    <a href="index.php?page=sign-in" class="btn btn-outline-light">
                        <i class="bi bi-person-plus me-1"></i> Đăng ký
                    </a>
                <?php else: ?>
                    <div class="dropdown me-2">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-1"></i><?= htmlspecialchars($userName) ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="index.php?page=myprofile">Tài khoản của tôi</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="customer/controllers/userController.php?action=logout">Đăng xuất</a></li>
                        </ul>
                    </div>
                    <a href="index.php?page=cart" class="btn btn-outline-light position-relative">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cartCount">
                            <?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>
                        </span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
</header>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="customer/views/assets/js/home.js"></script>
</body>
</html>
