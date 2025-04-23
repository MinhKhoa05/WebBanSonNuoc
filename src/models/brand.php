<?php
require_once 'pdo.php';

/**
 * Lấy tất cả thương hiệu, sắp xếp theo ID mới nhất.
 */
function brand_select_all()
{
    $sql = "SELECT * FROM brands ORDER BY id DESC";
    return pdo_query($sql);
}

/**
 * Lấy thương hiệu theo ID.
 */
function brand_select_by_id($id)
{
    $sql = "SELECT * FROM brands WHERE id = ?";
    return pdo_query_one($sql, $id);
}

/**
 * Thêm thương hiệu mới.
 */
function brand_insert($name, $image = null)
{
    $sql = "INSERT INTO brands (name, image) VALUES (?, ?)";
    pdo_execute($sql, $name, $image);
}

/**
 * Cập nhật thương hiệu.
 */
function brand_update($id, $name, $image = null)
{
    if ($image === null) {
        $sql = "UPDATE brands SET name = ? WHERE id = ?";
        pdo_execute($sql, $name, $id);
    } else {
        $sql = "UPDATE brands SET name = ?, image = ? WHERE id = ?";
        pdo_execute($sql, $name, $image, $id);
    }
}

/**
 * Xóa thương hiệu theo ID.
 */
function brand_delete($id)
{
    $sql = "DELETE FROM brands WHERE id = ?";
    pdo_execute($sql, $id);
}

/**
 * Kiểm tra thương hiệu có tồn tại không.
 */
function brand_exists($id)
{
    $sql = "SELECT COUNT(*) FROM brands WHERE id = ?";
    return pdo_query_value($sql, $id) > 0;
}

/**
 * Tìm kiếm thương hiệu theo tên (gần đúng).
 */
function brand_search_by_name($keyword)
{
    $sql = "SELECT * FROM brands WHERE name LIKE ? ORDER BY id DESC";
    return pdo_query($sql, "%$keyword%");
}

/**
 * Lấy thương hiệu có phân trang.
 */
function brand_select_page($limit, $offset)
{
    $sql = "SELECT * FROM brands ORDER BY id DESC LIMIT ? OFFSET ?";
    return pdo_query($sql, $limit, $offset);
}

/**
 * Đếm tổng số thương hiệu (để phân trang).
 */
function brand_count_all()
{
    $sql = "SELECT COUNT(*) FROM brands";
    return (int)pdo_query_value($sql);
}

/**
 * Lấy danh sách thương hiệu nổi bật (is_featured = 1)
 */
function brand_select_featured($limit = 5)
{
    $sql = "SELECT * FROM brands WHERE is_featured = 1 ORDER BY id DESC LIMIT $limit";
    return pdo_query($sql);
}

?>


