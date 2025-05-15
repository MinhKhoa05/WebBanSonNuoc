<?php
require_once 'pdo.php';

class BaseModel {
    protected $table;
    protected $primaryKey = 'id';

    public function __construct($table, $primaryKey = 'id') {
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }

    // Lấy hết dữ liệu chưa xoá
    public function get_all() {
        // $sql = "SELECT * FROM {$this->table} WHERE is_deleted = 0";
        $sql = "SELECT * FROM {$this->table}";
        return pdo_query($sql);
    }

    // Lấy 1 bản ghi theo id chưa xoá
    public function get_by_id($id) {
        $sql = "SELECT * FROM {$this->table} WHERE is_deleted = 0 AND {$this->primaryKey} = ?";
        return pdo_query_one($sql, $id);
    }

    // Thêm dữ liệu, truyền vào mảng [cột => giá trị]
    public function insert($data) {
        $cols = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $values = array_values($data);

        $sql = "INSERT INTO {$this->table} ($cols) VALUES ($placeholders)";
        return pdo_execute($sql, ...$values);
    }

    // Cập nhật theo id, dữ liệu cũng mảng [cột => giá trị]
    public function update($id, $data) {
        $fields = [];
        $values = [];
        foreach ($data as $col => $val) {
            $fields[] = "$col = ?";
            $values[] = $val;
        }
        $values[] = $id; // id ở cuối cho WHERE

        $sql = "UPDATE {$this->table} SET " . implode(', ', $fields) . " WHERE {$this->primaryKey} = ?";
        return pdo_execute($sql, ...$values);
    }

    // Xóa mềm: đánh dấu is_deleted = 1
    public function soft_delete($id) {
        $sql = "UPDATE {$this->table} SET is_deleted = 1 WHERE {$this->primaryKey} = ?";
        pdo_execute($sql, $id);
    }

    // Xóa cứng khỏi database
    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?";
        return pdo_execute($sql, $id);
    }
}