<?php
require_once 'BaseModel.php';

class CategoryModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct('categories', 'id');
    }

    /**
     * Lấy tất cả danh mục không bị xóa
     */
    public function get_all(): array
    {
        $sql = "
            SELECT * 
            FROM {$this->table}
            WHERE is_deleted = 0
            ORDER BY id ASC
        ";
        return pdo_query($sql);
    }

    /**
     * Lấy tất cả danh mục đang hoạt động (status = 1) và không bị xóa
     */
    public function get_active(): array
    {
        $sql = "
            SELECT * 
            FROM {$this->table}
            WHERE is_deleted = 0 AND status = 1
            ORDER BY position ASC, name ASC
        ";
        return pdo_query($sql);
    }

    /**
     * Lấy danh mục theo ID
     */
    public function get_by_id(int $id): ?array
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        return pdo_query_one($sql, $id);
    }

    /**
     * Thêm danh mục mới
     */
    // public function insert(array $data): int
    // {
    //     return $this->create($data);
    // }

    // /**
    //  * Cập nhật danh mục
    //  */
    // public function update(int $id, array $data): bool
    // {
    //     return $this->edit($id, $data);
    // }

    /**
     * Xóa mềm danh mục
     */
    public function soft_delete(int $id): bool
    {
        $sql = "UPDATE {$this->table} SET is_deleted = 1 WHERE id = ?";
        return pdo_execute($sql, $id);
    }

    /**
     * Đếm số lượng sản phẩm trong danh mục
     */
    public function count_products(int $category_id): int
    {
        $sql = "
            SELECT COUNT(*) 
            FROM products 
            WHERE category_id = ? AND is_deleted = 0
        ";
        return pdo_query_value($sql, $category_id);
    }

    /**
     * Cập nhật trạng thái hiển thị của danh mục
     */
    public function toggle_status(int $id, bool $status): bool
    {
        $sql = "UPDATE {$this->table} SET status = ? WHERE id = ?";
        return pdo_execute($sql, $status, $id);
    }

    /**
     * Tìm kiếm danh mục theo tên
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
     * Lấy danh mục có sản phẩm (để hiển thị trên menu)
     */
    public function get_active_with_products(): array
    {
        $sql = "
            SELECT c.*, COUNT(p.id) as product_count
            FROM {$this->table} c
            LEFT JOIN products p ON c.id = p.category_id AND p.is_deleted = 0
            WHERE c.is_deleted = 0 AND c.status = 1
            GROUP BY c.id
            HAVING product_count > 0
            ORDER BY c.position ASC, c.name ASC
        ";
        return pdo_query($sql);
    }

    /**
     * Cập nhật vị trí sắp xếp danh mục
     */
    public function update_position(int $id, int $position): bool
    {
        $sql = "UPDATE {$this->table} SET position = ? WHERE id = ?";
        return pdo_execute($sql, $position, $id);
    }

    /**
     * Đếm tổng số danh mục
     */
    public function count(): int
    {
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE is_deleted = 0";
        return pdo_query_value($sql);
    }
}