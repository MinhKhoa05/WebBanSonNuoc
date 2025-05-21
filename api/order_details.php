<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../models/order.php';

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Order ID is required']);
    exit;
}

$order_id = intval($_GET['id']);
$order = order_get_details($order_id);

if (!$order) {
    http_response_code(404);
    echo json_encode(['error' => 'Order not found']);
    exit;
}

echo json_encode($order); 