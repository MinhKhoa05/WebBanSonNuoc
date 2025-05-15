<?php
session_start();

$page = $_GET['page'] ?? 'dashboard';
$action = $_GET['action'] ?? '';

$data = [];

switch ($page) {
    case 'product':
        require_once __DIR__ . '/controllers/ProductController.php';
        $controller = new ProductController();

        if ($action === 'add') {
            $controller->add();
        } elseif ($action === 'edit') {
            $controller->edit();
        } elseif ($action === 'delete') {
            $controller->delete();
        } else {
            $controller->index();
        }

        $data = $controller->getData();
        break;

    case 'dashboard':
    default:
        $page = 'dashboard';
        // Có thể load DashboardController tương tự
        break;
}

$GLOBALS['page'] = $page;
$GLOBALS['data'] = $data;
