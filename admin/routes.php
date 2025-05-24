<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$page = $_GET['page'] ?? 'dashboard';
$action = $_GET['action'] ?? '';

$data = [];

switch ($page) {
    case 'product':
        require_once __DIR__ . '/controllers/ProductController.php';

        $productController = new ProductController();

        switch ($action) {
            // Product actions
            case 'add':
                $productController->add();
                break;
            case 'edit':
                $productController->edit();
                break;
            case 'soft_delete':
                $productController->soft_delete();
                break;
            case 'toggle':
                $productController->toggle_view();
                break;
            case 'trash':
                $productController->trash();
                break;
            case 'delete':
                $productController->delete();
                break;
            case 'restore':
                $productController->restore();
                break;

            // Category actions (integrated)
            case 'add_category':
                $productController->category_add();
                break;
            case 'edit_category':
                $productController->category_edit();
                break;
            case 'delete_category':
                $productController->category_delete();
                break;

            default:
                $productController->index();
                break;
        }

        $data = $productController->get_data();
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

        switch ($action) {
            case 'update_status':
                $controller->update_status();
                break;
            default:
                $controller->index();
                break;
        }

        $data = $controller->get_data();
        break;

    case 'customer':
        require_once __DIR__ . '/controllers/UserController.php';
        $controller = new UserController();
        $controller->index();
        $data = $controller->get_data();
        break;

    case 'post':
        require_once __DIR__ . '/controllers/PostController.php';
        $controller = new PostController();

        switch ($action) {
            case 'add':
                $controller->add();
                break;
            case 'edit':
                $controller->edit();
                break;
            case 'delete':
                $controller->delete();
                break;
            default:
                $controller->index();
                break;
        }

        $data = $controller->get_data();
        break;

    case 'setting':
        require_once __DIR__ . '/controllers/SettingController.php';
        $controller = new SettingController();
        if (isset($_GET['action']) && $_GET['action'] === 'updateBanner') {
            $controller->updateBanner();
        } else {
            $controller->index();
        }
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
