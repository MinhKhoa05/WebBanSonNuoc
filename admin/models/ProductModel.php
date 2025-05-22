<?php
require_once 'BaseModel.php';

class ProductModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct('products', 'id');
    }

    /**
     * Lấy toàn bộ sản phẩm kèm tên danh mục
     */
    public function get_all(): array
    {
        $sql = "
            SELECT p.*, c.name AS category_name, b.name AS brand_name
            FROM {$this->table} p
            JOIN categories c ON p.category_id = c.id
            LEFT JOIN brands b ON p.brand_id = b.id
            WHERE is_deleted = 0
            ORDER BY p.id ASC
        ";
        return pdo_query($sql);
    }

     /**
     * Lấy toàn bộ sản phẩm kèm tên danh mục
     */
    public function get_by_category($category_id): array
    {
        $sql = "
            SELECT p.*, c.name AS category_name, b.name AS brand_name
            FROM {$this->table} p
            JOIN categories c ON p.category_id = c.id
            LEFT JOIN brands b ON p.brand_id = b.id
            WHERE is_deleted = 0 AND category_id = ?
            ORDER BY p.id ASC
        ";
        return pdo_query($sql, $category_id);
    }

    /**
     * Lấy 1 sản phẩm theo ID, kèm tên danh mục
     */
    public function get_by_id(int $id): ?array
    {
        $sql = "
            SELECT p.*, c.name AS category_name
            FROM {$this->table} p
            JOIN categories c ON p.category_id = c.id
            WHERE p.id = ?
        ";
        return pdo_query_one($sql, $id);
    }

    /**
     * Tìm sản phẩm theo tên (LIKE %keyword%)
     */
    public function search_by_name(string $keyword): array
    {
        $sql = "
            SELECT * 
            FROM {$this->table} 
            WHERE name LIKE ? AND is_deleted = 0
        ";
        return pdo_query($sql, "%$keyword%");
    }

    /**
     * Lọc sản phẩm theo nhiều điều kiện + sắp xếp + phân trang
     */
    public function filter(array $filters = [], string $sort = 'id_desc', int $startIndex = 0, int $limit = 20): array
    {
        $sql = "
            SELECT p.*, c.name AS category_name 
            FROM {$this->table} p
            LEFT JOIN categories c ON p.category_id = c.id
        ";
        $params = [];

        // Điều kiện lọc
        if (!empty($filters['category_id']) && $filters['category_id'] !== 'all') {
            $sql .= " AND p.category_id = ?";
            $params[] = $filters['category_id'];
        }

        if (isset($filters['price_min'])) {
            $sql .= " AND p.price >= ?";
            $params[] = $filters['price_min'];
        }

        if (isset($filters['price_max'])) {
            $sql .= " AND p.price <= ?";
            $params[] = $filters['price_max'];
        }

        // Sắp xếp
        $orderMap = [
            'price_asc' => 'p.price ASC',
            'price_desc' => 'p.price DESC',
            'newest' => 'p.created_at DESC',
            'id_desc' => 'p.id DESC',
        ];
        $sql .= " ORDER BY " . ($orderMap[$sort] ?? 'p.id DESC');

        // Phân trang
        $sql .= " LIMIT ?, ?";
        $params[] = $startIndex;
        $params[] = $limit;

        return pdo_query($sql, ...$params);
    }

    /**
     * Xóa mềm (đánh dấu is_deleted = 1, bỏ khỏi danh mục sản phẩm)
     */
    public function soft_delete(int $id): bool
    {
        $sql = "UPDATE {$this->table} SET is_deleted = 1 WHERE {$this->primaryKey} = ?";
        return pdo_execute($sql, $id);
    }

    /**
     * Đếm tổng số sản phẩm theo bộ lọc
     */
    public function count(array $filters = []): int
    {
        $sql = "SELECT COUNT(*) FROM {$this->table}";
        $params = [];

        if (!empty($filters['category_id']) && $filters['category_id'] !== 'all') {
            $sql .= " AND category_id = ?";
            $params[] = $filters['category_id'];
        }

        if (isset($filters['price_min'])) {
            $sql .= " AND price >= ?";
            $params[] = $filters['price_min'];
        }

        if (isset($filters['price_max'])) {
            $sql .= " AND price <= ?";
            $params[] = $filters['price_max'];
        }

        return pdo_query_value($sql, ...$params);
    }

    public function toggle_view(int $id, bool $view): bool
    {
        $sql = "UPDATE {$this->table} SET view = ? WHERE id = ?";
        return pdo_execute($sql, $view, $id);
    }

    public function get_deleted_products(): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE is_deleted = 1";
        return pdo_query($sql);
    }

    /**
     * Lấy danh sách sản phẩm bán chạy
     */
    public function getTopSellingProducts(int $limit = 4): array
    {
        $sql = "SELECT p.*, c.name as category_name,
                COUNT(od.product_id) as total_sold,
                SUM(od.quantity * p.price) as total_revenue
                FROM products p
                LEFT JOIN order_details od ON p.id = od.product_id
                LEFT JOIN categories c ON p.category_id = c.id
                GROUP BY p.id
                ORDER BY total_sold DESC
                LIMIT " . (int)$limit;
        return pdo_query($sql);
    }

    /**
     * Lấy số lượng sản phẩm hết hàng
     */
    public function getOutOfStockCount(): int
    {
        $sql = "SELECT COUNT(*) FROM products WHERE stock = 0";
        return pdo_query_value($sql);
    }
}
