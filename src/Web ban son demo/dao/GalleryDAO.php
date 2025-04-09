<?php
require_once '../models/Gallery.php';
require_once 'BaseDAO.php';

class GalleryDAO extends BaseDAO
{
    protected string $table = 'gallery';

    public function insert($model)
    {
        $sql = "INSERT INTO {$this->table} (product_id, thumbnail) VALUES (?, ?)";
        pdo_execute($sql, $model->product_id, $model->thumbnail);
    }

    public function update($id, $model)
    {
        $sql = "UPDATE {$this->table} SET product_id = ?, thumbnail = ? WHERE id = ?";
        pdo_execute($sql, $model->product_id, $model->thumbnail, $id);
    }

    public function get_by_product_id($productId): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE product_id = ?";
        return pdo_query($sql, $productId);
    }

    public function delete_by_product_id($productId)
    {
        $sql = "DELETE FROM {$this->table} WHERE product_id = ?";
        pdo_execute($sql, $productId);
    }
}
?>
