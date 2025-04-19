<?php
require_once 'pdo.php';

function post_select_all()
{
    $sql = "SELECT * FROM posts ORDER BY created_at DESC";
    return pdo_query($sql);
}

function post_select_by_id($id)
{
    $sql = "SELECT * FROM posts WHERE id = ?";
    return pdo_query_one($sql, $id);
}

function post_insert($title, $content, $author_id, $category, $status, $thumbnail)
{
    $sql = "INSERT INTO posts 
            (title, content, author_id, category, status, thumbnail)
            VALUES (?, ?, ?, ?, ?, ?)";
    pdo_execute($sql, $title, $content, $author_id, $category, $status, $thumbnail);
}

function post_update($id, $title, $content, $author_id, $category, $status, $thumbnail)
{
    $sql = "UPDATE posts SET 
            title = ?, 
            content = ?, 
            author_id = ?, 
            category = ?, 
            status = ?, 
            thumbnail = ? 
            WHERE id = ?";
    pdo_execute($sql, $title, $content, $author_id, $category, $status, $thumbnail, $id);
}

function post_delete($id)
{
    $sql = "DELETE FROM posts WHERE id = ?";
    pdo_execute($sql, $id);
}

function post_search(string $column, string $keyword)
{
    $valid_columns = ['title', 'content', 'author_id', 'category'];
    if (!in_array($column, $valid_columns)) {
        throw new Exception('Tên cột không hợp lệ');
    }

    $sql = "SELECT * FROM posts WHERE $column LIKE ?";
    return pdo_query($sql, "%" . $keyword . "%");
}

function post_get_by_author($authorId)
{
    $sql = "SELECT * FROM posts WHERE author_id = ?";
    return pdo_query($sql, $authorId);
}

function post_get_published()
{
    $sql = "SELECT * FROM posts WHERE status = 'published'";
    return pdo_query($sql);
}
?>
