<?php
require_once 'pdo.php';

function feedback_select_all()
{
    $sql = "SELECT * FROM feedback ORDER BY created_at DESC";
    return pdo_query($sql);
}

function feedback_select_by_id($id)
{
    $sql = "SELECT * FROM feedback WHERE id = ?";
    return pdo_query_one($sql, $id);
}

function feedback_insert($user_id, $subject, $comment)
{
    $sql = "INSERT INTO feedback (user_id, subject, comment) 
            VALUES (?, ?, ?)";
    pdo_execute($sql, $user_id, $subject, $comment);
}

function feedback_update($id, $user_id, $subject, $comment)
{
    $sql = "UPDATE feedback SET user_id = ?, subject = ?, comment = ? WHERE id = ?";
    pdo_execute($sql, $user_id, $subject, $comment, $id);
}

function feedback_delete($id)
{
    $sql = "DELETE FROM feedback WHERE id = ?";
    pdo_execute($sql, $id);
}

function feedback_search(string $column, string $keyword)
{
    $valid_columns = ['subject', 'comment'];
    if (!in_array($column, $valid_columns)) {
        throw new Exception('Tên cột không hợp lệ');
    }

    $sql = "SELECT * FROM feedback WHERE $column LIKE ?";
    return pdo_query($sql, "%" . $keyword . "%");
}

function feedback_get_by_user_id($user_id)
{
    $sql = "SELECT * FROM feedback WHERE user_id = ?";
    return pdo_query($sql, $user_id);
}
?>
