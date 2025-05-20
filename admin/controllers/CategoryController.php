<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

        // foreach ($categories as &$category) {
        //     $category['product_count'] = $this->model->count_products($category['id']);
        // }

        $this->data['categories'] = $categories;
    }

    public function add(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');

            if ($name === '') {
                set_flash('error', 'Tên danh mục không được để trống!');
                redirect('index.php?page=product');
            }

            // Kiểm tra trùng tên
            if ($this->model->exists_by_name($name)) {
                set_flash('error', 'Tên danh mục đã tồn tại, vui lòng chọn tên khác!');
                redirect('index.php?page=product');
            }

            $data = ['name' => $name];
            $success = $this->model->insert($data);
            set_flash($success ? 'success' : 'error', $success ? 'Thêm danh mục thành công!' : 'Thêm danh mục thất bại!');
            redirect('index.php?page=product');
        }
    }

    public function edit(): void
    {
        $id = intval($_GET['id'] ?? ($_POST['id'] ?? 0));
        if ($id <= 0) {
            set_flash('error', 'ID danh mục không hợp lệ!');
            redirect('index.php?page=product');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');

            if ($name === '') {
                set_flash('error', 'Tên danh mục không được để trống!');
                redirect('index.php?page=product');
            }

            // Kiểm tra trùng tên, bỏ qua chính bản ghi đang sửa
            if ($this->model->exists_by_name($name, $id)) {
                set_flash('error', 'Tên danh mục đã tồn tại, vui lòng chọn tên khác!');
                redirect('index.php?page=product');
            }

            $data = ['name' => $name];
            $success = $this->model->update($id, $data);
            set_flash($success ? 'success' : 'error', $success ? 'Cập nhật danh mục thành công!' : 'Cập nhật danh mục thất bại!');
            redirect('index.php?page=product');
        }

        $category = $this->model->get_by_id($id);
        if (!$category) {
            set_flash('error', 'Danh mục không tồn tại!');
            redirect('index.php?page=product');
        }

        $this->data['category'] = $category;
    }

    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            if ($id <= 0) {
                set_flash('error', 'ID danh mục không hợp lệ!');
            } else {
                // Kiểm tra xem còn sản phẩm thuộc danh mục này không
                $productCount = $this->model->count_products($id);
                if ($productCount > 0) {
                    set_flash('error', "Danh mục này còn $productCount sản phẩm, không thể xóa!");
                } else {
                    $success = $this->model->delete($id);
                    set_flash($success ? 'success' : 'error', $success ? 'Xóa danh mục thành công!' : 'Xóa danh mục thất bại!');
                }
            }
        }
        redirect('index.php?page=product');
    }

    // public function toggle_status(): void
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $id = intval($_POST['id'] ?? 0);
    //         $status = intval($_POST['status'] ?? 1);
    //         if ($id > 0) {
    //             $this->model->toggle_status($id, $status);
    //         }
    //     }
    //     redirect('index.php?page=category');
    // }

    // public function get_data(): array
    // {
    //     return $this->data;
    // }
}