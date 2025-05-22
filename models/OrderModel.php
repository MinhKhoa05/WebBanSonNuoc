<?php
require_once __DIR__ . '/BaseModel.php';

class OrderModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct('orders', 'id');
    }

    /**
     * Đếm tổng số đơn hàng
     */
    public function count(): int
    {
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE is_deleted = 0";
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
                WHERE o.is_deleted = 0
                ORDER BY o.created_at DESC 
                LIMIT ?";
        return pdo_query($sql, $limit);
    }

    /**
     * Lấy tổng số đơn hàng
     */
    public function getTotalOrders(): int
    {
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE is_deleted = 0";
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
                WHERE status = 'completed' AND is_deleted = 0
                GROUP BY DATE_FORMAT(created_at, '%Y-%m')
                ORDER BY month DESC
                LIMIT 12";
        return pdo_query($sql);
    }
} 