<?php
require_once 'pdo.php';

function user_insert($name, $email, $password, $phone, $role)
{
    // Mã hóa mật khẩu người dùng trước khi lưu vào cơ sở dữ liệu
    $password = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (name, email, password, phone, role)
            VALUES (?, ?, ?, ?, ?)";
    pdo_execute($sql, $name, $email, $password, $phone, $role);
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
    $count = pdo_query_value($sql, $email);
    return $count > 0;
}

function user_get_by_id($user_id) {
    $sql = "SELECT * FROM users WHERE id = ?";
    return pdo_query_one($sql, $user_id);
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

function user_update_profile($id, $name, $phone, $address) {
    $sql = "UPDATE users SET name = ?, phone = ?, address = ? WHERE id = ?";
    pdo_execute($sql, $name, $phone, $address, $id);
}

class User {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function getAdminByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = ? AND role = 'admin' LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function createAdmin($data) {
        $sql = "INSERT INTO users (fullname, email, password, role, created_at) 
                VALUES (?, ?, ?, 'admin', NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['fullname'],
            $data['email'],
            password_hash($data['password'], PASSWORD_DEFAULT)
        ]);
    }
    
    public function updateAdmin($id, $data) {
        $sql = "UPDATE users SET 
                fullname = ?,
                email = ?,
                updated_at = NOW()
                WHERE id = ? AND role = 'admin'";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['fullname'],
            $data['email'],
            $id
        ]);
    }
    
    public function changePassword($id, $newPassword) {
        $sql = "UPDATE users SET 
                password = ?,
                updated_at = NOW()
                WHERE id = ? AND role = 'admin'";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            password_hash($newPassword, PASSWORD_DEFAULT),
            $id
        ]);
    }
    
    public function getAllAdmins() {
        $sql = "SELECT * FROM users WHERE role = 'admin' ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getAdminById($id) {
        $sql = "SELECT * FROM users WHERE id = ? AND role = 'admin' LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function deleteAdmin($id) {
        $sql = "DELETE FROM users WHERE id = ? AND role = 'admin'";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
