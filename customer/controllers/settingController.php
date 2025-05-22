<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../models/user.php';
require_once __DIR__ . '/../../models/address.php';

// Kiểm tra đăng nhập
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?page=login');
    exit;
}

// Xử lý cập nhật thông tin cá nhân
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'update_profile':
            $name = $_POST['name'] ?? '';
            $phone = $_POST['phone'] ?? '';
            
            if (empty($name) || empty($phone)) {
                $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin';
                header('Location: index.php?page=myprofile');
                exit;
            }
            
            if (user_update_profile($_SESSION['user_id'], $name, $phone)) {
                $_SESSION['success'] = 'Cập nhật thông tin thành công';
            } else {
                $_SESSION['error'] = 'Cập nhật thông tin thất bại';
            }
            header('Location: index.php?page=myprofile');
            exit;
            break;
            
        case 'change_password':
            $current_password = $_POST['current_password'] ?? '';
            $new_password = $_POST['new_password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';
            
            if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
                $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin';
                header('Location: index.php?page=myprofile');
                exit;
            }
            
            if ($new_password !== $confirm_password) {
                $_SESSION['error'] = 'Mật khẩu mới không khớp';
                header('Location: index.php?page=myprofile');
                exit;
            }
            
            $user = user_get_by_id($_SESSION['user_id']);
            if (!password_verify($current_password, $user['password'])) {
                $_SESSION['error'] = 'Mật khẩu hiện tại không đúng';
                header('Location: index.php?page=myprofile');
                exit;
            }
            
            if (user_update_password($_SESSION['user_id'], password_hash($new_password, PASSWORD_DEFAULT))) {
                $_SESSION['success'] = 'Đổi mật khẩu thành công';
            } else {
                $_SESSION['error'] = 'Đổi mật khẩu thất bại';
            }
            header('Location: index.php?page=myprofile');
            exit;
            break;
            
        case 'add_address':
            $fullname = $_POST['fullname'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';
            $is_default = isset($_POST['is_default']) ? 1 : 0;
            
            if (empty($fullname) || empty($phone) || empty($address)) {
                $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin';
                header('Location: index.php?page=myprofile');
                exit;
            }
            
            if (address_insert($_SESSION['user_id'], $fullname, $phone, $address, $is_default)) {
                $_SESSION['success'] = 'Thêm địa chỉ thành công';
            } else {
                $_SESSION['error'] = 'Thêm địa chỉ thất bại';
            }
            header('Location: index.php?page=myprofile');
            exit;
            break;
            
        case 'update_address':
            $id = $_POST['id'] ?? 0;
            $fullname = $_POST['fullname'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';
            $is_default = isset($_POST['is_default']) ? 1 : 0;
            
            if (empty($fullname) || empty($phone) || empty($address)) {
                $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin';
                header('Location: index.php?page=myprofile');
                exit;
            }
            
            if (address_update($id, $fullname, $phone, $address, $is_default)) {
                $_SESSION['success'] = 'Cập nhật địa chỉ thành công';
            } else {
                $_SESSION['error'] = 'Cập nhật địa chỉ thất bại';
            }
            header('Location: index.php?page=myprofile');
            exit;
            break;
            
        case 'delete_address':
            $id = $_POST['id'] ?? 0;
            
            if (address_delete($id)) {
                $_SESSION['success'] = 'Xóa địa chỉ thành công';
            } else {
                $_SESSION['error'] = 'Xóa địa chỉ thất bại';
            }
            header('Location: index.php?page=myprofile');
            exit;
            break;
            
        case 'set_default_address':
            $id = $_POST['id'] ?? 0;
            
            if (address_set_default($id)) {
                $_SESSION['success'] = 'Đặt địa chỉ mặc định thành công';
            } else {
                $_SESSION['error'] = 'Đặt địa chỉ mặc định thất bại';
            }
            header('Location: index.php?page=myprofile');
            exit;
            break;
    }
} 