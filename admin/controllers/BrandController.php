<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/BrandModel.php';
require_once __DIR__ . '/../helpers/Common.php';

class BrandController
{
    private BrandModel $model;
    private array $data = [];

    public function __construct()
    {
        $this->model = new BrandModel();
    }

    public function index(): void
    {
        $brands = $this->model->get_all();
        $this->data['brands'] = $brands;
    }

    public function add(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'description' => $_POST['description'] ?? '',
                'is_featured' => isset($_POST['is_featured']) ? 1 : 0
            ];

            // Upload thumbnail if exists
            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
                $upload_dir = 'uploads/brands/';
                
                // Create directory if it doesn't exist
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
                
                $file_name = time() . '_' . basename($_FILES['thumbnail']['name']);
                $target_file = $upload_dir . $file_name;
                
                if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target_file)) {
                    $data['thumbnail'] = $target_file;
                }
            }

            $success = $this->model->insert($data);
            set_flash($success ? 'success' : 'error', $success ? 'Thêm thương hiệu thành công!' : 'Thêm thương hiệu thất bại!');
            redirect('index.php?page=brand');
        }
    }

    public function edit(): void
    {
        $id = intval($_GET['id'] ?? ($_POST['id'] ?? 0));
        if ($id <= 0) {
            set_flash('error', 'ID thương hiệu không hợp lệ!');
            redirect('index.php?page=brand');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'description' => $_POST['description'] ?? '',
                'is_featured' => isset($_POST['is_featured']) ? 1 : 0
            ];

            // Upload thumbnail if exists
            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
                $upload_dir = 'uploads/brands/';
                
                // Create directory if it doesn't exist
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
                
                $file_name = time() . '_' . basename($_FILES['thumbnail']['name']);
                $target_file = $upload_dir . $file_name;
                
                // Get old thumbnail to delete
                $brand = $this->model->get_by_id($id);
                $old_thumbnail = $brand['thumbnail'] ?? '';
                
                if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target_file)) {
                    $data['thumbnail'] = $target_file;
                    
                    // Delete old thumbnail
                    if (!empty($old_thumbnail) && file_exists($old_thumbnail)) {
                        unlink($old_thumbnail);
                    }
                }
            }

            $success = $this->model->update($id, $data);
            set_flash($success ? 'success' : 'error', $success ? 'Cập nhật thương hiệu thành công!' : 'Cập nhật thương hiệu thất bại!');
            redirect('index.php?page=brand');
        }

        $brand = $this->model->get_by_id($id);
        if (!$brand) {
            set_flash('error', 'Thương hiệu không tồn tại!');
            redirect('index.php?page=brand');
        }

        $this->data['brand'] = $brand;
    }

    public function soft_delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            if ($id <= 0) {
                set_flash('error', 'ID thương hiệu không hợp lệ!');
            } else {
                $success = $this->model->delete($id);
                set_flash($success ? 'success' : 'error', $success ? 'Xóa thương hiệu thành công!' : 'Xóa thương hiệu thất bại!');
            }
        }
        redirect('index.php?page=brand');
    }

    public function toggle_featured(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            $is_featured = intval($_POST['is_featured'] ?? 0);
            if ($id > 0) {
                $this->model->toggle_featured($id, $is_featured);
            }
        }
        redirect('index.php?page=brand');
    }

    public function get_data(): array
    {
        return $this->data;
    }
}