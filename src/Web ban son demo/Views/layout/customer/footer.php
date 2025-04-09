<footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>ColorHomes Paint</h5>
                    <p>Chuyên cung cấp sơn chất lượng cao cho mọi không gian.</p>
                    <p>
                        <i class="fas fa-map-marker-alt me-2"></i> Tân Phong, Quận 7, TP. HCM<br>
                        <i class="fas fa-phone me-2"></i> 0177744444<br>
                        <i class="fas fa-envelope me-2"></i> HatkumaInfo@paintmaster.com
                    </p>
                </div>
                <div class="col-md-2 mb-4 mb-md-0">
                    <h5>Liên kết</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Trang chủ</a></li>
                        <li><a href="#products" class="text-white">Sản phẩm</a></li>
                        <li><a href="#services" class="text-white">Dịch vụ</a></li>
                        <li><a href="#about" class="text-white">Về chúng tôi</a></li>
                        <li><a href="#contact" class="text-white">Liên hệ</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <h5>Sản phẩm</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Sơn nội thất</a></li>
                        <li><a href="#" class="text-white">Sơn ngoại thất</a></li>
                        <li><a href="#" class="text-white">Sơn chống thấm</a></li>
                        <li><a href="#" class="text-white">Sơn đặc biệt</a></li>
                        <li><a href="#" class="text-white">Dụng cụ sơn</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Đăng ký nhận tin</h5>
                    <p>Nhận thông tin khuyến mãi và cập nhật mới nhất.</p>
                    <form id="newsletterForm">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email của bạn" required>
                            <button class="btn btn-primary" type="submit">Đăng ký</button>
                        </div>
                    </form>
                    <div class="social-icons mt-3">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4 bg-light">
            <div class="text-center">
                <p class="mb-0">&copy; 2025 ColorHomes Paint. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Đăng nhập</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="loginForm">
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="loginEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="loginPassword" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Ghi nhớ đăng nhập</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Đăng nhập</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <p>Chưa có tài khoản? <a href="#" id="registerLink">Đăng ký ngay</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    
     <!-- Gọi file script -->
  <script src="Views/js/script.js"></script>
</body>
</html>
