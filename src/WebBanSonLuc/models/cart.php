<?php
require_once 'pdo.php';

function cart_select_all()
{
    $sql = "SELECT * FROM carts WHERE is_deleted = 0 ORDER BY created_at DESC";
    return pdo_query($sql);
}

function cart_select_by_id($id)
{
    $sql = "SELECT * FROM carts WHERE is_deleted = 0 AND id = ?";
    return pdo_query_one($sql, $id);
}

function cart_insert($user_id, $product_id, $quantity, $added_at)
{
    $sql = "INSERT INTO carts (user_id, product_id, quantity, added_at)
            VALUES (?, ?, ?, ?)";
    pdo_execute($sql, $user_id, $product_id, $quantity, $added_at);
}

function cart_update($id, $user_id, $product_id, $quantity, $added_at)
{
    $sql = "UPDATE carts SET user_id = ?, product_id = ?, quantity = ?, added_at = ? WHERE id = ?";
    pdo_execute($sql, $user_id, $product_id, $quantity, $added_at, $id);
}

// Delete giả (gán is_deleted = 1)
function cart_soft_delete($id)
{
    $sql = "UPDATE carts SET is_deleted = 1 WHERE id = ?";
    pdo_execute($sql, $id);
}

function cart_delete($id)
{
    $sql = "DELETE FROM carts WHERE id = ?";
    pdo_execute($sql, $id);
}

function cart_count_all()
{
    $sql = "SELECT COUNT(*) FROM carts WHERE is_deleted = 0";
    return (int)pdo_query_value($sql);
}

function cart_search(string $column, string $keyword)
{
    $valid_columns = ['user_id', 'product_id', 'quantity', 'added_at'];
    if (!in_array($column, $valid_columns)) {
        throw new Exception('Tên cột không hợp lệ');
    }

    $sql = "SELECT * FROM carts WHERE $column LIKE ? AND is_deleted = 0";
    return pdo_query($sql, "%" . $keyword . "%");
}

function cart_select_by_user($user_id)
{
    $sql = "SELECT * FROM carts WHERE user_id = ? AND is_deleted = 0";
    return pdo_query($sql, $user_id);
}

function cart_select_by_user_and_product($user_id, $product_id)
{
    $sql = "SELECT * FROM carts WHERE user_id = ? AND product_id = ? AND is_deleted = 0";
    return pdo_query_one($sql, $user_id, $product_id);
}

function cart_delete_by_user($user_id)
{
    $sql = "DELETE FROM carts WHERE user_id = ?";
    pdo_execute($sql, $user_id);
}

function get_cart_from_database($user_id) {
    global $pdo;
    $sql = "SELECT * FROM carts WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result ? $result : []; // Trả về mảng rỗng nếu không có dữ liệu
}

function save_cart_to_database($cart, $user_id) {
    global $pdo;

    foreach ($cart as $item) {
        // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng của user chưa
        $sql = "SELECT * FROM carts WHERE product_id = :product_id AND user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'product_id' => $item['id'],
            'user_id' => $user_id
        ]);
        $existingItem = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingItem) {
            // Nếu sản phẩm đã có, cập nhật số lượng
            $sql = "UPDATE carts 
                    SET quantity = quantity + :quantity 
                    WHERE product_id = :product_id AND user_id = :user_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'quantity' => $item['quantity'],
                'product_id' => $item['id'],
                'user_id' => $user_id
            ]);
        } else {
            // Nếu chưa có, thêm mới
            $sql = "INSERT INTO carts (user_id, product_id, name, price, thumbnail, quantity) 
                    VALUES (:user_id, :product_id, :name, :price, :thumbnail, :quantity)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'user_id' => $user_id,
                'product_id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'thumbnail' => $item['thumbnail'],
                'quantity' => $item['quantity']
            ]);
        }
    }
}


?>
