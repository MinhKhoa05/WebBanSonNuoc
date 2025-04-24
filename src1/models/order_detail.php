<?php
require_once 'pdo.php';

function order_detail_select_all()
{
    $sql = "SELECT * FROM order_details";
    return pdo_query($sql);
}

function order_detail_select_by_id($id)
{
    $sql = "SELECT * FROM order_details WHERE id = ?";
    return pdo_query_one($sql, $id);
}

function order_detail_select_by_order_id($order_id){
    $sql = "SELECT * FROM order_details WHERE order_id = ?";
    return pdo_query($sql, $order_id);
}

function order_detail_insert($order_id, $product_id, $quantity, $subtotal)
{
    $sql = "INSERT INTO order_details (order_id, product_id, quantity, subtotal)
            VALUES (?, ?, ?, ?)";
    pdo_execute($sql, $order_id, $product_id, $quantity, $subtotal);
}

function order_detail_update($id, $order_id, $product_id, $quantity, $subtotal)
{
    $sql = "UPDATE order_details SET order_id = ?, product_id = ?, quantity = ?, subtotal = ?
            WHERE id = ?";
    pdo_execute($sql, $order_id, $product_id, $quantity, $subtotal, $id);
}

function order_detail_delete($id)
{
    $sql = "DELETE FROM order_details WHERE id = ?";
    pdo_execute($sql, $id);
}

function order_detail_count_all()
{
    $sql = "SELECT COUNT(*) FROM order_details";
    return pdo_query_value($sql);
}

function order_detail_search(string $column, string $keyword)
{
    $valid_columns = ['order_id', 'product_id'];
    if (!in_array($column, $valid_columns)) {
        throw new Exception('Tên cột không hợp lệ');
    }

    $sql = "SELECT * FROM order_details WHERE $column LIKE ?";
    return pdo_query($sql, "%" . $keyword . "%");
}

function order_detail_get_by_order_id($order_id)
{
    $sql = "SELECT * FROM order_details WHERE order_id = ?";
    return pdo_query($sql, $order_id);
}

function order_detail_delete_by_order_id($order_id)
{
    $sql = "DELETE FROM order_details WHERE order_id = ?";
    pdo_execute($sql, $order_id);
}
?>