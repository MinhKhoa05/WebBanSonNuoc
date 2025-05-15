<?php
require_once 'BaseModel.php';

class ProductModel extends BaseModel {
    public function __construct() {
        parent::__construct('products', 'id');
    }

    // Ghi đè lấy tất cả sản phẩm kèm tên category
    public function getAll(): array {
        $sql = "SELECT p.*, c.name AS category_name
                FROM products p
                JOIN categories c ON p.category_id = c.id
                ORDER BY p.id ASC";
        return pdo_query($sql);
    }

    // Lấy sản phẩm theo id kèm category name
    public function getById(int $id): ?array {
        $sql = "SELECT p.*, c.name AS category_name
                FROM products p
                JOIN categories c ON p.category_id = c.id
                WHERE p.id = ? AND p.is_deleted = 0";
        return pdo_query_one($sql, $id);
    }

    // Tìm kiếm sản phẩm theo tên
    public function searchByName(string $keyword): array {
        $sql = "SELECT * FROM products WHERE name LIKE ? AND is_deleted = 0";
        return pdo_query($sql, "%$keyword%");
    }

    // Lọc sản phẩm theo các điều kiện, trả về danh sách
    public function filter(array $filters = [], string $sort = 'id_desc', int $startIndex = 0, int $limit = 20): array {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.is_deleted = 0";
        $params = [];

        if (isset($filters['category_id']) && $filters['category_id'] !== 'all') {
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

        switch ($sort) {
            case 'price_asc':
                $sql .= " ORDER BY p.price ASC";
                break;
            case 'price_desc':
                $sql .= " ORDER BY p.price DESC";
                break;
            case 'newest':
                $sql .= " ORDER BY p.created_at DESC";
                break;
            default:
                $sql .= " ORDER BY p.id DESC";
        }

        $sql .= " LIMIT ?, ?";
        $params[] = $startIndex;
        $params[] = $limit;

        return pdo_query($sql, ...$params);
    }

    // Đếm tổng số sản phẩm (filter theo category, trạng thái...)
    public function count(array $filters = []): int {
        $sql = "SELECT COUNT(*) FROM products WHERE is_deleted = 0";
        $params = [];

        if (isset($filters['category_id']) && $filters['category_id'] !== 'all') {
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