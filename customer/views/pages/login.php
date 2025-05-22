<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - ColorHomes Paint</title>
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
        
        .login-container {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
        }
        
        .image-panel {
            position: relative;
            background-image: url('customer/views/assets/images/Mau-no.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
<<<<<<< Updated upstream
            min-height: 585px;
=======
            height: 100%; 
>>>>>>> Stashed changes
        }
        
        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(191, 134, 241, 0.44), rgba(11, 101, 112, 0.8));
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 2rem;
        }
        
        @keyframes gradientLoop {
            0% { background-position: 0% 50%; }
            100% { background-position: 200% 50%; } /* Di chuyển liên tục */
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
        
        .color-dots {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }
        
        .color-dot {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }
        
        .color-dot:hover {
            transform: scale(1.2);
        }
        
        .form-panel {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 3rem 2.5rem;
<<<<<<< Updated upstream
=======
            height: 100%;             
            overflow-y: auto;         
            display: flex;
            flex-direction: column;
            justify-content: center;  
>>>>>>> Stashed changes
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
        
        .btn-login {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border: none;
            padding: 0.875rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
        }
        
        .social-buttons .btn {
            border: 2px solid #e2e8f0;
            padding: 0.75rem;
            font-weight: 500;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .social-buttons .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .divider {
            position: relative;
            text-align: center;
            margin: 2rem 0;
        }
        
        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            transform: translateY(-50%); 
            height: 1px;
            background: #e2e8f0;
            z-index: 0;
        }

        .divider span {
            position: relative;
            z-index: 1; 
            background: rgba(255, 255, 255, 0.95);
            padding: 0 1rem;
            color: #64748b;
            font-size: 0.9rem;
        }
        
        .signup-link {
            text-align: center;
            margin-top: 1.5rem;
        }
        
        .signup-link a {
            color: #3b82f6;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .signup-link a:hover {
            color: #2563eb;
        }
        
        .form-check-input:checked {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }
        
        .forgot-password {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .forgot-password:hover {
            color: #2563eb;
        }
        
        @media (max-width: 991.98px) {
            .image-panel {
                min-height: 300px;
<<<<<<< Updated upstream
=======
                
>>>>>>> Stashed changes
            }
            
            .form-panel {
                padding: 2rem 1.5rem;
<<<<<<< Updated upstream
=======
                height: auto;  
>>>>>>> Stashed changes
            }
            
            .welcome-content h3 {
                font-size: 2rem;
            }
        }
        
        /* Floating animation */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .color-dots {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>
<body>
    <div class="container-fluid d-flex align-items-center justify-content-center py-4" style="min-height: 100vh;">
        <div class="login-container" style="max-width: 1100px; width: 100%;">
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
                                <h3>Chào mừng trở lại!</h3>
                                <p>Đăng nhập để khám phá những sản phẩm sơn chất lượng cao, đa dạng màu sắc với ưu đãi đặc biệt dành riêng cho thành viên.</p>
                                
                                <div class="color-dots">
                                    <div class="color-dot" style="background-color: #ef4444;"></div>
                                    <div class="color-dot" style="background-color: #3b82f6;"></div>
                                    <div class="color-dot" style="background-color: #10b981;"></div>
                                    <div class="color-dot" style="background-color: #f59e0b;"></div>
                                    <div class="color-dot" style="background-color: #8b5cf6;"></div>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <small style="opacity: 0.8;">&copy; 2025 ColorHomes Paint. Tất cả quyền được bảo lưu.</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Panel - Login Form -->
                <div class="col-lg-7">
                    <div class="form-panel">
                        <div class="form-title">
                            <h2>Đăng nhập</h2>
                            <p>Vui lòng nhập thông tin tài khoản của bạn</p>
                        </div>
                        
                        <form action="customer/controllers/loginController.php" method="POST">
                            <div class="form-group">
                                <label for="email" class="form-label">Email hoặc số điện thoại</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control" name="email" placeholder="example@gmail.com" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <div class="input-group">
<<<<<<< Updated upstream
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" name="password" placeholder="enter your password" required>
=======
                                     <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" name="password" placeholder="enter your password" required>
                                    <!-- Thêm nút hiện mật khẩu -->
                                    <button class="btn btn-outline-secondary" type="button" id="toggleLoginPassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
>>>>>>> Stashed changes
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">
                                        Ghi nhớ đăng nhập
                                    </label>
                                </div>
<<<<<<< Updated upstream
                                <a href="#" class="forgot-password">Quên mật khẩu?</a>
=======
                                <a href="/WebBanSonNuoc/index.php?page=forgotPassword" class="forgot-password">Quên/đổi mật khẩu?</a>
>>>>>>> Stashed changes
                            </div>
                            
                            <button type="submit" class="btn btn-login text-white w-100 mb-3">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Đăng nhập
                            </button>
                            
                            <!-- <div class="divider">
                                <span>Hoặc đăng nhập với</span>
                            </div>
                            
                            <div class="social-buttons row g-3 mb-4">
                                <div class="col-6">
                                    <button type="button" class="btn btn-outline-secondary w-100">
                                        <i class="bi bi-google me-2 text-danger"></i>Google
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-outline-secondary w-100">
                                        <i class="bi bi-facebook me-2 text-primary"></i>Facebook
                                    </button>
                                </div>
                            </div> -->
                            
                            <div class="signup-link">
                                <p class="mb-0">Chưa có tài khoản? 
                                    <a href="index.php?page=sign-in">Đăng ký ngay</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add smooth focus transitions
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
        });
        
        // Add loading state to login button
        document.querySelector('form').addEventListener('submit', function() {
            const btn = this.querySelector('.btn-login');
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Đang đăng nhập...';
            btn.disabled = true;
        });
<<<<<<< Updated upstream
=======
        //HIỆN MẬT KHẨU
        document.getElementById('toggleLoginPassword').addEventListener('click', function() {
        const passwordField = document.querySelector('input[name="password"]');
        const icon = this.querySelector('i');
        
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            passwordField.type = 'password';
            icon.className = 'bi bi-eye';
        }
    });
>>>>>>> Stashed changes
    </script>
</body>
</html>