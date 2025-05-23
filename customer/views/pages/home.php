<?php
require_once __DIR__ . '/../../../models/setting.php';
$customer_banners = setting_get_banners();
?>
<link rel="stylesheet" href="customer/views/assets/css/home.css">

<?php
    include("customer/views/layout/banner.php");
    include("customer/views/layout/products-section.php");
?>
