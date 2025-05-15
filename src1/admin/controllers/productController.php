<?php
// Thêm session_start() nếu chưa được khởi tạo từ trước
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../models/product.php';

// Phần 1: Xử lý thêm sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'add') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = (float)$_POST['price'];
    $discount = isset($_POST['discount']) && $_POST['discount'] !== '' ? (float)$_POST['discount'] : 0;
    $stock = (int)$_POST['stock'];
    $status = (int)$_POST['status'];
    $category_id = (int)$_POST['category_id'];

    $thumbnail_name = '';
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
        $thumbnail = $_FILES['thumbnail'];
        $thumbnail_name = time() . '_' . basename($thumbnail['name']);

        $uploadDir = __DIR__ . '/../../../uploads/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $uploadFile = $uploadDir . $thumbnail_name;

        if (move_uploaded_file($thumbnail['tmp_name'], $uploadFile)) {
            $result = product_insert($name, $description, $price, $discount, $stock, $status, $category_id, $thumbnail_name);

            if ($result) {
                $_SESSION['success'] = "Thêm sản phẩm thành công";
                header('Location: ../../admin.php?page=product');
                exit;
            } else {
                $error = "Không thể thêm sản phẩm vào cơ sở dữ liệu";
            }
        } else {
            $error = "Không thể tải lên hình ảnh";
        }
    } else {
        $error = "Vui lòng chọn hình ảnh cho sản phẩm";
    }

    if (isset($error)) {
        $_SESSION['error'] = $error;
        header('Location: ../../admin.php?page=product');
        exit;
    }
}

// Phần 2: Xử lý sửa sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'edit') {
    $id = (int)$_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = (float)$_POST['price'];
    $discount = isset($_POST['discount']) && $_POST['discount'] !== '' ? (float)$_POST['discount'] : 0;
    $stock = (int)$_POST['stock'];
    $status = (int)$_POST['status'];
    $category_id = (int)$_POST['category_id'];
    $current_thumbnail = $_POST['current_thumbnail'];

    $thumbnail_name = $current_thumbnail;
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
        $thumbnail_name = time() . '_' . basename($_FILES['thumbnail']['name']);

        $uploadDir = __DIR__ . '/../../../uploads/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $uploadFile = $uploadDir . $thumbnail_name;

        if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $uploadFile)) {
            if ($current_thumbnail && file_exists($uploadDir . $current_thumbnail)) {
                unlink($uploadDir . $current_thumbnail);
            }
        } else {
            $_SESSION['error'] = "Không thể tải lên hình ảnh mới";
            header('Location: ../../admin.php?page=product');
            exit;
        }
    }

    $result = product_update($id, $name, $description, $price, $discount, $stock, $status, $category_id, $thumbnail_name);

    if ($result) {
        $_SESSION['success'] = "Cập nhật sản phẩm thành công";
    } else {
        $_SESSION['error'] = "Không thể cập nhật sản phẩm";
    }

    header('Location: ../../admin.php?page=product');
    exit;
}

// Phần 3: Xử lý xóa sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = (int)$_POST['id'];

    $product = product_select_by_id($id);

    if ($product) {
        $result = product_delete($id);

        if ($result) {
            $uploadDir = __DIR__ . '/../../../uploads/';
            if ($product['thumbnail'] && file_exists($uploadDir . $product['thumbnail'])) {
                unlink($uploadDir . $product['thumbnail']);
            }

            $_SESSION['success'] = "Xóa sản phẩm thành công";
        } else {
            $_SESSION['error'] = "Không thể xóa sản phẩm";
        }
    } else {
        $_SESSION['error'] = "Không tìm thấy sản phẩm";
    }

    header('Location: ../../admin.php?page=product');
    exit;
}
?>