<?php
require_once 'BaseModel.php';

class OrderModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct('orders');
    }

    /**
     * Lấy đơn hàng theo người dùng
     */
    public function get_by_user(int $user_id): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = ? AND is_deleted = 0 ORDER BY order_date DESC";
        return pdo_query($sql, $user_id);
    }

    /**
     * Lấy đơn theo trạng thái (pending, delivering, completed)
     */
    public function get_by_status(string $status): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE status = ? AND is_deleted = 0 ORDER BY order_date DESC";
        return pdo_query($sql, $status);
    }

    /**
     * Cập nhật trạng thái đơn hàng
     */
    public function update_status(int $id, string $status): bool
    {
        $sql = "UPDATE {$this->table} SET status = ? WHERE {$this->primaryKey} = ?";
        return pdo_execute($sql, $status, $id);
    }

    /**
     * Tìm kiếm đơn hàng theo cột (user_id, order_date, status)
     */
    public function search(string $column, string $keyword): array
    {
        $valid_columns = ['user_id', 'order_date', 'status'];
        if (!in_array($column, $valid_columns)) {
            throw new Exception("Cột tìm kiếm không hợp lệ.");
        }

        $sql = "SELECT * FROM {$this->table} WHERE $column LIKE ? AND is_deleted = 0";
        return pdo_query($sql, '%' . $keyword . '%');
    }

    /**
     * Thống kê tổng số đơn
     */
    public function count_all(): int
    {
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE is_deleted = 0";
        return pdo_query_value($sql);
    }

    /**
     * Tổng doanh thu đã hoàn tất
     */
    public function get_revenue(): float
    {
        $sql = "SELECT SUM(total) FROM {$this->table} WHERE status = 'completed' AND is_deleted = 0";
        return (float) pdo_query_value($sql);
    }
}