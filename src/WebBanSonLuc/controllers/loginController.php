<?php
require_once __DIR__ . '/../models/user.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        die('Vui lòng điền đầy đủ thông tin.');
    }

    if (user_login($email, $password)){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header('Location: ../index.php');
        exit;
    } else {
        die('Email hoặc mật khẩu không đúng');
    }
}
?>
