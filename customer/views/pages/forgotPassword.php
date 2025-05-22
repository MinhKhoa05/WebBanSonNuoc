<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu - ColorHomes Paint</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg,rgb(186, 242, 253) 0%,rgb(203, 128, 215) 100%);
            min-height: 100vh;
        }
        
        .forgot-container {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            max-width: 1100px;        
            min-width: 900px;         
            width: 100%;
            height: 650px;           
        }
        
        .image-panel {
            position: relative;
            background-image: url('customer/views/assets/images/b.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100%;             
        }
        
        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(12, 205, 154, 0.44), rgba(13, 113, 144, 0.8));
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 2rem;
        }
        
        @keyframes gradientLoop {
            0% { background-position: 0% 50%; }
            100% { background-position: 200% 50%; }
        }

        .brand-logo {
            font-size: 1.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            background: linear-gradient(90deg, red, orange, yellow, green, blue, indigo, violet, red);
            background-size: 200% auto;
            -webkit-background-clip: text;
            color: transparent;
            animation: gradientLoop 8s infinite linear; 
        }

        .welcome-content {
            text-align: center;
            color: white;
        }
        
        .welcome-content h3 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .welcome-content p {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }
        
        .security-icon {
            font-size: 4rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 2rem;
            animation: pulse 2s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.8; }
            50% { transform: scale(1.1); opacity: 1; }
        }
        
        .form-panel {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 2rem 2.5rem;
            height: 100%;             /* Chiều cao đầy đủ */
            overflow-y: auto;         /* Cuộn dọc khi cần */
            display: flex;
            flex-direction: column;
            justify-content: center;  /* Căn giữa theo chiều dọc */
        }
        
        .form-title {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .form-title h2 {
            font-size: 2.2rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }
        
        .form-title p {
            color: #64748b;
            font-size: 1rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }
        
        .input-group {
            position: relative;
        }
        
        .input-group-text {
            background: rgba(59, 130, 246, 0.1);
            border: 2px solid #e2e8f0;
            border-right: none;
            color: #3b82f6;
            padding: 0.75rem 1rem;
        }
        
        .form-control {
            border: 2px solid #e2e8f0;
            border-left: none;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .input-group:focus-within .input-group-text {
            border-color: #3b82f6;
            background: rgba(59, 130, 246, 0.15);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border: none;
            padding: 0.875rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
        }
        
        .btn-secondary {
            background: rgba(107, 114, 128, 0.1);
            border: 2px solid #e2e8f0;
            color: #374151;
            padding: 0.875rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background: rgba(107, 114, 128, 0.15);
            border-color: #d1d5db;
        }
        
        .back-link {
            text-align: center;
            margin-top: 1.5rem;
        }
        
        .back-link a {
            color: #3b82f6;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .back-link a:hover {
            color: #2563eb;
        }
        
        .alert {
            border-radius: 10px;
            border: none;
            margin-bottom: 1.5rem;
        }
        
        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: #065f46;
            border-left: 4px solid #10b981;
        }
        
        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #7f1d1d;
            border-left: 4px solid #ef4444;
        }
        
        .step-indicator {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
        }
        
        .step.active {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        
        .step.completed {
            background: #10b981;
            color: white;
        }
        
        .step.inactive {
            background: #e2e8f0;
            color: #64748b;
        }
        
        .step-line {
            width: 50px;
            height: 2px;
            background: #e2e8f0;
            margin: 0 0.5rem;
        }
        
        .row.g-0 {
            height: 100%;             /* Đảm bảo row có chiều cao đầy đủ */
        }
        
        .col-lg-5, .col-lg-7 {
            height: 100%;             /* Đảm bảo các cột có chiều cao bằng nhau */
        }
        
        @media (max-width: 991.98px) {
            .forgot-container {
                min-width: auto;      /* Bỏ giới hạn chiều rộng trên mobile */
                height: auto;         /* Chiều cao tự động trên mobile */
            }
            
            .image-panel {
                height: 300px;        /* Chiều cao cố định cho mobile */
            }
            
            .form-panel {
                padding: 2rem 1.5rem;
                height: auto;         /* Chiều cao tự động trên mobile */
            }
            
            .welcome-content h3 {
                font-size: 2rem;
            }
            
            .col-lg-5, .col-lg-7 {
                height: auto;         /* Chiều cao tự động trên mobile */
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid d-flex align-items-center justify-content-center py-4" style="min-height: 100vh;">
        <div class="forgot-container">
            <div class="row g-0">
                <!-- Left Panel - Image with Overlay -->
                <div class="col-lg-5">
                    <div class="image-panel">
                        <div class="image-overlay">
                            <div>
                                <div class="brand-logo">
                                    <i class="bi bi-droplet-fill"></i>
                                    ColorHomes Paint
                                </div>
                            </div>
                            
                            <div class="welcome-content">
                                <div class="security-icon">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <h3>Bảo mật tài khoản</h3>
                                <p>Chúng tôi sẽ giúp bạn khôi phục mật khẩu một cách an toàn và nhanh chóng. Vui lòng làm theo hướng dẫn để đặt lại mật khẩu mới.</p>
                            </div>
                            
                            <div class="text-center">
                                <small style="opacity: 0.8;">&copy; 2025 ColorHomes Paint. Tất cả quyền được bảo lưu.</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Panel - Forms -->
                <div class="col-lg-7">
                    <div class="form-panel">
                        <!-- Step 1: Forgot Password Form -->
                        <div id="forgotPasswordForm" class="form-step active">
                            <div class="step-indicator">
                                <div class="step active">1</div>
                                <div class="step-line"></div>
                                <div class="step inactive">2</div>
                                <div class="step-line"></div>
                                <div class="step inactive">3</div>
                            </div>
                            
                            <div class="form-title">
                                <h2>Quên mật khẩu</h2>
                                <p>Nhập email của bạn để nhận liên kết đặt lại mật khẩu</p>
                            </div>
                            
                            <form id="forgotForm">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-envelope"></i>
                                        </span>
                                        <input type="email" class="form-control" name="email" placeholder="example@gmail.com" required>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary text-white w-100 mb-3">
                                    <i class="bi bi-envelope-arrow-up me-2"></i>Gửi liên kết đặt lại
                                </button>
                                
                                <div class="back-link">
                                    <a href="index.php?page=login">
                                        <i class="bi bi-arrow-left"></i>
                                        Quay lại đăng nhập
                                    </a>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Step 2: Verification Code -->
                        <div id="verificationForm" class="form-step" style="display: none;">
                            <div class="step-indicator">
                                <div class="step completed">
                                    <i class="bi bi-check"></i>
                                </div>
                                <div class="step-line completed"></div>
                                <div class="step active">2</div>
                                <div class="step-line"></div>
                                <div class="step inactive">3</div>
                            </div>
                            
                            <div class="form-title">
                                <h2>Xác thực email</h2>
                                <p>Chúng tôi đã gửi mã xác thực đến email của bạn</p>
                            </div>
                            
                            <div class="alert alert-success">
                                <i class="bi bi-check-circle me-2"></i>
                                Email đã được gửi thành công! Vui lòng kiểm tra hộp thư của bạn.
                            </div>
                            
                            <form id="verifyForm">
                                <div class="form-group">
                                    <label for="verification_code" class="form-label">Mã xác thực</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-key"></i>
                                        </span>
                                        <input type="text" class="form-control text-center" name="verification_code" placeholder="Nhập mã 6 số" maxlength="6" required>
                                    </div>
                                    <small class="text-muted">Không nhận được mã? <a href="#" id="resendCode" class="text-primary">Gửi lại</a></small>
                                </div>
                                
                                <button type="submit" class="btn btn-primary text-white w-100 mb-3">
                                    <i class="bi bi-check-circle me-2"></i>Xác thực
                                </button>
                                
                                <div class="back-link">
                                    <a href="#" id="backToEmail">
                                        <i class="bi bi-arrow-left"></i>
                                        Thay đổi email
                                    </a>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Step 3: Reset Password -->
                        <div id="resetPasswordForm" class="form-step" style="display: none;">
                            <div class="step-indicator">
                                <div class="step completed">
                                    <i class="bi bi-check"></i>
                                </div>
                                <div class="step-line completed"></div>
                                <div class="step completed">
                                    <i class="bi bi-check"></i>
                                </div>
                                <div class="step-line completed"></div>
                                <div class="step active">3</div>
                            </div>
                            
                            <div class="form-title">
                                <h2>Đặt lại mật khẩu</h2>
                                <p>Tạo mật khẩu mới cho tài khoản của bạn</p>
                            </div>
                            
                            <form id="resetForm">
                                <div class="form-group">
                                    <label for="new_password" class="form-label">Mật khẩu mới</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-lock"></i>
                                        </span>
                                        <input type="password" class="form-control" name="new_password" placeholder="Nhập mật khẩu mới" required>
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword1">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    <small class="text-muted">Mật khẩu phải có ít nhất 8 ký tự</small>
                                </div>
                                
                                <div class="form-group">
                                    <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-lock-fill"></i>
                                        </span>
                                        <input type="password" class="form-control" name="confirm_password" placeholder="Nhập lại mật khẩu mới" required>
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword2">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="password-strength mb-3">
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                                    </div>
                                    <small class="text-muted">Độ mạnh mật khẩu: <span id="strengthText">Rất yếu</span></small>
                                </div>
                                
                                <button type="submit" class="btn btn-primary text-white w-100 mb-3">
                                    <i class="bi bi-check-circle me-2"></i>Đặt lại mật khẩu
                                </button>
                                
                                <div class="back-link">
                                    <a href="index.php?page=login">
                                        <i class="bi bi-arrow-left"></i>
                                        Quay lại đăng nhập
                                    </a>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Success Message -->
                        <div id="successMessage" class="form-step" style="display: none;">
                            <div class="text-center">
                                <div class="mb-4">
                                    <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                                </div>
                                <h2 class="text-success mb-3">Thành công!</h2>
                                <p class="mb-4">Mật khẩu của bạn đã được đặt lại thành công. Bạn có thể đăng nhập ngay bây giờ.</p>
                                <a href="login.php" class="btn btn-primary">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Đăng nhập ngay
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form step management
        const steps = {
            forgot: document.getElementById('forgotPasswordForm'),
            verification: document.getElementById('verificationForm'),
            reset: document.getElementById('resetPasswordForm'),
            success: document.getElementById('successMessage')
        };
        
        function showStep(stepName) {
            Object.values(steps).forEach(step => step.style.display = 'none');
            steps[stepName].style.display = 'block';
        }
        
        // Handle forgot password form
        document.getElementById('forgotForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[name="email"]').value;
            
            // Simulate API call
            const btn = this.querySelector('button[type="submit"]');
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Đang gửi...';
            btn.disabled = true;
            
            setTimeout(() => {
                showStep('verification');
                btn.innerHTML = '<i class="bi bi-envelope-arrow-up me-2"></i>Gửi liên kết đặt lại';
                btn.disabled = false;
            }, 2000);
        });
        
        // Handle verification form
        document.getElementById('verifyForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const code = this.querySelector('input[name="verification_code"]').value;
            
            if (code.length !== 6) {
                alert('Vui lòng nhập đầy đủ mã 6 số');
                return;
            }
            
            const btn = this.querySelector('button[type="submit"]');
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Đang xác thực...';
            btn.disabled = true;
            
            setTimeout(() => {
                showStep('reset');
                btn.innerHTML = '<i class="bi bi-check-circle me-2"></i>Xác thực';
                btn.disabled = false;
            }, 1500);
        });
        
        // Handle reset password form
        document.getElementById('resetForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const newPassword = this.querySelector('input[name="new_password"]').value;
            const confirmPassword = this.querySelector('input[name="confirm_password"]').value;
            
            if (newPassword !== confirmPassword) {
                alert('Mật khẩu xác nhận không khớp');
                return;
            }
            
            if (newPassword.length < 8) {
                alert('Mật khẩu phải có ít nhất 8 ký tự');
                return;
            }
            
            const btn = this.querySelector('button[type="submit"]');
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Đang cập nhật...';
            btn.disabled = true;
            
            setTimeout(() => {
                showStep('success');
            }, 2000);
        });
        
        // Back navigation
        document.getElementById('backToEmail').addEventListener('click', function(e) {
            e.preventDefault();
            showStep('forgot');
        });
        
        // Resend code
        document.getElementById('resendCode').addEventListener('click', function(e) {
            e.preventDefault();
            this.textContent = 'Đang gửi...';
            setTimeout(() => {
                this.textContent = 'Đã gửi lại';
                setTimeout(() => {
                    this.textContent = 'Gửi lại';
                }, 3000);
            }, 1000);
        });
        
        // Password visibility toggle
        document.getElementById('togglePassword1').addEventListener('click', function() {
            const passwordField = document.querySelector('input[name="new_password"]');
            const icon = this.querySelector('i');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.className = 'bi bi-eye-slash';
            } else {
                passwordField.type = 'password';
                icon.className = 'bi bi-eye';
            }
        });
        
        document.getElementById('togglePassword2').addEventListener('click', function() {
            const passwordField = document.querySelector('input[name="confirm_password"]');
            const icon = this.querySelector('i');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.className = 'bi bi-eye-slash';
            } else {
                passwordField.type = 'password';
                icon.className = 'bi bi-eye';
            }
        });
        
        // Password strength checker
        document.querySelector('input[name="new_password"]').addEventListener('input', function() {
            const password = this.value;
            const progressBar = document.querySelector('.progress-bar');
            const strengthText = document.getElementById('strengthText');
            
            let strength = 0;
            let text = 'Rất yếu';
            let color = 'bg-danger';
            
            if (password.length >= 8) strength += 25;
            if (/[a-z]/.test(password)) strength += 25;
            if (/[A-Z]/.test(password)) strength += 25;
            if (/[0-9]/.test(password)) strength += 25;
            
            if (strength >= 75) {
                text = 'Mạnh';
                color = 'bg-success';
            } else if (strength >= 50) {
                text = 'Trung bình';
                color = 'bg-warning';
            } else if (strength >= 25) {
                text = 'Yếu';
                color = 'bg-danger';
            }
            
            progressBar.style.width = strength + '%';
            progressBar.className = 'progress-bar ' + color;
            strengthText.textContent = text;
        });
        
        // Form input focus effects
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
        });
        
        // Auto-format verification code
        document.querySelector('input[name="verification_code"]').addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
</body>
</html>