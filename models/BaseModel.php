<?php
require_once __DIR__ . '/../config/database.php';

class BaseModel
{
    protected $table;
    protected $primaryKey;
    protected $db;

    public function __construct($table, $primaryKey = 'id')
    {
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Thực hiện truy vấn SQL và trả về tất cả kết quả
     */
    protected function pdo_query($sql, ...$params)
    {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Query error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Thực hiện truy vấn SQL và trả về một giá trị
     */
    protected function pdo_query_value($sql, ...$params)
    {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            error_log("Query error: " . $e->getMessage());
            return 0;
        }
    }

    /**
     * Thực hiện truy vấn SQL và trả về một bản ghi
     */
    protected function pdo_query_one($sql, ...$params)
    {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Query error: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Thực hiện truy vấn SQL không trả về kết quả (INSERT, UPDATE, DELETE)
     */
    protected function pdo_execute($sql, ...$params)
    {
        try {
            $stmt = $this->db->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("Execute error: " . $e->getMessage());
            return false;
        }
    }
} 