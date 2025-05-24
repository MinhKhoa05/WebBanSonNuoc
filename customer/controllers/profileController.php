<?php
require_once __DIR__ . '/../../models/user.php';
session_start();

if (isset($_POST['save_profile'])) {
    $user_id = $_SESSION['user_id'];
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    // Hàm cập nhật thông tin user (bạn cần có trong model user.php)
    user_update_profile($user_id, $name, $phone, $address);

    header('Location: ../../index.php?page=myprofile&success=1');
    exit;
} 