<?php
/**
 * Mở kết nối đến CSDL sử dụng PDO
 * @return PDO đối tượng kết nối PDO
 */
function pdo_get_connection() {
    $host = 'localhost';
    $dbname = 'bansonnuoc';
    $username = 'root';
    $password = '';
    
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        throw new Exception("Connection failed: " . $e->getMessage());
    }
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
        $stmt->execute($args);
        return $stmt->rowCount();
    } catch(PDOException $e) {
        throw new Exception("Query failed: " . $e->getMessage());
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
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        throw new Exception("Query failed: " . $e->getMessage());
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
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        throw new Exception("Query failed: " . $e->getMessage());
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
        return $stmt->fetchColumn();
    } catch(PDOException $e) {
        throw new Exception("Query failed: " . $e->getMessage());
    }
}
?>