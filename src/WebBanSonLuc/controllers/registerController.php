<?php
require_once __DIR__ . '/../models/db.php'; // Kết nối cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);

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
?>