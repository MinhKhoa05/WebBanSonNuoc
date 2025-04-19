<?php
require_once 'pdo.php';

function promotion_select_active()
{
    $sql = "SELECT * FROM promotions WHERE CURDATE() BETWEEN start_date AND end_date";
    return pdo_query($sql);
}

function promotion_select_by_product_id($productId)
{
    $sql = "SELECT * FROM promotions WHERE product_id = ?";
    return pdo_query($sql, $productId);
}

function promotion_insert($productId, $discountTypeId, $value, $startDate, $endDate)
{
    $sql = "INSERT INTO promotions (product_id, discount_type_id, value, start_date, end_date)
            VALUES (?, ?, ?, ?, ?)";
    pdo_execute($sql, $productId, $discountTypeId, $value, $startDate, $endDate);
}

function promotion_update($id, $productId, $discountTypeId, $value, $startDate, $endDate)
{
    $sql = "UPDATE promotions SET
            product_id = ?,
            discount_type_id = ?,
            value = ?,
            start_date = ?,
            end_date = ?,
            WHERE id = ?";
    pdo_execute($sql, $productId, $discountTypeId, $value, $startDate, $endDate, $id);
}

function promotion_delete($id)
{
    $sql = "DELETE FROM promotions WHERE id = ?";
    pdo_execute($sql, $id);
}

function promotion_select_by_id($id)
{
    $sql = "SELECT * FROM promotions WHERE id = ?";
    return pdo_query_one($sql, $id);
}

function promotion_select_by_product($productId)
{
    $sql = "SELECT * FROM promotions WHERE product_id = ? AND CURDATE() BETWEEN start_date AND end_date";
    return pdo_query($sql, $productId);
}
?>
