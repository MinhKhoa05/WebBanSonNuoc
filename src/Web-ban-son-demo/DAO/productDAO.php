<?php
require_once '../models/products.php';
require_once 'BaseDAO.php';

class ProductDAO extends BaseDAO
{
    protected string $table = 'products';

    public function insert($model)
    {
        $sql = "INSERT INTO {$this->table} 
            (name, description, price, discount, stock, status, category_id, thumbnail, is_deleted)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        pdo_execute(
            $sql,
            $model->name,
            $model->description,
            $model->price,
            $model->discount,
            $model->stock,
            $model->status,
            $model->category_id,
            $model->thumbnail,
            $model->is_deleted
        );
    }

    public function update($id, $model)
    {
        $sql = "UPDATE {$this->table} SET
            name = ?, 
            description = ?, 
            price = ?, 
            discount = ?, 
            stock = ?, 
            status = ?, 
            category_id = ?, 
            thumbnail = ?, 
            is_deleted = ?
            WHERE id = ?";

        pdo_execute(
            $sql,
            $model->name,
            $model->description,
            $model->price,
            $model->discount,
            $model->stock,
            $model->status,
            $model->category_id,
            $model->thumbnail,
            $model->is_deleted,
            $id
        );
    }

    public function select_by_category_id($categoryId)
    {
        $query = "SELECT * FROM {$this->table} WHERE category_id = ?";
        return pdo_query($query, $categoryId);
    }

    public function select_best_selling_products($limit = 8)
    {
        $limit = (int) $limit; // Ép kiểu để đảm bảo an toàn
        $query = "SELECT * FROM best_selling_products LIMIT $limit";
        return pdo_query($query);
    }
}
?>