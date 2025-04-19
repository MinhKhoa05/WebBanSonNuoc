<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Chỉ khởi tạo session nếu chưa được khởi tạo
}

if (!isset($_SESSION['user_id'])) {
    header("Location: ?page=login");
    exit();
}