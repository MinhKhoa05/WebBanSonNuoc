<?php
require_once '../models/User.php';
require_once 'pdo.php';

function user_insert($name, $email, $password, $phone, $address, $role)
{
    // Mã hóa mật khẩu người dùng trước khi lưu vào cơ sở dữ liệu
    $password = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (name, email, password, phone, address, role)
            VALUES (?, ?, ?, ?, ?, ?)";
    pdo_execute($sql, $name, $email, $password, $phone, $address, $role);
}

function user_update($id, $name, $email, $password, $phone, $address, $role)
{
    // Mã hóa lại mật khẩu nếu người dùng thay đổi mật khẩu
    $password = password_hash($password, PASSWORD_BCRYPT);

    $sql = "UPDATE users SET name = ?, email = ?, password = ?, phone = ?, address = ?, role = ? WHERE id = ?";
    pdo_execute($sql, $name, $email, $password, $phone, $address, $role, $id);
}

function user_is_email_exists($email)
{
    $sql = "SELECT COUNT(*) FROM users WHERE email = ?";
    return (int)pdo_query_value($sql, $email) > 0;
}

function user_get_by_email($email)
{
    $sql = "SELECT * FROM users WHERE email = ?";
    $user = pdo_query_one($sql, $email);

    if ($user) {
        return $user;
    }

    return null;
}

// Đăng nhập người dùng
function user_login($email, $password)
{
    $sql = "SELECT * FROM users WHERE email = ?";
    $user = pdo_query_one($sql, $email);

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }

    return null;
}
?>
