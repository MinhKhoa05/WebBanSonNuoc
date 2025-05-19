<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/ProductModel.php';
require_once __DIR__ . '/../models/CategoryModel.php';
require_once __DIR__ . '/../helpers/Common.php';

class CategoryController
{
    private CategoryModel $model;
    private array $data = [];

    public function __construct()
    {
        $this->model = new CategoryModel();
    }

    public function index(): void
    {
        $categories = $this->model->get_all();
        $this->data['categories'] = $categories;
        
        // Đếm số lượng sản phẩm trong mỗi danh mục (nếu cần)
        if (class_exists('ProductModel')) {
            $product_model = new ProductModel();
            foreach ($categories as &$category) {
                $category['product_count'] = $product_model->count_products($category['id']);
            }
        }
    }

    public function add(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'description' => $_POST['description'] ?? '',
                'status' => intval($_POST['status'] ?? 1)
            ];
            
            // Xử lý upload hình ảnh nếu có
            if (!empty($_FILES['thumbnail']['name'])) {
                $upload = handle_file_upload();
                if ($upload !== '') {
                    $data['thumbnail'] = $upload;
                }
            }

            $success = $this->model->insert($data);
            set_flash($success ? 'success' : 'error', $success ? 'Thêm danh mục thành công!' : 'Thêm danh mục thất bại!');
            redirect('index.php?page=category');
        }
    }

    public function edit(): void
    {
        $id = intval($_GET['id'] ?? ($_POST['id'] ?? 0));
        if ($id <= 0) {
            set_flash('error', 'ID danh mục không hợp lệ!');
            redirect('index.php?page=category');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'description' => $_POST['description'] ?? '',
                'status' => intval($_POST['status'] ?? 1)
            ];

            // Xử lý upload hình ảnh nếu có
            if (!empty($_FILES['thumbnail']['name'])) {
                $upload = handle_file_upload();
                if ($upload !== '') {
                    $data['thumbnail'] = $upload;
                }
            }

            $success = $this->model->update($id, $data);
            set_flash($success ? 'success' : 'error', $success ? 'Cập nhật danh mục thành công!' : 'Cập nhật danh mục thất bại!');
            redirect('index.php?page=category');
        }

        $category = $this->model->get_by_id($id);
        if (!$category) {
            set_flash('error', 'Danh mục không tồn tại!');
            redirect('index.php?page=category');
        }

        $this->data['category'] = $category;
    }

    public function soft_delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            if ($id <= 0) {
                set_flash('error', 'ID danh mục không hợp lệ!');
            } else {
                // Kiểm tra xem danh mục có sản phẩm không trước khi xóa (nếu cần)
                if (class_exists('ProductModel')) {
                    $product_model = new ProductModel();
                    $count = $product_model->count_products($id);
                    if ($count > 0) {
                        set_flash('error', 'Không thể xóa danh mục vì còn chứa ' . $count . ' sản phẩm!');
                        redirect('index.php?page=category');
                    }
                }
                
                $success = $this->model->soft_delete($id);
                set_flash($success ? 'success' : 'error', $success ? 'Xóa danh mục thành công!' : 'Xóa danh mục thất bại!');
            }
        }
        redirect('index.php?page=category');
    }

    public function toggle_status(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            $status = intval($_POST['status'] ?? 1);
            if ($id > 0) {
                $this->model->toggle_status($id, $status);
            }
        }
        redirect('index.php?page=category');
    }

    public function getData(): array
    {
        return $this->data;
    }
}