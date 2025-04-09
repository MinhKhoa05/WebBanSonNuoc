<?php
require_once '../models/Payment.php';
require_once 'BaseDAO.php';

class PaymentDAO extends BaseDAO
{
    protected string $table = 'payments';

    public function insert($model)
    {
        $sql = "INSERT INTO {$this->table} (order_id, method, status, created_at)
                VALUES (?, ?, ?, ?)";
        pdo_execute($sql,
            $model->order_id,
            $model->method,
            $model->status,
            $model->created_at
        );
    }

    public function update($id, $model)
    {
        $sql = "UPDATE {$this->table} SET
                    order_id = ?, 
                    method = ?, 
                    status = ?, 
                    created_at = ?
                WHERE id = ?";
        pdo_execute($sql,
            $model->order_id,
            $model->method,
            $model->status,
            $model->created_at,
            $id
        );
    }

    public function get_by_order_id($orderId)
    {
        $sql = "SELECT * FROM {$this->table} WHERE order_id = ?";
        return pdo_query_one($sql, $orderId);
    }

    public function update_status($id, $status)
    {
        $sql = "UPDATE {$this->table} SET status = ? WHERE id = ?";
        pdo_execute($sql, $status, $id);
    }
}
?>
