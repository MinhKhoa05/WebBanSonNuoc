<?php
session_start();
require_once __DIR__ . '/../models/db.php'; // Kết nối cơ sở dữ liệu

// Hàm kiểm tra trạng thái đăng nhập
function checkAuthen() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: ../index.php?page=login');
        exit;
    }
}

// Hàm xử lý đăng ký
function registerUser($name, $email, $password, $confirmPassword) {
    global $pdo;

    // Kiểm tra dữ liệu đầu vào
    if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
        die('Vui lòng điền đầy đủ thông tin.');
    }

    if ($password !== $confirmPassword) {
        die('Mật khẩu xác nhận không khớp.');
    }

    // Mã hóa mật khẩu
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Kiểm tra email đã tồn tại
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    if ($stmt->fetch()) {
        die('Email đã được sử dụng.');
    }

    // Thêm người dùng mới vào cơ sở dữ liệu
    $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'name' => $name,
        'email' => $email,
        'password' => $hashedPassword
    ]);

    // Chuyển hướng đến trang đăng nhập
    header('Location: ../index.php?page=login');
    exit;
}

// Hàm xử lý đăng nhập
function loginUser($email, $password) {
    global $pdo;

    // Kiểm tra dữ liệu đầu vào
    if (empty($email) || empty($password)) {
        die('Vui lòng điền đầy đủ thông tin.');
    }

    // Lấy thông tin người dùng từ cơ sở dữ liệu
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['password'])) {
        die('Email hoặc mật khẩu không đúng.');
    }

    // Lưu thông tin người dùng vào session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];

    // Chuyển hướng đến trang chủ
    header('Location: ../index.php');
    exit;
}

// Hàm xử lý đăng xuất
function logoutUser() {
    session_destroy();
    header('Location: ../index.php');
    exit;
}

// Lấy hành động từ query string
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Xử lý các hành động
switch ($action) {
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            registerUser(
                trim($_POST['name']),
                trim($_POST['email']),
                trim($_POST['password']),
                trim($_POST['confirm_password'])
            );
        }
        break;

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            loginUser(
                trim($_POST['email']),
                trim($_POST['password'])
            );
        }
        break;

    case 'logout':
        logoutUser();
        break;

    case 'checkAuthen':
        checkAuthen();
        break;

    default:
        die('Hành động không hợp lệ.');
}
?>