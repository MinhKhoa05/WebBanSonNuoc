<?php
require_once '../models/Categories.php';
require_once 'BaseDAO.php';

class CategoryDAO extends BaseDAO
{
    protected string $table = 'categories';

    public function insert($model)
    {
        $sql = "INSERT INTO {$this->table} (name, created_at) VALUES (?, ?)";
        pdo_execute($sql, $model->name, $model->created_at);
    }

    public function update($id, $model)
    {
        $sql = "UPDATE {$this->table} SET name = ?, created_at = ? WHERE id = ?";
        pdo_execute($sql, $model->name, $model->created_at, $id);
    }

    public function get_by_name($name): ?array
    {
        $sql = "SELECT * FROM {$this->table} WHERE name = ?";
        return pdo_query_one($sql, $name);
    }

    public function exists_by_name($name): bool
    {
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE name = ?";
        return (int)pdo_query_value($sql, $name) > 0;
    }
}
?>
