<?php
require_once 'pdo.php';

function product_select_all()
{
    $sql = "SELECT * FROM products WHERE is_deleted = 0 ORDER BY name ASC";
    return pdo_query($sql);
}

function product_select_by_id($id)
{
    $sql = "SELECT * FROM products WHERE is_deleted = 0 AND id = ?";
    return pdo_query_one($sql, $id);
}

function product_insert($name, $description, $price, $discount, $stock, $status, $category_id, $thumbnail)
{
    $sql = "INSERT INTO products
            (name, description, price, discount, stock, status, category_id, thumbnail)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    pdo_execute($sql, $name, $description, $price, $discount, $stock, $status, $category_id, $thumbnail);
}

function product_update($id, $name, $description, $price, $discount, $stock, $status, $category_id, $thumbnail)
{
    $sql = "UPDATE products SET
            name = ?, 
            description = ?, 
            price = ?, 
            discount = ?, 
            stock = ?, 
            status = ?, 
            category_id = ?, 
            thumbnail = ?, 
            WHERE id = ?";
    pdo_execute($sql, $name, $description, $price, $discount, $stock, $status, $category_id, $thumbnail, $id);
}

function product_select_by_category_id($categoryId)
{
    $sql = "SELECT * FROM products WHERE category_id = ? AND is_deleted = 0";
    return pdo_query($sql, $categoryId);
}

function product_select_best_selling($limit = 8)
{
    $sql = "SELECT * FROM best_selling_products LIMIT ?";
    return pdo_query($sql, $limit);
}

function product_soft_delete($id)
{
    $sql = "UPDATE products SET is_deleted = 1 WHERE id = ?";
    pdo_execute($sql, $id);
}

function product_delete($id)
{
    $sql = "DELETE FROM products WHERE id = ?";
    pdo_execute($sql, $id);
}

function product_search_by_name($keyword)
{
    $sql = "SELECT * FROM products WHERE name LIKE ? AND is_deleted = 0";
    return pdo_query($sql, "%" . $keyword . "%");
}

function product_count_by_category($categoryId)
{
    $sql = "SELECT COUNT(*) FROM products WHERE category_id = ? AND is_deleted = 0";
    return pdo_query_value($sql, $categoryId);
}
?>
