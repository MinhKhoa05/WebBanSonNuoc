<?php
require_once 'pdo.php';

function cart_select_all()
{
    $sql = "SELECT * FROM carts ORDER BY added_at DESC";
    return pdo_query($sql);
}

function cart_select_by_id($id)
{
    $sql = "SELECT * FROM carts WHERE id = ?";
    return pdo_query_one($sql, $id);
}

function cart_insert($user_id, $product_id, $quantity)
{
    $sql = "INSERT INTO carts (user_id, product_id, quantity)
            VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE quantity = quantity + ?";
    pdo_execute($sql, $user_id, $product_id, $quantity, $quantity);
}

function cart_update($user_id, $product_id, $quantity)
{
    cart_insert($user_id, $product_id, $quantity);
}

function cart_delete($userId, $productId) {
    $sql = "DELETE FROM carts WHERE user_id = ? AND product_id = ?";
    pdo_execute($sql, $userId, $productId);
}

function cart_count_all()
{
    $sql = "SELECT COUNT(*) FROM carts";
    return (int)pdo_query_value($sql);
}

function cart_search(string $column, string $keyword)
{
    $valid_columns = ['user_id', 'product_id', 'quantity', 'added_at'];
    if (!in_array($column, $valid_columns)) {
        throw new Exception('Tên cột không hợp lệ');
    }

    $sql = "SELECT * FROM carts WHERE $column LIKE ?";
    return pdo_query($sql, "%" . $keyword . "%");
}

function cart_select_by_user($user_id)
{
    $sql = "SELECT * FROM carts WHERE user_id = ?";
    return pdo_query($sql, $user_id);
}

function cart_select_by_user_and_product($user_id, $product_id)
{
    $sql = "SELECT * FROM carts WHERE user_id = ? AND product_id = ?";
    return pdo_query_one($sql, $user_id, $product_id);
}

function cart_delete_by_user($user_id)
{
    $sql = "DELETE FROM carts WHERE user_id = ?";
    pdo_execute($sql, $user_id);
}