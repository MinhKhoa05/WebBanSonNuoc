<?php
require_once '../models/Promotion.php';
require_once 'BaseDAO.php';

class PromotionDAO extends BaseDAO
{
    protected string $table = 'promotions';

    public function insert($model)
    {
        $sql = "INSERT INTO {$this->table}
            (product_id, discount_type_id, value, start_date, end_date, created_at)
            VALUES (?, ?, ?, ?, ?, ?)";

        pdo_execute($sql,
            $model->product_id,
            $model->discount_type_id,
            $model->value,
            $model->start_date,
            $model->end_date,
            $model->created_at
        );
    }

    public function update($id, $model)
    {
        $sql = "UPDATE {$this->table} SET
            product_id = ?,
            discount_type_id = ?,
            value = ?,
            start_date = ?,
            end_date = ?,
            created_at = ?
            WHERE id = ?";

        pdo_execute($sql,
            $model->product_id,
            $model->discount_type_id,
            $model->value,
            $model->start_date,
            $model->end_date,
            $model->created_at,
            $id
        );
    }

    public function get_active_promotions()
    {
        $sql = "SELECT * FROM {$this->table} WHERE CURDATE() BETWEEN start_date AND end_date";
        return pdo_query($sql);
    }

    public function get_promotions_by_product($productId)
    {
        $sql = "SELECT * FROM {$this->table} WHERE product_id = ?";
        return pdo_query($sql, $productId);
    }
}
?>
