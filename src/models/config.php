<?php
function config_connect()
{
    $host = 'localhost';
    $dbname = 'bansonnuoc';
    $username = 'root';
    $password = '';
    
    try {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die('Lỗi kết nối cơ sở dữ liệu: ' . $e->getMessage());
    }
}
?>
