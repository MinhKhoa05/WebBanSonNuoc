<?php
require_once 'pdo.php';

function setting_get_all() {
    $sql = "SELECT * FROM settings";
    $settings = pdo_query($sql);
    $result = [];
    foreach ($settings as $setting) {
        $result[$setting['key']] = $setting['value'];
    }
    return $result;
}

function setting_get($key) {
    $sql = "SELECT value FROM settings WHERE `key` = ?";
    return pdo_query_value($sql, $key);
}

function setting_update($key, $value) {
    $sql = "UPDATE settings SET value = ? WHERE `key` = ?";
    return pdo_execute($sql, $value, $key);
}

function setting_insert($key, $value) {
    $sql = "INSERT INTO settings (`key`, value) VALUES (?, ?)";
    return pdo_execute($sql, $key, $value);
}

function setting_save($key, $value) {
    if (setting_get($key) === false) {
        return setting_insert($key, $value);
    }
    return setting_update($key, $value);
}

// Hàm upload file
function upload_file($file, $target_dir = 'uploads/') {
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $target_file = $target_dir . basename($file['name']);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Kiểm tra file có phải là ảnh
    $check = getimagesize($file['tmp_name']);
    if ($check === false) {
        return false;
    }
    
    // Kiểm tra kích thước file (5MB)
    if ($file['size'] > 5000000) {
        return false;
    }
    
    // Cho phép một số định dạng file
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        return false;
    }
    
    // Tạo tên file ngẫu nhiên
    $new_filename = uniqid() . '.' . $imageFileType;
    $target_file = $target_dir . $new_filename;
    
    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        return $new_filename;
    }
    
    return false;
} 