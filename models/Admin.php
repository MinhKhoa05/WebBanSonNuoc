<?php
class Admin {
    private $db;

    public function __construct() {
        require_once 'Database.php';
        $this->db = new Database();
    }

    public function login($username, $password) {
        $query = "SELECT * FROM admins WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $admin = $result->fetch_assoc();
            if (password_verify($password, $admin['password'])) {
                return $admin;
            }
        }
        return false;
    }
} 