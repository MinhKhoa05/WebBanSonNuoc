<?php
require_once 'pdo.php';

function category_select_all()
{
    $sql = "SELECT * FROM categories WHERE is_deleted = 0 ORDER BY created_at ASC";
    return pdo_query($sql);
}

function category_select_by_id($id)
{
    $sql = "SELECT * FROM categories WHERE is_deleted = 0 AND id = ?";
    return pdo_query_one($sql, $id);
}

function category_insert($name)
{
    $sql = "INSERT INTO categories (name) VALUES (?)";
    pdo_execute($sql, $name);
}

function category_update($id, $name)
{
    $sql = "UPDATE categories SET name = ? WHERE id = ?";
    pdo_execute($sql, $name, $id);
}

function category_delete($id)
{
    $sql = "DELETE FROM categories WHERE id = ?";
    pdo_execute($sql, $id);
}

function category_count_all()
{
    $sql = "SELECT COUNT(*) FROM categories WHERE is_deleted = 0";
    return pdo_query_value($sql);
}

function category_search(string $column, string $keyword)
{
    $valid_columns = ['name'];
    if (!in_array($column, $valid_columns)) {
        throw new Exception('Tên cột không hợp lệ');
    }

    $sql = "SELECT * FROM categories WHERE $column LIKE ? AND is_deleted = 0";
    return pdo_query($sql, "%" . $keyword . "%");
}

function category_get_by_name($name)
{
    $sql = "SELECT * FROM categories WHERE name = ? AND is_deleted = 0";
    return pdo_query_one($sql, $name);
}

function category_exists_by_name($name)
{
    $sql = "SELECT COUNT(*) FROM categories WHERE name = ? AND is_deleted = 0";
    return (int) pdo_query_value($sql, $name) > 0;
}
?>
