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

        $data = $controller->get_data();
        break;

    case 'brand':
        require_once __DIR__ . '/controllers/BrandController.php';
        $controller = new BrandController();

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
            case 'toggle_featured':
                $controller->toggle_featured();
                break;
            default:
                $controller->index();
                break;
        }

        $data = $controller->get_data();
        break;
        
    case 'order':
        require_once __DIR__ . '/controllers/OrderController.php';
        $controller = new OrderController();
        $controller->index();
        $data = $controller->get_data();
        break;

    case 'dashboard':
    default:
        $page = 'dashboard';
        // Có thể load DashboardController tương tự
        break;
}

$GLOBALS['page'] = $page;
$GLOBALS['data'] = $data;
