<?php
require_once __DIR__.'/models/category.php';

$categories = category_select_all();
print_r($categories);
