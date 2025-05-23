<?php
require_once 'BaseModel.php';

class SettingModel extends BaseModel {
    public function __construct() {
        parent::__construct('setting', 'id');
    }

    public function getByKey(string $key): ?array {
        $sql = "SELECT * FROM {$this->table} WHERE `key` = ? LIMIT 1";
        return pdo_query_one($sql, $key);
    }

    public function updateByKey(string $key, string $value): bool {
        $sql = "UPDATE {$this->table} SET `value` = ?, updated_at = NOW() WHERE `key` = ?";
        return pdo_execute($sql, $value, $key);
    }

    public function getBanners($prefix = 'customer_banner_', $count = 8): array {
        $banners = [];
        for ($i = 1; $i <= $count; $i++) {
            $key = $prefix . $i;
            $banner = $this->getByKey($key);
            if (!$banner) {
                error_log("Không tìm thấy key: $key");
            }
            $banners[] = $banner ? $banner['value'] : '';
        }
        return $banners;
    }
} 