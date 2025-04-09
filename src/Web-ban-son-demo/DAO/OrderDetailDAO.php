<?php
require_once '../models/OrderDetail.php';
require_once 'BaseDAO.php';

class OrderDetailDAO extends BaseDAO
{
    protected string $table = 'order_details';

    public function insert($model)
    {
        $sql = "INSERT INTO {$this->table} (order_id, product_id, quantity, subtotal)
                VALUES (?, ?, ?, ?)";
        pdo_execute($sql, 
            $model->order_id, 
            $model->product_id, 
            $model->quantity, 
            $model->subtotal
        );
    }

    public function update($id, $model)
    {
        $sql = "UPDATE {$this->table} SET
                    order_id = ?, 
                    product_id = ?, 
                    quantity = ?, 
                    subtotal = ?
                WHERE id = ?";
        pdo_execute($sql,
            $model->order_id,
            $model->product_id,
            $model->quantity,
            $model->subtotal,
            $id
        );
    }

    public function get_by_order_id($orderId): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE order_id = ?";
        return pdo_query($sql, $orderId);
    }

    public function delete_by_order_id($orderId)
    {
        $sql = "DELETE FROM {$this->table} WHERE order_id = ?";
        pdo_execute($sql, $orderId);
    }
}
?>
