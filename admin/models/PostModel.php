<?php
require_once 'BaseModel.php';

class PostModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct('posts', 'id');
    }

    /**
     * Tìm bài viết theo tiêu đề (LIKE %keyword%)
     */
    public function search_by_title(string $keyword): array
    {
        $sql = "
            SELECT * 
            FROM {$this->table} 
            WHERE title LIKE ?
        ";
        return pdo_query($sql, "%$keyword%");
    }

    /**
     * Lọc bài viết theo nhiều điều kiện + sắp xếp + phân trang
     */
    public function filter(array $filters = [], string $sort = 'newest', int $startIndex = 0, int $limit = 20): array
    {
        $sql = "
            SELECT *
            FROM {$this->table}
            WHERE is_deleted = 0
        ";

        $params = [];

        // Điều kiện lọc
        if (!empty($filters['category']) && $filters['category'] !== 'all') {
            $sql .= " AND category = ?";
            $params[] = $filters['category'];
        }

        if (!empty($filters['status']) && $filters['status'] !== 'all') {
            $sql .= " AND status = ?";
            $params[] = $filters['status'];
        }

        // Sắp xếp
        $orderMap = [
            'newest' => 'created_at DESC',
            'oldest' => 'created_at ASC',
            'title_asc' => 'title ASC',
            'title_desc' => 'title DESC',
        ];
        $sql .= " ORDER BY " . ($orderMap[$sort] ?? 'created_at DESC');

        // Phân trang
        $sql .= " LIMIT ?, ?";
        $params[] = $startIndex;
        $params[] = $limit;

        return pdo_query($sql, ...$params);
    }

    /**
     * Đếm tổng số bài viết theo bộ lọc
     */
    public function count(array $filters = []): int
    {
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE is_deleted = 0";
        $params = [];

        if (!empty($filters['category']) && $filters['category'] !== 'all') {
            $sql .= " AND category = ?";
            $params[] = $filters['category'];
        }

        if (!empty($filters['status']) && $filters['status'] !== 'all') {
            $sql .= " AND status = ?";
            $params[] = $filters['status'];
        }

        return pdo_query_value($sql, ...$params);
    }

    /**
     * Thay đổi trạng thái bài viết
     */
    public function change_status(int $id, string $status): bool
    {
        $sql = "UPDATE {$this->table} SET status = ? WHERE id = ?";
        return pdo_execute($sql, $status, $id);
    }
}