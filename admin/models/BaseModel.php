<?php
require_once 'pdo.php';

class BaseModel {
    protected string $table;
    protected string $primaryKey;

    public function __construct(string $table, string $primaryKey = 'id') {
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }

    /**
     * Lấy tất cả bản ghi (chưa bị xóa mềm)
     */
    public function get_all(): array {
        $sql = "SELECT * FROM {$this->table} ORDER BY {$this->primaryKey} ASC";
        return pdo_query($sql);
    }

    /**
     * Lấy một bản ghi theo ID (chưa bị xóa mềm)
     */
    public function get_by_id(int $id): ?array {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?";
        return pdo_query_one($sql, $id);
    }

    /**
     * Thêm mới bản ghi
     */
    public function insert(array $data): bool {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $values = array_values($data);

        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        return pdo_execute($sql, ...$values);
    }

    /**
     * Cập nhật bản ghi theo ID
     */
    public function update(int $id, array $data): bool {
        $fields = [];
        $values = [];

        foreach ($data as $key => $value) {
            $fields[] = "$key = ?";
            $values[] = $value;
        }

        $values[] = $id; // ID phải được thêm vào cuối cùng

        $sql = "UPDATE {$this->table} SET " . implode(', ', $fields) . " WHERE {$this->primaryKey} = ?";
        return pdo_execute($sql, ...$values);
    }

    /**
     * Xóa mềm (đánh dấu is_deleted = 1)
     */
    public function soft_delete(int $id): bool {
        $sql = "UPDATE {$this->table} SET is_deleted = 1 WHERE {$this->primaryKey} = ?";
        return pdo_execute($sql, $id);
    }

    /**
     * Xóa cứng khỏi database
     */
    public function delete(int $id): bool {
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?";
        return pdo_execute($sql, $id);
    }
    
    /**
     * Khôi phục (đánh dấu is_deleted = 0)
     */
    public function restore(int $id): bool {
        $sql = "UPDATE {$this->table} SET is_deleted = 0 WHERE {$this->primaryKey} = ?";
        return pdo_execute($sql, $id);
    }
}
