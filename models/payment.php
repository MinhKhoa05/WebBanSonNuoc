<?php
require_once 'pdo.php';

function payment_select_all()
{
    $sql = "SELECT * FROM payments ORDER BY created_at DESC";
    return pdo_query($sql);
}

function payment_select_by_id($id)
{
    $sql = "SELECT * FROM payments WHERE id = ?";
    return pdo_query_one($sql, $id);
}

function payment_insert($order_id, $method, $status)
{
    $sql = "INSERT INTO payments (order_id, method, status)
            VALUES (?, ?, ?)";
    pdo_execute($sql, $order_id, $method, $status);
}

function payment_update($id, $order_id, $method, $status)
{
    $sql = "UPDATE payments SET order_id = ?, method = ?, status = ? WHERE id = ?";
    pdo_execute($sql, $order_id, $method, $status, $id);
}

function payment_delete($id)
{
    $sql = "DELETE FROM payments WHERE id = ?";
    pdo_execute($sql, $id);
}

function payment_search(string $column, string $keyword)
{
    $valid_columns = ['order_id', 'method', 'status'];
    if (!in_array($column, $valid_columns)) {
        throw new Exception('Tên cột không hợp lệ');
    }

    $sql = "SELECT * FROM payments WHERE $column LIKE ?";
    return pdo_query($sql, "%" . $keyword . "%");
}

function payment_get_by_order_id($order_id)
{
    $sql = "SELECT * FROM payments WHERE order_id = ?";
    return pdo_query($sql, $order_id);
}

function payment_update_status($id, $status)
{
    $sql = "UPDATE payments SET status = ? WHERE id = ?";
    pdo_execute($sql, $status, $id);
}
?>
