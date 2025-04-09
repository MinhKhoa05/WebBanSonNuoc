<?php
require_once '../models/Order.php';
require_once 'BaseDAO.php';

class OrderDAO extends BaseDAO
{
    protected string $table = 'orders';

    public function insert($model)
    {
        $sql = "INSERT INTO {$this->table} (user_id, order_date, total, status)
                VALUES (?, ?, ?, ?)";
        pdo_execute($sql, 
            $model->user_id, 
            $model->order_date, 
            $model->total, 
            $model->status
        );
    }

    public function update($id, $model)
    {
        $sql = "UPDATE {$this->table} SET
                    user_id = ?, 
                    order_date = ?, 
                    total = ?, 
                    status = ?
                WHERE id = ?";
        pdo_execute($sql,
            $model->user_id,
            $model->order_date,
            $model->total,
            $model->status,
            $id
        );
    }

    public function get_by_user_id($userId): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = ?";
        return pdo_query($sql, $userId);
    }

    public function get_by_id($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        return pdo_query_one($sql, $id);
    }

    public function update_status($id, $status)
    {
        $sql = "UPDATE {$this->table} SET status = ? WHERE id = ?";
        pdo_execute($sql, $status, $id);
    }
}
?>
