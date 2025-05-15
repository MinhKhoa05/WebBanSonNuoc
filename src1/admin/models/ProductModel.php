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
            SELECT p.*, c.name AS category_name
            FROM products p
            JOIN categories c ON p.category_id = c.id
            ORDER BY p.id ASC
        ";
        return pdo_query($sql);
    }

    /**
     * Lấy 1 sản phẩm theo ID, kèm tên danh mục
     */
    public function get_by_id(int $id): ?array
    {
        $sql = "
            SELECT p.*, c.name AS category_name
            FROM products p
            JOIN categories c ON p.category_id = c.id
            WHERE p.id = ? AND p.is_deleted = 0
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
            FROM products 
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
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.id
            WHERE p.is_deleted = 0
        ";
        $params = [];

        // Điều kiện lọc
        if (!empty($filters['category_id']) && $filters['category_id'] !== 'all') {
            $sql .= " AND p.category_id = ?";
            $params[] = $filters['category_id'];
        }

        if (isset($filters['status'])) {
            $sql .= " AND p.status = ?";
            $params[] = $filters['status'];
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
     * Đếm tổng số sản phẩm theo bộ lọc
     */
    public function count(array $filters = []): int
    {
        $sql = "SELECT COUNT(*) FROM products WHERE is_deleted = 0";
        $params = [];

        if (!empty($filters['category_id']) && $filters['category_id'] !== 'all') {
            $sql .= " AND category_id = ?";
            $params[] = $filters['category_id'];
        }

        if (isset($filters['status'])) {
            $sql .= " AND status = ?";
            $params[] = $filters['status'];
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
}
