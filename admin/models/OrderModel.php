<?php
require_once 'BaseModel.php';

class OrderModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct('orders', 'id');
    }

    /**
     * Lấy tất cả bản ghi
     */
    public function get_all(): array
    {
        $sql = "SELECT o.*, u.name AS user_name FROM {$this->table} o JOIN users u ON u.id = o.user_id ORDER BY order_date DESC, {$this->primaryKey} ASC";
        return pdo_query($sql);
    }

    /**
     * Lấy một bản ghi theo ID
     */
    public function get_by_id(int $id): ?array {
        $sql = "SELECT o.*, u.name AS user_name
            FROM orders o
            LEFT JOIN users u ON u.id = o.user_id
            WHERE o.id = ?";
        return pdo_query_one($sql, $id);
    }

    /**
     * Lấy đơn hàng theo người dùng
     */
    public function get_by_user(int $user_id): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = ? ORDER BY order_date DESC";
        return pdo_query($sql, $user_id);
    }

    /**
     * Lấy đơn theo trạng thái (pending, delivering, completed)
     */
    public function get_by_status(string $status): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE status = ? ORDER BY order_date DESC";
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

    public function get_order_details($order_id): array
    {
        $sql = "SELECT od.*, p.name AS product_name, p.price AS price FROM order_details od
        JOIN products p ON p.id = od.product_id
        WHERE od.order_id = ?";
        return pdo_query($sql, $order_id);
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

        $sql = "SELECT * FROM {$this->table} WHERE $column LIKE ?";
        return pdo_query($sql, '%' . $keyword . '%');
    }

    /**
     * Thống kê tổng số đơn
     */
    public function count_all(): int
    {
        $sql = "SELECT COUNT(*) FROM {$this->table}";
        return pdo_query_value($sql);
    }

    /**
     * Tổng doanh thu đã hoàn tất
     */
    public function get_revenue(): float
    {
        $sql = "SELECT SUM(total) FROM {$this->table} WHERE status = 'completed'";
        return (float) pdo_query_value($sql);
    }

    /**
     * Đếm tổng số đơn hàng
     */
    public function count(): int
    {
        $sql = "SELECT COUNT(*) FROM {$this->table}";
        return pdo_query_value($sql);
    }

    /**
     * Tính tổng doanh thu
     */
    public function getTotalRevenue(): float
    {
        $sql = "SELECT COALESCE(SUM(total_amount), 0) 
                FROM {$this->table} 
                WHERE status = 'completed'";
        return pdo_query_value($sql);
    }

    /**
     * Lấy danh sách đơn hàng gần đây
     */
    public function getRecentOrders(int $limit = 5): array
    {
        $sql = "SELECT o.*, u.name as customer_name 
                FROM {$this->table} o
                LEFT JOIN users u ON o.user_id = u.id
                ORDER BY o.order_date DESC 
                LIMIT " . (int)$limit;
        return pdo_query($sql);
    }

    /**
     * Lấy tổng số đơn hàng
     */
    public function getTotalOrders(): int
    {
        $sql = "SELECT COUNT(*) FROM {$this->table}";
        return pdo_query_value($sql);
    }

    /**
     * Lấy doanh thu theo tháng
     */
    public function getMonthlyRevenue(): array
    {
        $sql = "SELECT 
                    DATE_FORMAT(created_at, '%Y-%m') as month,
                    SUM(total_amount) as revenue
                FROM {$this->table}
                WHERE status = 'completed'
                GROUP BY DATE_FORMAT(created_at, '%Y-%m')
                ORDER BY month DESC
                LIMIT 12";
        return pdo_query($sql);
    }
}