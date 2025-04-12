<?php
require_once 'pdo.php';

function gallery_select_all()
{
    $sql = "SELECT * FROM gallery";
    return pdo_query($sql);
}

function gallery_select_by_id($id)
{
    $sql = "SELECT * FROM gallery WHERE id = ?";
    return pdo_query_one($sql, $id);
}

function gallery_insert($product_id, $thumbnail)
{
    $sql = "INSERT INTO gallery (product_id, thumbnail) VALUES (?, ?)";
    pdo_execute($sql, $product_id, $thumbnail);
}

function gallery_update($id, $product_id, $thumbnail)
{
    $sql = "UPDATE gallery SET product_id = ?, thumbnail = ? WHERE id = ?";
    pdo_execute($sql, $product_id, $thumbnail, $id);
}

function gallery_delete($id)
{
    $sql = "DELETE FROM gallery WHERE id = ?";
    pdo_execute($sql, $id);
}

function gallery_search(string $column, string $keyword)
{
    $valid_columns = ['product_id', 'thumbnail'];
    if (!in_array($column, $valid_columns)) {
        throw new Exception('Tên cột không hợp lệ');
    }

    $sql = "SELECT * FROM gallery WHERE $column LIKE ?";
    return pdo_query($sql, "%" . $keyword . "%");
}

function gallery_get_by_product_id($product_id)
{
    $sql = "SELECT * FROM gallery WHERE product_id = ?";
    return pdo_query($sql, $product_id);
}

function gallery_delete_by_product_id($product_id)
{
    $sql = "DELETE FROM gallery WHERE product_id = ?";
    pdo_execute($sql, $product_id);
}
?>
