<?php
// register.php
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - ColorHomes Paint</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body { margin:0; padding:0; background: linear-gradient(135deg,rgb(186, 242, 253) 0%,rgb(203, 128, 215) 100%); }
        .image-panel {
            position: relative;
            background-image: url('customer/views/assets/images/Hình.jpg');
            background-size: cover;
            background-position: center;
            min-height: 856px;
            margin-top: 60px;  
        }
        .image-overlay {
            position: absolute; top:0; left:0; right:0; bottom:0;
            background: linear-gradient(135deg, rgba(191, 134, 241, 0.24), rgba(11, 101, 112, 0.8));
            display: flex; flex-direction: column; justify-content: space-between; padding: 2rem;
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
            margin-top: 40px; 

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
        .welcome-content h3 {  padding: 100px 25px 20px 15px;color:#fff; font-size:2.5rem; font-weight:600; text-shadow:1px 1px 2px rgba(0,0,0,0.3); }
        .welcome-content p { color:#fff; font-size:1.1rem; opacity:0.9; line-height:1.6; text-shadow:1px 1px 2px rgba(0,0,0,0.3); }
        .color-dots { display:flex; justify-content:center; gap:1rem; margin-top:2rem; animation: float 3s ease-in-out infinite; }
        .color-dot { width:20px; height:20px; border-radius:50%; box-shadow:0 4px 8px rgba(0,0,0,0.2); transition:transform 0.3s ease; }
        .color-dot:hover { transform:scale(1.2); }
        @keyframes float { 0%,100%{transform:translateY(0);}50%{transform:translateY(-10px);} }
        .form-panel {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 3rem 2.5rem;
            margin-top: 60px;  
            
        }
        .form-title {
            text-align: center;
            margin-bottom: 2rem;
        }
        .input-group-text { background: rgba(59, 130, 246, 0.1); border:2px solid #e2e8f0; border-right:none; color:#3b82f6; padding:0.75rem 1rem; }
        .form-control { border:2px solid #e2e8f0; padding:0.75rem 1rem; transition:all 0.3s ease; }
        .form-control:focus { border-color:#3b82f6; box-shadow:0 0 0 3px rgba(59,130,246,0.1); }
        .input-group:focus-within .input-group-text { border-color:#3b82f6; background:rgba(59,130,246,0.15); }
        .btn-primary { background-color:#3b82f6; border:none; padding:0.75rem 1rem; font-weight:500; border-radius:10px; transition:all 0.3s ease; }
        .btn-primary:hover { transform:translateY(-1px); box-shadow:0 4px 12px rgba(0,0,0,0.1); }
        @media (max-width:991.98px) { .image-panel { display:none; } .form-panel { padding:2rem; } }
    </style>
</head>
<body>
    <div class="container-fluid d-flex align-items-center justify-content-center py-4" style="min-height: 100vh;">
        <div class="login-container" style="max-width: 1100px; width: 100%;">
            <div class="row g-0">
                <!-- Left Panel - Visual -->
                <div class="col-lg-5">
                    <div class="image-panel">
                        <div class="image-overlay text-center text-white">
                            <div>
                                <div class="brand-logo"><i class="bi bi-droplet-fill"></i> ColorHomes Paint</div>
                                <div class="welcome-content mt-4">
                                    <h3  style="margin-bottom: 30px; margin-top: 20px;">Chào mừng bạn!</h3>
                                    
                                    <p style="margin-bottom: 90px;">Đăng ký để khám phá những sản phẩm và ưu đãi đặc biệt dành riêng cho bạn.</p>
                                    <div class="color-dots">
                                        <div class="color-dot" style="background-color:#ef4444;"></div>
                                        <div class="color-dot" style="background-color:#3b82f6;"></div>
                                        <div class="color-dot" style="background-color:#10b981;"></div>
                                        <div class="color-dot" style="background-color:#f59e0b;"></div>
                                        <div class="color-dot" style="background-color:#8b5cf6;"></div>
                                    </div>
                                </div>
                            </div>
                            <div><small style="opacity:0.8;">&copy; 2025 ColorHomes Paint. Tất cả quyền được bảo lưu.</small></div>
                        </div>
                    </div>
                </div>
                <!-- Right Panel - Registration Form -->
                <div class="col-lg-7">
                    <div class="form-panel">
                        <div class="form-title">
                            <h2>Đăng ký tài khoản</h2>
                            <p>Vui lòng điền thông tin để tạo tài khoản mới</p>
                        </div>
                        <form method="POST" action="customer/controllers/registerController.php">
                            <div class="mb-3">
                                <label class="form-label">Họ và tên<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" name="name" placeholder="Nhập họ và tên" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Số điện thoại<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                    <input type="tel" class="form-control" name="phone" placeholder="Nhập số điện thoại" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control" name="email" placeholder="example@gmail.com" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mật khẩu<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Xác nhận mật khẩu<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                    <input type="password" class="form-control" name="confirm_password" placeholder="Nhập lại mật khẩu" required>
                                </div>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="agree" name="agree" required>
                                <label class="form-check-label" for="agree">
                                    Tôi đồng ý với <a href="#" class="text-primary text-decoration-none">Điều khoản dịch vụ</a> và <a href="#" class="text-primary text-decoration-none">Chính sách bảo mật</a>
                                </label>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">Đăng ký</button>
                            </div>
                        </form>
                        <?php if (!empty($message)): ?>
                            <div class="mt-4 <?php echo $toastClass; ?>">
                                <?php echo $message; ?>
                            </div>
                        <?php endif; ?>
                        <div class="mt-4 text-center">
                            <p>Bạn đã có tài khoản? <a href="login.php" class="text-primary text-decoration-none fw-semibold">Đăng nhập</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
