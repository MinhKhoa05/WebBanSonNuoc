<?php
class Database {
    private $host = "localhost";
    private $database_name = "paint_mysql";
    private $username = "root";
    private $password = "";
    public $connection;

    public function getConnection() {
        $this->connection = null;
        try {
            $this->connection = new PDO("mysql:host=" . 
                                        $this->host . ";dbname=" . 
                                        $this->database_name, 
                                        $this->username, 
                                        $this->password);
                                        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            die("Database connection error: " . $exception->getMessage());
        }
        return $this->connection;
    }
}