<?php
require_once __DIR__ . '/../Models/users.php';

class UserDAO {
    private $connection;

    public function __construct($database)
    {
        $this->connection = $database->getConnection();
    }
    // Đăng ký tài khoản
    public function registerUser($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $statement = $this->connection->prepare($query);
        return $statement->execute([
            'name' => $username,
            'email' => $email,
            'password' => $hashedPassword
        ]);
    }

    // kiểm tra trước xem email đã tồn tại chưa trước khi insert, tránh trùng email
    public function isEmailExists($email) {
        $query = "SELECT COUNT(*) FROM users WHERE email = :email";
        $statement = $this->connection->prepare($query);
        $statement->execute(['email' => $email]);
        return $statement->fetchColumn() > 0;
    }
    
    
    public function getUserByEmail($email) {
        $query = "SELECT * FROM users WHERE email = :email";
        $statement = $this->connection->prepare($query);
        $statement->execute(['email' => $email]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new User(
                $row['id'], 
                $row['name'], 
                $row['password'], 
                $row['email'], 
                $row['phone'], 
                $row['address'], 
                $row['role'], 
                $row['is_delete'], 
                $row['created_at'], 
                $row['update_at']
            );
        }
        return null;
    }

    public function loginUser($email, $password) {
        $user = $this->getUserByEmail($email);
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return null;
    }
}

?>