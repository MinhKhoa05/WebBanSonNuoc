<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PaintMaster</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="assets/css/style-home.css">
  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- <script src="../assets/js/customer/home.js"></script> -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="customer.php">
            <i class="bi bi-droplet-fill me-2"></i>ColorHomes Paint
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto active">
                <li class="nav-item">
                    <a class="nav-link active" href="customer.php">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="customer.php?page=cart">Sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="customer.php?page=service">Dịch vụ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="customer.php?page=about-us">Về chúng tôi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="customer.php?page=contact">Liên hệ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="customer.php?page=cart">Giỏ hàng</a>
                </li>
            </ul>
            <div class="d-flex">
                <button class="btn btn-primary me-2">
                <a class="nav-link" href="customer.php?page=login">
                    <i class="bi bi-box-arrow-in-right me-2"></i> Đăng nhập
                </a>    
                </button>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
                    <i class="fas fa-user"></i> Đăng ký
                </button>
            </div>
        </div>
    </div>
</nav>
</head>
