<?php
require_once 'BaseModel.php';

class CategoryModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct('categories', 'id');
    }

    /**
     * Lấy toàn bộ danh mục chưa bị xóa mềm
     */
    public function get_all(): array
    {
        $sql = "
            SELECT *
            FROM {$this->table}
            ORDER BY id ASC
        ";
        return pdo_query($sql);
    }

    /**
     * Lấy 1 danh mục theo ID
     */
    public function get_by_id(int $id): ?array
    {
        $sql = "
            SELECT *
            FROM {$this->table}
            WHERE id = ?
        ";
        return pdo_query_one($sql, $id);
    }

    /**
     * Tìm danh mục theo tên (LIKE %keyword%)
     */
    public function search_by_name(string $keyword): array
    {
        $sql = "
            SELECT * 
            FROM {$this->table} 
            WHERE name LIKE ?
        ";
        return pdo_query($sql, "%$keyword%");
    }

    /**
     * Chuyển đổi trạng thái danh mục
     */
    public function toggle_status(int $id, bool $status): bool
    {
        $sql = "UPDATE {$this->table} SET status = ? WHERE id = ?";
        return pdo_execute($sql, $status, $id);
    }

    /**
     * Đếm số sản phẩm trong danh mục
     */
    public function count_products(int $id): int
    {
        $sql = "SELECT COUNT(*) FROM products WHERE category_id = ? AND is_deleted = 0";
        return pdo_query_value($sql, $id);
    }
}