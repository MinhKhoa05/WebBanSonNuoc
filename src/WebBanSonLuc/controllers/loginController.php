<?php
require_once __DIR__ . '/../models/pdo.php'; // Kết nối cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Kiểm tra dữ liệu đầu vào
    if (empty($email) || empty($password)) {
        die('Vui lòng điền đầy đủ thông tin.');
    }

    // Kiểm tra email và mật khẩu
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Lưu thông tin người dùng vào session
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        // Chuyển hướng đến trang chủ
        header('Location: ../index.php');
        exit;
    } else {
        die('Email hoặc mật khẩu không đúng.');
    }
}
?>