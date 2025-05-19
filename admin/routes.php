<?php
session_start();

$page = $_GET['page'] ?? 'dashboard';
$action = $_GET['action'] ?? '';

$data = [];

switch ($page) {
    case 'product':
        require_once __DIR__ . '/controllers/ProductController.php';
        $controller = new ProductController();

        switch ($action) {
            case 'add':
                $controller->add();
                break;
            case 'edit':
                $controller->edit();
                break;
            case 'delete':
                $controller->soft_delete();
                break;
            case 'toggle':
                $controller->toggle_view();
            default:
                $controller->index();
                break;
        }

        $data = $controller->getData();
        break;

    case 'dashboard':
    case 'category':
        require_once __DIR__ . '/controllers/CategoryController.php';
        $controller = new CategoryController();

        switch ($action) {
            case 'add':
                $controller->add();
                break;
            case 'edit':
                $controller->edit();
                break;
            case 'delete':
                $controller->soft_delete();
                break;
            case 'toggle':
                // $controller->toggle_view();
            default:
                $controller->index();
                break;
        }

        $data = $controller->getData();
        break;
    default:
        $page = 'dashboard';
        // Có thể load DashboardController tương tự
        break;
}

$GLOBALS['page'] = $page;
$GLOBALS['data'] = $data;
