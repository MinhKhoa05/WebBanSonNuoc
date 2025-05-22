<?php
require_once __DIR__ . '/BaseModel.php';

class ProductModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct('products', 'id');
    }

    /**
     * Đếm tổng số sản phẩm
     */
    public function count(): int
    {
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE is_deleted = 0";
        return pdo_query_value($sql);
    }

    /**
     * Đếm số sản phẩm hết hàng
     */
    public function getOutOfStockCount(): int
    {
        $sql = "SELECT COUNT(*) FROM {$this->table} 
                WHERE stock = 0";
        return pdo_query_value($sql);
    }

    /**
     * Lấy danh sách sản phẩm bán chạy
     */
    public function getTopSellingProducts(int $limit = 4): array
    {
        $sql = "SELECT p.*, c.name as category_name,
                COUNT(od.id) as total_sold,
                SUM(od.quantity * od.price) as total_revenue
                FROM {$this->table} p
                LEFT JOIN order_details od ON p.id = od.product_id
                LEFT JOIN categories c ON p.category_id = c.id
                GROUP BY p.id
                ORDER BY total_sold DESC
                LIMIT ?";
        return pdo_query($sql, $limit);
    }

    /**
     * Lấy tổng số sản phẩm
     */
    public function getTotalProducts(): int
    {
        $sql = "SELECT COUNT(*) FROM {$this->table}";
        return pdo_query_value($sql);
    }

    /**
     * Lấy sản phẩm theo danh mục
     */
    public function getProductsByCategory(int $categoryId): array
    {
        $sql = "SELECT p.*, c.name as category_name
                FROM {$this->table} p
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.category_id = ?
                ORDER BY p.id DESC";
        return pdo_query($sql, $categoryId);
    }
} 