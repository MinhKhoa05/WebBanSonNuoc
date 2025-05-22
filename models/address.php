<?php
require_once 'pdo.php';

function address_get_by_user_id($user_id) {
    $sql = "SELECT * FROM addresses WHERE user_id = ? AND is_deleted = 0 ORDER BY is_default DESC";
    return pdo_query($sql, $user_id);
}

function address_get_by_id($id) {
    $sql = "SELECT * FROM addresses WHERE id = ? AND is_deleted = 0";
    return pdo_query_one($sql, $id);
}

function address_insert($user_id, $fullname, $phone, $address, $is_default = 0) {
    // If this is default address, unset other default addresses
    if ($is_default) {
        $sql = "UPDATE addresses SET is_default = 0 WHERE user_id = ?";
        pdo_execute($sql, $user_id);
    }
    
    $sql = "INSERT INTO addresses (user_id, fullname, phone, address, is_default) 
            VALUES (?, ?, ?, ?, ?)";
    return pdo_execute($sql, $user_id, $fullname, $phone, $address, $is_default);
}

function address_update($id, $fullname, $phone, $address, $is_default = 0) {
    // Get user_id from address
    $address_data = address_get_by_id($id);
    if (!$address_data) {
        return false;
    }
    
    // If this is default address, unset other default addresses
    if ($is_default) {
        $sql = "UPDATE addresses SET is_default = 0 WHERE user_id = ? AND id != ?";
        pdo_execute($sql, $address_data['user_id'], $id);
    }
    
    $sql = "UPDATE addresses 
            SET fullname = ?, phone = ?, address = ?, is_default = ? 
            WHERE id = ?";
    return pdo_execute($sql, $fullname, $phone, $address, $is_default, $id);
}

function address_delete($id) {
    $sql = "UPDATE addresses SET is_deleted = 1 WHERE id = ?";
    return pdo_execute($sql, $id);
}

function address_set_default($id) {
    // Get address data
    $address = address_get_by_id($id);
    if (!$address) {
        return false;
    }
    
    // Unset other default addresses
    $sql = "UPDATE addresses SET is_default = 0 WHERE user_id = ?";
    pdo_execute($sql, $address['user_id']);
    
    // Set this address as default
    $sql = "UPDATE addresses SET is_default = 1 WHERE id = ?";
    return pdo_execute($sql, $id);
} 