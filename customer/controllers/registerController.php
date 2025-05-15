<?php
require_once __DIR__ . '/../../models/user.php'; // Include file chứa hàm user_insert
// require_once __DIR__ . '/../models/pdo.php';

// try {
//     $conn = pdo_get_connection();
//     echo 'Kết nối cơ sở dữ liệu thành công!';
// } catch (PDOException $e) {
//     die('Lỗi kết nối: ' . $e->getMessage());
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);
    $phone = trim($_POST['phone']);
    $role = 'user'; // Mặc định vai trò là "user"

    // Kiểm tra dữ liệu đầu vào
    if (empty($name) || empty($email) || empty($password) || empty($confirmPassword) || empty($phone)) {
        die('Vui lòng điền đầy đủ thông tin.');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Email không hợp lệ.');
    }

    if ($password !== $confirmPassword) {
        die('Mật khẩu xác nhận không khớp.');
    }

    // Kiểm tra email đã tồn tại
    if (user_is_email_exists($email)) {
        die('Email đã được sử dụng.');
    }

    // Thêm người dùng mới vào cơ sở dữ liệu
    user_insert($name, $email, $password, $phone, $role);

    // Chuyển hướng đến trang đăng nhập
    header('Location: ../../index.php?page=login');
    exit;
}
?>