<?php
require_once '../models/Review.php';
require_once 'BaseDAO.php';

class ReviewDAO extends BaseDAO
{
    protected string $table = 'reviews';

    public function insert($model)
    {
        $sql = "INSERT INTO {$this->table}
            (user_id, product_id, rating, comment, created_at)
            VALUES (?, ?, ?, ?, ?)";

        pdo_execute($sql,
            $model->user_id,
            $model->product_id,
            $model->rating,
            $model->comment,
            $model->created_at
        );
    }

    public function update($id, $model)
    {
        $sql = "UPDATE {$this->table} SET
            user_id = ?,
            product_id = ?,
            rating = ?,
            comment = ?,
            created_at = ?
            WHERE id = ?";

        pdo_execute($sql,
            $model->user_id,
            $model->product_id,
            $model->rating,
            $model->comment,
            $model->created_at,
            $id
        );
    }

    public function get_reviews_by_product($productId)
    {
        $sql = "SELECT * FROM {$this->table} WHERE product_id = ?";
        return pdo_query($sql, $productId);
    }

    public function get_average_rating($productId)
    {
        $sql = "SELECT AVG(rating) FROM {$this->table} WHERE product_id = ?";
        return pdo_query_value($sql, $productId);
    }
}
?>
