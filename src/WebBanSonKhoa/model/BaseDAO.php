<?php

require_once 'pdo.php';

abstract class BaseDAO
{
    // Lớp con phải định nghĩa hai thuộc tính này
    protected string $table;
    protected string $id_column = 'id';

    // Trả về tất cả bản ghi (chỉ bản ghi chưa bị xóa mềm nếu có cột is_deleted)
    public function select_all(): array
    {
        $sql = "SELECT * FROM {$this->table}";

        if ($this->has_column('is_deleted')) {
            $sql .= " WHERE is_deleted = 0";
        }

        if ($this->has_column("created_at")) {
            $sql .= " ORDER BY created_at DESC";
        }

        return pdo_query($sql);
    }

    public function select_by_id($id): ?array
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->id_column} = ?";

        if ($this->has_column('is_deleted')) {
            $sql .= " AND is_deleted = 0";
        }

        return pdo_query_one($sql, $id);
    }

    // Delete giả (gán is_delete = 1) 
    public function soft_delete($id): void
    {
        if (!$this->has_column('is_deleted')) {
            throw new Exception("Table {$this->table} does not support soft delete.");
        }

        $sql = "UPDATE {$this->table} SET is_deleted = 1 WHERE {$this->id_column} = ?";
        pdo_execute($sql, $id);
    }

    public function delete($id): void
    {
        $sql = "DELETE FROM {$this->table} WHERE {$this->id_column} = ?";
        pdo_execute($sql, $id);
    }

    public function count_all(): int
    {
        $sql = "SELECT COUNT(*) FROM {$this->table}";

        if ($this->has_column('is_deleted')) {
            $sql .= " WHERE is_deleted = 0";
        }

        return (int)pdo_query_value($sql);
    }

    public function search(string $column, string $keyword): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE $column LIKE ?";

        if ($this->has_column('is_deleted')) {
            $sql .= " AND is_deleted = 0";
        }

        return pdo_query($sql, '%' . $keyword . '%');
    }

    // Kiểm tra cột tồn tại trong bảng (chạy 1 lần để hỗ trợ soft delete, không tối ưu cho hiệu suất lớn)
    protected function has_column(string $column): bool
    {
        static $columnsCache = [];

        if (!isset($columnsCache[$this->table])) {
            $sql = "SHOW COLUMNS FROM {$this->table}";
            $columns = pdo_query($sql);
            $columnsCache[$this->table] = array_column($columns, 'Field');
        }

        return in_array($column, $columnsCache[$this->table]);
    }

    // Lớp con phải triển khai
    abstract public function insert($models);
    abstract public function update($id, $models);
}
