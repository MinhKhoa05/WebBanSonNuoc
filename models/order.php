<?php
require_once 'pdo.php';

function order_select_all()
{
    $sql = "SELECT * FROM orders ORDER BY order_date ASC";
    return pdo_query($sql);
}

function order_select_by_id($id)
{
    $sql = "SELECT * FROM orders WHERE is_deleted = 0 AND id = ?";
    return pdo_query_one($sql, $id);
}

function order_insert($user_id, $order_date, $total, $status)
{
    $sql = "INSERT INTO orders (user_id, order_date, total, status) VALUES (?, ?, ?, ?)";
    pdo_execute($sql, $user_id, $order_date, $total, $status);
}

function order_insert_full($user_id, $fullname, $phone, $address, $note, $payment_method, $order_date, $total, $shipping, $status) {
    $sql = "INSERT INTO orders (user_id, fullname, phone, address, note, payment_method, order_date, total, shipping, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    pdo_execute($sql, $user_id, $fullname, $phone, $address, $note, $payment_method, $order_date, $total, $shipping, $status);
}

function order_update($id, $user_id, $order_date, $total, $status)
{
    $sql = "UPDATE orders SET user_id = ?, order_date = ?, total = ?, status = ? WHERE id = ?";
    pdo_execute($sql, $user_id, $order_date, $total, $status, $id);
}

function order_delete($id)
{
    $sql = "DELETE FROM orders WHERE id = ?";
    pdo_execute($sql, $id);
}

function order_count_all()
{
    $sql = "SELECT COUNT(*) FROM orders";
    return pdo_query_value($sql);
}

function order_search(string $column, string $keyword)
{
    $valid_columns = ['user_id', 'order_date', 'status'];
    if (!in_array($column, $valid_columns)) {
        throw new Exception('Tên cột không hợp lệ');
    }

    $sql = "SELECT * FROM orders WHERE $column LIKE ?";
    return pdo_query($sql, "%" . $keyword . "%");
}

function order_get_by_user_id($user_id)
{
    $sql = "SELECT * FROM orders WHERE user_id = ?";
    return pdo_query($sql, $user_id);
}

function order_get_by_status($status)
{
    $sql = "SELECT * FROM orders WHERE status = ?";
    return pdo_query($sql, $status);
}

function update_status($id, $status)
{
    $sql = "UPDATE orders SET status = ? WHERE id = ?";
    pdo_execute($sql, $status, $id);
}
?>