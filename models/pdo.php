<?php
require_once 'config.php';

/**
 * Mở kết nối đến CSDL sử dụng PDO
 * @return PDO đối tượng kết nối PDO
 */
function pdo_get_connection() {
    return config_connect(); // Gọi hàm config_connect từ file config.php
}

/**
 * Thực thi câu lệnh SQL thao tác dữ liệu (INSERT, UPDATE, DELETE)
 * @param string $sql câu lệnh SQL
 * @param array $args mảng giá trị cung cấp cho các tham số của $sql
 * @throws PDOException lỗi thực thi câu lệnh
 */
function pdo_execute($sql, ...$args) {
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($args); // Thực thi câu lệnh với các tham số
        return $stmt->rowCount();
    } catch (PDOException $e) {
        echo "SQL: $sql<br>";
        echo "Parameters: " . implode(', ', $args) . "<br>";
        throw $e;
    } finally {
        unset($conn);
    }
}

/**
 * Thực thi câu lệnh SQL truy vấn dữ liệu (SELECT)
 * @param string $sql câu lệnh SQL
 * @param array $args mảng giá trị cung cấp cho các tham số của $sql
 * @return array mảng các bản ghi
 * @throws PDOException lỗi thực thi câu lệnh
 */
function pdo_query($sql, ...$args) {
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($args);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}

/**
 * Thực thi câu lệnh SQL truy vấn một bản ghi
 * @param string $sql câu lệnh SQL
 * @param array $args mảng giá trị cung cấp cho các tham số của $sql
 * @return array|null mảng chứa bản ghi hoặc null nếu không tìm thấy
 * @throws PDOException lỗi thực thi câu lệnh
 */
function pdo_query_one($sql, ...$args) {
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($args);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}

/**
 * Thực thi câu lệnh SQL truy vấn một giá trị
 * @param string $sql câu lệnh SQL
 * @param array $args mảng giá trị cung cấp cho các tham số của $sql
 * @return mixed giá trị đầu tiên của bản ghi
 * @throws PDOException lỗi thực thi câu lệnh
 */
function pdo_query_value($sql, ...$args) {
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($args);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? array_values($row)[0] : null;
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}
?>