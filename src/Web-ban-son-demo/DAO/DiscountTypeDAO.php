<?php
require_once '../models/DiscountType.php';
require_once 'BaseDAO.php';

class DiscountTypeDAO extends BaseDAO
{
    protected string $table = 'discount_types';

    public function insert($model)
    {
        $sql = "INSERT INTO {$this->table} (name, description) VALUES (?, ?)";
        pdo_execute($sql, $model->name, $model->description);
    }

    public function update($id, $model)
    {
        $sql = "UPDATE {$this->table} SET name = ?, description = ? WHERE id = ?";
        pdo_execute($sql, $model->name, $model->description, $id);
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
