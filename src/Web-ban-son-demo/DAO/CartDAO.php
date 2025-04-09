<?php
require_once '../models/Cart.php';
require_once 'BaseDAO.php';

class CartDAO extends BaseDAO
{
    protected string $table = 'carts';

    public function insert($model)
    {
        $sql = "INSERT INTO {$this->table} 
            (user_id, product_id, quantity, added_at)
            VALUES (?, ?, ?, ?)";
        
        pdo_execute($sql,
            $model->user_id,
            $model->product_id,
            $model->quantity,
            $model->added_at
        );
    }

    public function update($id, $model)
    {
        $sql = "UPDATE {$this->table} SET 
            user_id = ?, 
            product_id = ?, 
            quantity = ?, 
            added_at = ?
            WHERE id = ?";
        
        pdo_execute($sql,
            $model->user_id,
            $model->product_id,
            $model->quantity,
            $model->added_at,
            $id
        );
    }

    public function get_by_user($user_id): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = ?";
        return pdo_query($sql, $user_id);
    }

    public function get_by_user_and_product($user_id, $product_id): ?array
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = ? AND product_id = ?";
        return pdo_query_one($sql, $user_id, $product_id);
    }

    public function delete_by_user($user_id): void
    {
        $sql = "DELETE FROM {$this->table} WHERE user_id = ?";
        pdo_execute($sql, $user_id);
    }
}
?>
