<?php
session_start(); // Bắt đầu session để kiểm tra trạng thái đăng nhập
$isLoggedIn = isset($_SESSION['user']); // Kiểm tra nếu người dùng đã đăng nhập
$userName = $isLoggedIn ? $_SESSION['user']['name'] : ''; // Lấy tên người dùng nếu đã đăng nhập
?>
<header>
  <link rel="stylesheet" href="views/assets/css/customer/home.css">
  <script src="views/assets/js/customer/home.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=cart">Sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=service">Dịch vụ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=about-us">Về chúng tôi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=contact">Liên hệ</a>
                </li>
            </ul>
            <div class="d-flex">
                <?php if (!$isLoggedIn): ?>
                    <!-- Hiển thị nút Đăng ký và Đăng nhập khi chưa đăng nhập -->
                    <a href="index.php?page=login" class="btn btn-primary me-2">
                        <i class="bi bi-person-plus me-2"></i> Đăng nhập
                    </a>
                    <a href="index.php?page=sign-in" class="btn btn-primary">
                        <i class="bi bi-person-plus me-2"></i> Đăng ký
                    </a>
                <?php else: ?>
                    <!-- Hiển thị nút My Profile và giỏ hàng khi đã đăng nhập -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i> <?= htmlspecialchars($userName) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="index.php?page=myprofile">Tài khoản của tôi</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="controllers/userController.php?action=logout">Đăng xuất</a></li>
                        </ul>
                    </li>
                    <a href="index.php?page=cart" class="btn btn-outline-light me-2 position-relative">
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
