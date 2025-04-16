<?php
// require_once __DIR__ . '/../../../controllers/userController.php'; // Kết nối với controller xử lý đăng ký
// require_once __DIR__ . '/../../../controllers/loginController.php'; // Kết nối với controller xử lý đăng nhập
require_once __DIR__ . '/../../../controllers/registerController.php'; // Kết nối với controller xử lý đăng ký
?>

<link rel="stylesheet" href="views/assets/css/customer/registerCSS.css">

<body>
    <!-- Registration Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow overflow-hidden">
                        <div class="row g-0">
                            <!-- Left Panel -->
                            <div class="col-lg-5 d-none d-md-flex registration-image">
                                <div>
                                    <h2 class="paint">ColorHomes Paint</h2>
                                    <p>Khám phá những sản phẩm sơn chất lượng cao với ưu đãi đặc biệt dành riêng cho thành viên.</p>
                                    <div class="mt-4">
                                        <i class="bi bi-droplet-fill fs-1"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- Right Panel -->
                            <div class="col-lg-7">
                                <div class="card-body p-4 p-md-5">
                                    <div class="text-center mb-4">
                                        <h2 class="fw-bold">Đăng ký tài khoản</h2>
                                        <p class="text-muted">Tạo tài khoản để trải nghiệm dịch vụ tốt nhất từ ColorHomes Paint</p>
                                    </div>
                                    <!-- Registration Form -->
                                    <form method="POST" action="/WebBanSonLuc/controllers/registerController.php">
                                        <div class="row g-3">
                                            <!-- Họ tên -->
                                            <div class="col-md-6">
                                                <label for="firstName" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="firstName" name="name" placeholder="Nhập họ và tên" required>
                                            </div>
                                            <!-- Số điện thoại -->
                                            <div class="col-md-6">
                                                <label for="phone" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
                                            </div>
                                            <!-- Email -->
                                            <div class="col-12">
                                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Nhập địa chỉ email" required>
                                            </div>
                                            <!-- Mật khẩu -->
                                            <div class="col-md-6">
                                                <label for="password" class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                                            </div>
                                            <!-- Xác nhận mật khẩu -->
                                            <div class="col-md-6">
                                                <label for="confirmPassword" class="form-label">Xác nhận mật khẩu <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control" id="confirmPassword" name="confirm_password" placeholder="Nhập lại mật khẩu" required>
                                            </div>
                                            <!-- Button đăng ký -->
                                            <div class="col-12 mt-4">
                                                <button type="submit" class="btn btn-primary btn-lg w-100">Đăng ký</button>
                                            </div>
                                        </div>
                                    </form>

                                    <?php if (!empty($message)): ?>
                                        <div class="<?php echo $toastClass; ?>">
                                            <?php echo $message; ?>
                                        </div>
                                    <?php endif; ?>
                                    <!-- Đăng nhập link -->
                                    <div class="mt-4 text-center">
                                        <p class="mb-0">Đã có tài khoản? <a href="index.php?page=login" class="text-primary text-decoration-none fw-semibold">Đăng nhập</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>