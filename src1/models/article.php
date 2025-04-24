<?php
require_once 'pdo.php';

function article_select_all()
{
    $sql = "SELECT * FROM articles WHERE is_deleted = 0 ORDER BY created_at DESC";
    return pdo_query($sql);
}

function article_select_by_id($id)
{
    $sql = "SELECT * FROM articles WHERE is_deleted = 0 AND id = ?";
    return pdo_query_one($sql);
}

function article_insert($title, $content, $author_id, $category, $thumbnail)
{
    $sql = "INSERT INTO articles (title, content, author_id, category, thumbnail)
            VALUES (?, ?, ?, ?, ?)";
    pdo_execute($sql, $title, $content, $author_id, $category, $thumbnail);
}

function article_update($id, $title, $content, $author_id, $category, $thumbnail)
{
    $sql = "UPDATE articles SET title = ?, content = ?, author_id = ?, category = ?, thumbnail = ? WHERE id = ?";
    pdo_execute($sql, $title, $content, $author_id, $category, $thumbnail, $id);
}

// Delete giả (gán is_delete = 1) 
function article_soft_delete($id)
{
    $sql = "UPDATE articles SET is_deleted = 1 WHERE id = ?";
    pdo_execute($sql, $id);
}

function article_delete($id)
{
    $sql = "DELETE FROM articles WHERE id = ?";
    pdo_execute($sql, $id);
}

function article_count_all()
{
    $sql = "SELECT COUNT(*) FROM articles WHERE is_deleted = 0";
    return pdo_query_value($sql);
}

function article_search(string $column, string $keyword)
{
    $valid_columns = ['title', 'content', 'author_id', 'category'];
    if (!in_array($column, $valid_columns)) {
        throw new Exception('Tên cột không hợp lệ');
    }

    $sql = "SELECT * FROM articles WHERE $column LIKE ? AND is_deleted = 0";
    return pdo_query($sql, "%" . $keyword . "%");
}

function select_by_author($authorId)
{
    $sql = "SELECT * FROM articles WHERE author_id = ?";
    return pdo_query($sql, $authorId);
}

function select_recent($limit = 5)
{
    $sql = "SELECT * FROM articles ORDER BY created_at DESC LIMIT ?";
    return pdo_query($sql, $limit);
}