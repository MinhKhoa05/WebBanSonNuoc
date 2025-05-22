<?php
require_once __DIR__ . '/BaseModel.php';

class UserModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct('users', 'id');
    }

    /**
     * Đếm tổng số người dùng
     */
    public function count(): int
    {
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE is_deleted = 0";
        return pdo_query_value($sql);
    }

    /**
     * Đếm số người dùng mới trong 30 ngày gần đây
     */
    public function getNewUsersCount(): int
    {
        $sql = "SELECT COUNT(*) FROM {$this->table} 
                WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)";
        return pdo_query_value($sql);
    }

    /**
     * Lấy danh sách người dùng mới nhất
     */
    public function getRecentUsers(int $limit = 5): array
    {
        $sql = "SELECT * FROM {$this->table} 
                ORDER BY created_at DESC 
                LIMIT ?";
        return pdo_query($sql, $limit);
    }

    /**
     * Lấy tổng số người dùng
     */
    public function getTotalUsers(): int
    {
        $sql = "SELECT COUNT(*) FROM {$this->table}";
        return pdo_query_value($sql);
    }

    /**
     * Lấy người dùng theo email
     */
    public function getUserByEmail(string $email): ?array
    {
        $sql = "SELECT * FROM {$this->table} WHERE email = ?";
        return pdo_query_one($sql, $email);
    }
} 