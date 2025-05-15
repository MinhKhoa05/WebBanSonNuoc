<?php
require_once 'pdo.php';

function review_insert($userId, $productId, $rating, $comment)
{
    $sql = "INSERT INTO reviews (user_id, product_id, rating, comment)
            VALUES (?, ?, ?, ?)";
    pdo_execute($sql, $userId, $productId, $rating, $comment);
}

// Cập nhật đánh giá
function review_update($id, $userId, $productId, $rating, $comment)
{
    $sql = "UPDATE reviews SET
            user_id = ?,
            product_id = ?,
            rating = ?,
            comment = ?,
            WHERE id = ?";
    pdo_execute($sql, $userId, $productId, $rating, $comment, $id);
}

function review_select_by_product($productId)
{
    $sql = "SELECT * FROM reviews WHERE product_id = ?";
    return pdo_query($sql, $productId);
}

function review_get_average_rating($productId)
{
    $sql = "SELECT AVG(rating) FROM reviews WHERE product_id = ?";
    return pdo_query_value($sql, $productId);
}

function review_select_by_id($id)
{
    $sql = "SELECT * FROM reviews WHERE id = ?";
    return pdo_query_one($sql, $id);
}

function review_delete($id)
{
    $sql = "DELETE FROM reviews WHERE id = ?";
    pdo_execute($sql, $id);
}
?>
