<?php
class Database
{
    private static $instance = null;
    private $conn;
    private $host = 'localhost';
    private $db_name = 'web_ban_son_nuoc';
    private $username = 'root';
    private $password = '';

    private function __construct()
    {
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }

    private function __clone() {}

    public function __wakeup()
    {
        throw new Exception("Cannot unserialize singleton");
    }
} 