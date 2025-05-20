<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/ProductModel.php';
require_once __DIR__ . '/../models/BrandModel.php';
require_once __DIR__ . '/../models/CategoryModel.php';
require_once __DIR__ . '/../helpers/Common.php';

class ProductController
{
    private ProductModel $model;
    private CategoryModel $category_model;
    private BrandModel $brand_model; // Add this line
    private array $data = [];

    public function __construct()
    {
        $this->model = new ProductModel();
        $this->category_model = new CategoryModel();
        $this->brand_model = new BrandModel(); // Add this line
    }

    public function index(): void
    {
        // Mặc định hiển thị danh sách sản phẩm
        $products = $this->model->get_all();
        $categories = $this->category_model->get_all();
        $brands = $this->brand_model->get_all();

        // Gom sản phẩm theo danh mục
        $productsByCategory = [];
        foreach ($categories as $category) {
            $categoryId = $category['id'];
            $products = $this->model->get_by_category($categoryId);

            // Tính giá sau giảm cho từng sản phẩm
            foreach ($products as &$product) {
                $price = floatval($product['price']);
                $discount = floatval($product['discount']);
                $product['final_price'] = max($price - ($price * $discount / 100), 0);
            }
            unset($product);

            $productsByCategory[$categoryId] = [
                'category_name' => $category['name'],
                'products' => $products,
            ];
        }
        
        $this->data['categories'] = $categories;
        $this->data['brands'] = $brands;
        $this->data['products_by_category'] = $productsByCategory;
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
                'category_id' => intval($_POST['category_id'] ?? 0),
                'brand_id' => intval($_POST['brand_id'] ?? 0), // Add this line
                'thumbnail' => handle_file_upload()
            ];

            $success = $this->model->insert($data);
            set_flash($success ? 'success' : 'error', $success ? 'Thêm sản phẩm thành công!' : 'Thêm sản phẩm thất bại!');
            redirect('index.php?page=product');
        }

        $this->data['categories'] = $this->category_model->get_all();
        $this->data['brands'] = $this->brand_model->get_all(); // Add this line
    }

    public function edit(): void
    {
        $id = intval($_GET['id'] ?? ($_POST['id'] ?? 0));
        if ($id <= 0) {
            set_flash('error', 'ID sản phẩm không hợp lệ!');
            redirect('index.php?page=product');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'description' => $_POST['description'] ?? '',
                'price' => floatval($_POST['price'] ?? 0),
                'discount' => floatval($_POST['discount'] ?? 0),
                'stock' => intval($_POST['stock'] ?? 0),
                'category_id' => intval($_POST['category_id'] ?? 0),
                'brand_id' => intval($_POST['brand_id'] ?? 0), // Add this line
            ];

            if (!empty($_FILES['thumbnail']['name'])) {
                $upload = handle_file_upload();
                if ($upload !== '') {
                    $data['thumbnail'] = $upload;
                }
            }

            $success = $this->model->update($id, $data);
            set_flash($success ? 'success' : 'error', $success ? 'Cập nhật sản phẩm thành công!' : 'Cập nhật sản phẩm thất bại!');
            redirect('index.php?page=product');
        }

        $product = $this->model->get_by_id($id);
        if (!$product) {
            set_flash('error', 'Sản phẩm không tồn tại!');
            redirect('index.php?page=product');
        }

        $this->data['product'] = $product;
        $this->data['categories'] = $this->category_model->get_all();
        $this->data['brands'] = $this->brand_model->get_all(); // Add this line
    }

    public function soft_delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            if ($id <= 0) {
                set_flash('error', 'ID sản phẩm không hợp lệ!');
            } else {
                $success = $this->model->soft_delete($id);
                set_flash($success ? 'success' : 'error', $success ? 'Xóa sản phẩm thành công!' : 'Xóa sản phẩm thất bại!');
            }
        }
        redirect('index.php?page=product');
    }

    public function toggle_view(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            $view = intval($_POST['view'] ?? 1);
            if ($id > 0) {
                $this->model->toggle_view($id, $view);
            }
        }
        redirect('index.php?page=product');
    }

    public function get_data(): array
    {
        return $this->data;
    }

    public function trash(): void
    {
        $deletedProducts = $this->model->get_deleted_products();
        $this->data['deleted_products'] = $deletedProducts;
    }

    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            if ($id <= 0) {
                set_flash('error', 'ID sản phẩm không hợp lệ!');
            } else {
                $success = $this->model->delete($id);
                set_flash($success ? 'success' : 'error', $success ? 'Xóa sản phẩm thành công!' : 'Xóa sản phẩm thất bại!');
            }
        }
        redirect('index.php?page=product');
    }

    public function restore(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            if ($id <= 0) {
                set_flash('error', 'ID sản phẩm không hợp lệ!');
            } else {
                $success = $this->model->restore($id);
                set_flash($success ? 'success' : 'error', $success ? 'Đã khôi phục sản phẩm' : 'Khôi phục sản phẩm thất bại!');
            }
        }
        redirect('index.php?page=product');
    }
}