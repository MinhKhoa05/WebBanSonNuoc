<header>
  <link rel="stylesheet" href="assets/css/style-home.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- <script src="../assets/js/customer/home.js"></script> -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" style="position: fixed; width: 100%; z-index: 999;">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="bi bi-droplet-fill me-2"></i>ColorHomes Paint
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto active">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Trang chủ</a>
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
                <!-- <li class="nav-item">
                    <a class="nav-link" href="index.php?page=cart">Giỏ hàng</a>
                </li> -->
            </ul>
            <div class="d-flex">
                <button class="btn btn-primary me-2">
                <a class="nav-link" href="index.php?page=login">
                    <i class="bi bi-box-arrow-in-right me-2"></i> Đăng nhập
                </a>    
                </button>
                <button class="btn btn-primary me-2">
                    <a class="nav-link" href="index.php?page=sign-in">
                        <i class="bi bi-person-plus me-2"></i> Đăng ký
                    </a>
                </button>
                <a href="index.php?page=cart" class="btn btn-outline-light me-2 position-relative">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cartCount">
                        3 <!-- Số lượng mặc định trên giỏ hàng/:)-->
                    </span>
                </a>
            </div>
        </div>
    </div>
</nav>
</header>
