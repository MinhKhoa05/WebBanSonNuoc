<?php
require_once __DIR__ . '/controllers/UserController.php';

$controller = new UserController();

// Nếu gửi POST -> xử lý login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->admin_login();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập quản trị</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeInUp 0.6s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .login-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-radius: 20px 20px 0 0;
            padding: 30px;
            text-align: center;
        }
        
        .login-header i {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.9;
        }
        
        .form-floating > .form-control {
            border: 2px solid #e9ecef;
            border-radius: 15px;
            transition: all 0.3s ease;
        }
        
        .form-floating > .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .btn-login {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 15px;
            padding: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        
        .alert-custom {
            border: none;
            border-radius: 15px;
            border-left: 4px solid #dc3545;
            background: rgba(220, 53, 69, 0.1);
            color: #721c24;
        }
        
        .input-group-text {
            background: transparent;
            border: 2px solid #e9ecef;
            border-right: none;
            border-radius: 15px 0 0 15px;
        }
        
        .form-control.with-icon {
            border-left: none;
            border-radius: 0 15px 15px 0;
        }
        
        .form-control.with-icon:focus {
            border-color: #667eea;
            box-shadow: none;
        }
        
        .form-control.with-icon:focus + .input-group-text {
            border-color: #667eea;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card login-card border-0">
                    <!-- Header -->
                    <div class="login-header">
                        <i class="fas fa-user-shield"></i>
                        <h3 class="mb-0">Quản trị hệ thống</h3>
                        <p class="mb-0 opacity-75">Đăng nhập để tiếp tục</p>
                    </div>
                    
                    <!-- Body -->
                    <div class="card-body p-4">
                        <!-- Flash Message -->
                        <?php if (isset($_SESSION['flash_message'])): ?>
                            <div class="alert alert-danger alert-custom d-flex align-items-center mb-4" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <div><?= htmlspecialchars($_SESSION['flash_message']['text']) ?></div>
                            </div>
                            <?php unset($_SESSION['flash_message']); ?>
                        <?php endif; ?>
                        
                        <!-- Login Form -->
                        <form method="post" class="needs-validation" novalidate>
                            <!-- Email Input -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope text-muted"></i>
                                    </span>
                                    <input type="email" 
                                           class="form-control form-control-lg with-icon" 
                                           name="email" 
                                           placeholder="Địa chỉ email"
                                           required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập email hợp lệ.
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Password Input -->
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                    <input type="password" 
                                           class="form-control form-control-lg with-icon" 
                                           name="password" 
                                           placeholder="Mật khẩu"
                                           required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập mật khẩu.
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Remember Me -->
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember">
                                    <label class="form-check-label text-muted" for="remember">
                                        Ghi nhớ đăng nhập
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg btn-login">
                                    <i class="fas fa-sign-in-alt me-2"></i>
                                    Đăng nhập
                                </button>
                            </div>
                        </form>
                        
                        <!-- Footer Links -->
                        <div class="text-center mt-4">
                            <a href="#" class="text-decoration-none text-muted">
                                <small><i class="fas fa-question-circle me-1"></i>Quên mật khẩu?</small>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Copyright -->
                <div class="text-center mt-4">
                    <small class="text-white-50">
                        © 2024 Hệ thống quản trị. All rights reserved.
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Form Validation -->
    <script>
        // Bootstrap form validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
        
        // Add loading state to submit button
        document.querySelector('form').addEventListener('submit', function(e) {
            const btn = document.querySelector('.btn-login');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang xử lý...';
            btn.disabled = true;
        });
    </script>
</body>
</html>