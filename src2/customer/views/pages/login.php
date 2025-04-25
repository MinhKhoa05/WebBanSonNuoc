<body class="bg-light">
    <div class="container login-height d-flex align-items-center justify-content-center py-5" style="min-height: 100vh;">
        <div class="row g-0 shadow rounded-4 overflow-hidden" style="max-width: 1000px;">
            <!-- Left Panel - Banner -->
            <div class="col-lg-5 paint-gradient text-white p-4 p-md-5 d-flex flex-column" style="background: linear-gradient(135deg, #2563eb, #1e40af);">
                <div class="mb-4">
                    <h2 class="fs-3 fw-bold d-flex align-items-center">
                        <i class="bi bi-droplet-fill me-2"></i>
                        ColorHomes Paint
                    </h2>
                </div>
                
                <div class="my-auto py-5 d-none d-lg-block">
                    <h3 class="fs-2 mb-4">Chào mừng trở lại!</h3>
                    <p class="opacity-75">Đăng nhập để khám phá những sản phẩm sơn chất lượng cao, đa dạng màu sắc với ưu đãi đặc biệt dành riêng cho thành viên.</p>
                    
                    <div class="mt-5 text-center">
                        <div class="d-flex justify-content-center mt-4">
                            <span class="rounded-circle bg-danger p-3 mx-1"></span>
                            <span class="rounded-circle bg-primary p-3 mx-1"></span>
                            <span class="rounded-circle bg-success p-3 mx-1"></span>
                            <span class="rounded-circle bg-warning p-3 mx-1"></span>
                        </div>
                    </div>
                </div>
                
                <div class="mt-auto text-center opacity-75 d-none d-lg-block">
                    <small>&copy; 2025 ColorHomes Paint. Tất cả quyền được bảo lưu.</small>
                </div>
            </div>
            
            <!-- Right Panel - Login Form -->
            <div class="col-lg-7 bg-white p-4 p-md-5">
                <div class="text-center mb-4">
                    <h2 class="fs-2 fw-bold mb-2">Đăng nhập</h2>
                    <p class="text-muted">Vui lòng nhập thông tin tài khoản của bạn</p>
                </div>
                
                <form action="customer/controllers/loginController.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email hoặc số điện thoại</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" class="form-control border-start-0" name="email" placeholder="example@gmail.com" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password" class="form-control border-start-0" name="password" placeholder="••••••••" required>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">
                                Ghi nhớ đăng nhập
                            </label>
                        </div>
                        <a href="#" class="text-decoration-none">Quên mật khẩu?</a>
                    </div>
                    
                    <button type="submit" class="btn bg-paint-primary text-white w-100 py-2 mb-3" style="background-color: #2563eb;">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Đăng nhập
                    </button>
                    
                    <div class="position-relative my-4">
                        <hr>
                        <p class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small">Hoặc đăng nhập với</p>
                    </div>
                    
                    <div class="row g-2 mb-4">
                        <div class="col">
                            <button type="button" class="btn btn-outline-secondary w-100">
                                <i class="bi bi-google me-2"></i>Google
                            </button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-outline-secondary w-100">
                                <i class="bi bi-facebook me-2"></i>Facebook
                            </button>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <p class="mb-0">Chưa có tài khoản? 
                            <a href="index.php?page=sign-up" class="text-decoration-none fw-semibold">Đăng ký ngay</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>