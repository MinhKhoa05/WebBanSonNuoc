<?php
require_once 'pdo.php';

function discount_type_select_all()
{
    $sql = "SELECT * FROM discount_types";
    return pdo_query($sql);
}

function discount_type_select_by_id($id)
{
    $sql = "SELECT * FROM discount_types WHERE id = ?";
    return pdo_query_one($sql, $id);
}

function discount_type_insert($name, $description)
{
    $sql = "INSERT INTO discount_types (name, description) VALUES (?, ?)";
    pdo_execute($sql, $name, $description);
}

function discount_type_update($id, $name, $description)
{
    $sql = "UPDATE discount_types SET name = ?, description = ? WHERE id = ?";
    pdo_execute($sql, $name, $description, $id);
}

function discount_type_delete($id)
{
    $sql = "DELETE FROM discount_types WHERE id = ?";
    pdo_execute($sql, $id);
}

function discount_type_count_all()
{
    $sql = "SELECT COUNT(*) FROM discount_types";
    return pdo_query_value($sql);
}

function discount_type_search(string $column, string $keyword)
{
    $valid_columns = ['name', 'description'];
    if (!in_array($column, $valid_columns)) {
        throw new Exception('Tên cột không hợp lệ');
    }

    $sql = "SELECT * FROM discount_types WHERE $column LIKE ?";
    return pdo_query($sql, "%" . $keyword . "%");
}

function discount_type_get_by_name($name)
{
    $sql = "SELECT * FROM discount_types WHERE name = ?";
    return pdo_query_one($sql, $name);
}

function discount_type_exists_by_name($name)
{
    $sql = "SELECT COUNT(*) FROM discount_types WHERE name = ?";
    return (int) pdo_query_value($sql, $name) > 0;
}
?>
