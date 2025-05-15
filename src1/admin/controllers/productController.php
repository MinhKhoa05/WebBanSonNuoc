<?php
require_once __DIR__ . '/../models/ProductModel.php';
require_once __DIR__ . '/../models/CategoryModel.php';

class ProductController
{
    private $model;
    private $category_model;
    private $data = [];

    public function __construct()
    {
        $this->model = new ProductModel();
        $this->category_model = new CategoryModel();
    }

    public function index()
    {
        $this->data['products'] = $this->model->getAll();
        $this->data['categories'] = $this->category_model->get_all();
    }

    public function add()
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

            $this->model->insert($data);
            header("Location: index.php?page=product");
            exit;
        }

        // Nếu GET thì vẫn load danh mục để hiển thị trong form thêm
        $this->data['categories'] = $this->category_model->get_all();
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            if ($id <= 0) {
                header("Location: index.php?page=product");
                exit;
            }

            $data = [
                'name' => $_POST['name'] ?? '',
                'description' => $_POST['description'] ?? '',
                'price' => floatval($_POST['price'] ?? 0),
                'discount' => floatval($_POST['discount'] ?? 0),
                'stock' => intval($_POST['stock'] ?? 0),
                'status' => $_POST['status'] ?? 'inactive',
                'category_id' => intval($_POST['category_id'] ?? 0),
            ];

            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
                $uploadedFile = $this->handle_upload();
                if ($uploadedFile !== '') {
                    $data['thumbnail'] = $uploadedFile;
                }
            }

            $this->model->update($id, $data);
            header("Location: index.php?page=product");
            exit;
        }

        // Xử lý GET lấy dữ liệu để show form sửa
        $id = intval($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?page=product");
            exit;
        }

        $product = $this->model->getById($id);
        if (!$product) {
            header("Location: index.php?page=product");
            exit;
        }

        $this->data['product'] = $product;
        $this->data['categories'] = $this->category_model->get_all();
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            $this->model->delete($id);
            header("Location: index.php?page=product");
            exit;
        }
    }

    private function handle_upload(): string
    {
        $uploadDir = __DIR__ . '/../../uploads/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $file = $_FILES['thumbnail'];

        // Kiểm tra lỗi upload
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return '';
        }

        // Kiểm tra định dạng file ảnh
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $fileMime = mime_content_type($file['tmp_name']);
        if (!in_array($fileMime, $allowedTypes)) {
            return ''; // Không phải file hình ảnh hợp lệ
        }

        // Hoặc có thể kiểm tra đuôi file (extension)
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedExt)) {
            return '';
        }

        // Đặt tên file hợp lệ
        $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', basename($file['name']));
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            return $fileName;
        }

        return '';
    }

    public function getData()
    {
        return $this->data;
    }
}

?>