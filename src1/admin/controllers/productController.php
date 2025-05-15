<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/ProductModel.php';
require_once __DIR__ . '/../models/CategoryModel.php';

class ProductController
{
    private ProductModel $model;
    private CategoryModel $category_model;
    private array $data = [];

    public function __construct()
    {
        $this->model = new ProductModel();
        $this->category_model = new CategoryModel();
    }

    public function index(): void
    {
        $this->data['products'] = $this->model->get_all();
        $this->data['categories'] = $this->category_model->get_all();
    }

    public function add(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'description' => $_POST['description'] ?? '',
                'price' => floatval($_POST['price'] ?? 0),
                'discount' => floatval($_POST['discount'] ?? 0),
                'stock' => intval($_POST['stock'] ?? 0),
                'status' => $_POST['status'] ?? 'inactive',
                'category_id' => intval($_POST['category_id'] ?? 0),
                'thumbnail' => $this->handle_upload()
            ];

            $success = $this->model->insert($data);
            if ($success) {
                $_SESSION['flash_message'] = ['type' => 'success', 'text' => 'Thêm sản phẩm thành công!'];
            } else {
                $_SESSION['flash_message'] = ['type' => 'error', 'text' => 'Thêm sản phẩm thất bại!'];
            }
            $this->redirect_to_product();
        }

        $this->data['categories'] = $this->category_model->get_all();
    }

    public function edit(): void
    {
        $id = intval($_GET['id'] ?? ($_POST['id'] ?? 0));
        if ($id <= 0) {
            $_SESSION['flash_message'] = ['type' => 'error', 'text' => 'ID sản phẩm không hợp lệ!'];
            $this->redirect_to_product();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'description' => $_POST['description'] ?? '',
                'price' => floatval($_POST['price'] ?? 0),
                'discount' => floatval($_POST['discount'] ?? 0),
                'stock' => intval($_POST['stock'] ?? 0),
                'status' => $_POST['status'] ?? 'inactive',
                'category_id' => intval($_POST['category_id'] ?? 0),
            ];

            if (!empty($_FILES['thumbnail']['name'])) {
                $upload = $this->handle_upload();
                if ($upload !== '') $data['thumbnail'] = $upload;
            }

            $success = $this->model->update($id, $data);
            if ($success) {
                $_SESSION['flash_message'] = ['type' => 'success', 'text' => 'Cập nhật sản phẩm thành công!'];
            } else {
                $_SESSION['flash_message'] = ['type' => 'error', 'text' => 'Cập nhật sản phẩm thất bại!'];
            }
            $this->redirect_to_product();
        }

        $product = $this->model->get_by_id($id);
        if (!$product) {
            $_SESSION['flash_message'] = ['type' => 'error', 'text' => 'Sản phẩm không tồn tại!'];
            $this->redirect_to_product();
        }

        $this->data['product'] = $product;
        $this->data['categories'] = $this->category_model->get_all();
    }

    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            if ($id <= 0) {
                $_SESSION['flash_message'] = ['type' => 'error', 'text' => 'ID sản phẩm không hợp lệ!'];
            } else {
                $success = $this->model->delete($id);
                if ($success) {
                    $_SESSION['flash_message'] = ['type' => 'success', 'text' => 'Xóa sản phẩm thành công!'];
                } else {
                    $_SESSION['flash_message'] = ['type' => 'error', 'text' => 'Xóa sản phẩm thất bại!'];
                }
            }
        }
        $this->redirect_to_product();
    }

    private function redirect_to_product(): void
    {
        header("Location: index.php?page=product");
        exit;
    }

    private function handle_upload(): string
    {
        $uploadDir = __DIR__ . '/../../uploads/';
        if (!file_exists($uploadDir)) mkdir($uploadDir, 0755, true);

        $file = $_FILES['thumbnail'] ?? null;
        if (!$file || $file['error'] !== UPLOAD_ERR_OK) return '';

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $fileMime = mime_content_type($file['tmp_name']);
        if (!in_array($fileMime, $allowedTypes)) return '';

        $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedExt)) return '';

        $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', basename($file['name']));
        $targetFile = $uploadDir . $fileName;

        return move_uploaded_file($file['tmp_name'], $targetFile) ? $fileName : '';
    }

    public function getData(): array
    {
        return $this->data;
    }
}
