<?php
session_start();
require_once __DIR__ . '/../models/user.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        die('Vui lòng nhập đầy đủ email và mật khẩu.');
    }

    // Gọi hàm kiểm tra tài khoản
    $user = user_login($email, $password);

    if ($user) {
        // Lưu thông tin vào session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        header('Location: ../index.php');
        exit;
    } else {
        die('Email hoặc mật khẩu không đúng.');
    }
}
?>