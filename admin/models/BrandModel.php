<?php
require_once 'BaseModel.php';

class BrandModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct('brands', 'id');
    }

    /**
<<<<<<<< HEAD:admin/models/CategoryModel.php
     * Lấy toàn bộ danh mục chưa bị xóa mềm
========
     * Lấy toàn bộ thương hiệu
>>>>>>>> b30f36e29d0c93dedb11056b0b4ba4ba4c2e2c8e:admin/models/BrandModel.php
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
     * Lấy 1 thương hiệu theo ID
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
     * Tìm thương hiệu theo tên (LIKE %keyword%)
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
     * Chuyển đổi trạng thái featured cho thương hiệu
     */
    public function toggle_featured(int $id, bool $is_featured): bool
    {
        $sql = "UPDATE {$this->table} SET is_featured = ? WHERE id = ?";
        return pdo_execute($sql, $is_featured, $id);
    }

    /**
     * Đếm số sản phẩm của thương hiệu
     */
    public function count_products(int $id): int
    {
<<<<<<<< HEAD:admin/models/CategoryModel.php
        $sql = "SELECT COUNT(*) FROM products WHERE category_id = ? AND is_deleted = 0";
========
        $sql = "SELECT COUNT(*) FROM products WHERE brand_id = ?";
>>>>>>>> b30f36e29d0c93dedb11056b0b4ba4ba4c2e2c8e:admin/models/BrandModel.php
        return pdo_query_value($sql, $id);
    }
}