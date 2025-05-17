<?php
require_once 'pdo.php';

function product_select_all() {
    $sql = "SELECT p.*, c.name AS category_name 
            FROM products p
            JOIN categories c ON p.category_id = c.id
            WHERE p.view = 1";
    return pdo_query($sql);
}

function product_select_by_id($id)
{
    $sql = "SELECT * FROM products WHERE view = 1 AND id = ?";
    return pdo_query_one($sql, $id);
}

function product_select_by_category_id($categoryId)
{
    $sql = "SELECT * FROM products WHERE category_id = ? AND view = 1";
    return pdo_query($sql, $categoryId);
}

function product_select_by_price($maxPrice) {
    $sql = "SELECT * FROM products WHERE price <= ?";
    return pdo_query($sql, $maxPrice);
}

function product_search_by_name($keyword)
{
    $sql = "SELECT * FROM products WHERE name LIKE ? AND view = 1";
    return pdo_query($sql, "%" . $keyword . "%");
}

function product_filter_count($categoryId = null, $maxPrice = null)
{
    $sql = "SELECT COUNT(*) 
            FROM products p
            WHERE p.view = 1";
    $params = [];

    // Lọc theo danh mục
    if (!is_null($categoryId) && $categoryId !== 'all') {
        $sql .= " AND p.category_id = ?";
        $params[] = $categoryId;
    }

    // Lọc theo giá
    if (!is_null($maxPrice)) {
        $sql .= " AND p.price <= ?";
        $params[] = $maxPrice;
    }

    return pdo_query_value($sql, ...$params);
}

function product_filter($categoryId = null, $maxPrice = null, $status = null, $sort = null, $startIndex = 0, $limit = 10)
{
    $sql = "SELECT p.*, c.name as category_name 
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.id
            WHERE p.view = 1";
    $params = [];

    // Lọc theo danh mục
    if (!is_null($categoryId) && $categoryId !== 'all') {
        $sql .= " AND p.category_id = ?";
        $params[] = $categoryId;
    }

    // Lọc theo giá
    if (!is_null($maxPrice)) {
        $sql .= " AND p.price <= ?";
        $params[] = $maxPrice;
    }

    // Sắp xếp
    if (!is_null($sort)) {
        if ($sort === 'price_asc') {
            $sql .= " ORDER BY p.price ASC";
        } elseif ($sort === 'price_desc') {
            $sql .= " ORDER BY p.price DESC";
        } elseif ($sort === 'newest') {
            $sql .= " ORDER BY p.created_at DESC";
        } else {
            $sql .= " ORDER BY p.id DESC"; // Mặc định
        }
    } else {
        $sql .= " ORDER BY p.id DESC"; // Mặc định
    }

    // Giới hạn số lượng sản phẩm
    $sql .= " LIMIT ?, ?";
    $params[] = $startIndex;
    $params[] = $limit;

    return pdo_query($sql, ...$params);
}
?>