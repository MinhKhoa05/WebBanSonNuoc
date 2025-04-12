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
                                    <form>
                                        <div class="row g-3">
                                            <!-- Họ tên -->
                                            <div class="col-md-6">
                                                <label for="firstName" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="firstName" placeholder="Nhập họ và tên" required>
                                            </div>
                                            <!-- Số điện thoại -->
                                            <div class="col-md-6">
                                                <label for="phone" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                                <input type="tel" class="form-control" id="phone" placeholder="Nhập số điện thoại" required>
                                            </div>
                                            <!-- Email -->
                                            <div class="col-12">
                                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" id="email" placeholder="Nhập địa chỉ email" required>
                                            </div>
                                            <!-- Mật khẩu -->
                                            <div class="col-md-6">
                                                <label for="password" class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control" id="password" placeholder="Nhập mật khẩu" required>
                                            </div>
                                            <!-- Xác nhận mật khẩu -->
                                            <div class="col-md-6">
                                                <label for="confirmPassword" class="form-label">Xác nhận mật khẩu <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control" id="confirmPassword" placeholder="Nhập lại mật khẩu" required>
                                            </div>
                                            <!-- Điều khoản -->
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="terms" required>
                                                    <label class="form-check-label" for="terms">
                                                        Tôi đồng ý với <a href="#" class="text-primary">Điều khoản dịch vụ</a> và <a href="#" class="text-primary">Chính sách bảo mật</a>.
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- Button đăng ký -->
                                            <div class="col-12 mt-4">
                                                <button type="submit" class="btn btn-primary btn-lg w-100">Đăng ký</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- Đăng nhập link -->
                                    <div class="mt-4 text-center">
                                        <p class="mb-0">Đã có tài khoản? <a href="#" class="text-primary">Đăng nhập</a></p>
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