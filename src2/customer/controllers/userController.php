<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../models/config.php'; // Kết nối cơ sở dữ liệu
require_once __DIR__ . '/../../models/user.php';

$message = "";
$toastClass = "";

// Hàm xử lý đăng ký
function registerUser($name, $phone, $email, $password, $confirmPassword) {
    global $pdo;

    // Kiểm tra dữ liệu đầu vào
    if (empty(trim($name)) || empty(trim($phone)) || empty(trim($email)) || empty(trim($password)) || empty(trim($confirmPassword))) {
        return [
            'message' => 'Vui lòng điền đầy đủ thông tin.',
            'toastClass' => 'bg-danger'
        ];
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return [
            'message' => 'Email không hợp lệ.',
            'toastClass' => 'bg-danger'
        ];
    }

    if (!preg_match('/^[0-9]{10,11}$/', $phone)) {
        return [
            'message' => 'Số điện thoại không hợp lệ.',
            'toastClass' => 'bg-danger'
        ];
    }

    if ($password !== $confirmPassword) {
        return [
            'message' => 'Mật khẩu xác nhận không khớp.',
            'toastClass' => 'bg-danger'
        ];
    }

    

    // Mã hóa mật khẩu
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // // Kiểm tra email đã tồn tại
    if (user_is_email_exists($email)) {
        return [
            'message' => 'Email đã được sử dụng.',
            'toastClass' => 'bg-warning'
        ];
    }
    
   // Thêm người dùng mới vào cơ sở dữ liệu
    user_insert($name, $email, $hashedPassword, $phone, 'user');

    // $sql = "INSERT INTO users (name, phone, email, password) VALUES (:name, :phone, :email, :password)";
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute([
    //     'name' => $name,
    //     'phone' => $phone,
    //     'email' => $email,
    //     'password' => $hashedPassword
    // ]);
    return [
        'message' => 'Đăng ký thành công!',
        'toastClass' => 'bg-success'
    ];
}

// Hàm xử lý đăng nhập
function loginUser($email, $password) {
    global $pdo;

    // Kiểm tra dữ liệu đầu vào
    if (empty($email) || empty($password)) {
        return [
            'message' => 'Vui lòng điền đầy đủ thông tin.',
            'toastClass' => 'bg-danger'
        ];
    }

    // Lấy thông tin người dùng từ cơ sở dữ liệu
    // $sql = "SELECT * FROM users WHERE email = :email";
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute(['email' => $email]);
    // $user = $stmt->fetch();

    // if (!$user || !password_verify($password, $user['password'])) {
    //     return [
    //         'message' => 'Email hoặc mật khẩu không đúng.',
    //         'toastClass' => 'bg-danger'
    //     ];
    // }
    $user = user_login($email, $password);

    // Lưu thông tin người dùng vào session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['username'];

    return [
        'message' => 'Đăng nhập thành công!',
        'toastClass' => 'bg-success'
    ];
}

// Hàm xử lý đăng xuất
function logoutUser() {
    session_destroy();
    header('Location: ../../index.php');
    exit;
}

// Lấy hành động từ query string
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Xử lý các hành động
switch ($action) {
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = isset($_POST['name']) ? trim($_POST['name']) : null;
            $phone = isset($_POST['phone']) ? trim($_POST['phone']) : null;
            $email = isset($_POST['email']) ? trim($_POST['email']) : null;
            $password = isset($_POST['password']) ? trim($_POST['password']) : null;
            $confirm_password = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : null;

            $result = registerUser($name, $phone, $email, $password, $confirm_password);
            $message = $result['message'];
            $toastClass = $result['toastClass'];
        }
        break;

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = isset($_POST['email']) ? trim($_POST['email']) : null;
            $password = isset($_POST['password']) ? trim($_POST['password']) : null;

            $result = loginUser($email, $password);
            $message = $result['message'];
            $toastClass = $result['toastClass'];

            // Chuyển hướng nếu đăng nhập thành công
            if ($toastClass === 'bg-success') {
                header('Location: ../../index.php');
                exit;
            }
        }
        break;

    case 'logout':
        logoutUser();
        break;
}
?>