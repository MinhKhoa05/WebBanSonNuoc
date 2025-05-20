<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '/../models/ProductModel.php';
require_once __DIR__ . '/../models/BrandModel.php';
require_once __DIR__ . '/../models/CategoryModel.php';
require_once __DIR__ . '/../helpers/Common.php';

class ProductController
{
    private ProductModel $product_model;
    private CategoryModel $category_model;
    private BrandModel $brand_model;
    private array $data = [];

    public function __construct()
    {
        $this->product_model = new ProductModel();
        $this->category_model = new CategoryModel();
        $this->brand_model = new BrandModel();
    }

    public function index(): void
    {
        $categories = $this->category_model->get_all();
        $brands = $this->brand_model->get_all();

        $productsByCategory = array_reduce($categories, function ($result, $category) {
            $products = array_map(function ($product) {
                $price = floatval($product['price']);
                $discount = floatval($product['discount']);
                $product['final_price'] = max($price - ($price * $discount / 100), 0);
                return $product;
            }, $this->product_model->get_by_category($category['id']));

            $result[$category['id']] = [
                'category_name' => $category['name'],
                'products' => $products,
            ];
            return $result;
        }, []);

        $this->data = compact('categories', 'brands') + ['products_by_category' => $productsByCategory];
    }

    public function add(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->extract_product_data(true);
            $success = $this->product_model->insert($data);
            $this->set_result_flash($success, 'Thêm sản phẩm');
            // Sau khi xử lý POST -> dừng và redirect
            redirect('index.php?page=product');
        }

        $this->load_common_data();
    }

    public function edit(): void
    {
        $id = intval($_GET['id'] ?? ($_POST['id'] ?? 0));
        if ($id <= 0) {
            // ID không hợp lệ -> dừng và redirect
            $this->invalid_id_redirect();
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->extract_product_data(!empty($_FILES['thumbnail']['name']));
            $success = $this->product_model->update($id, $data);
            $this->set_result_flash($success, 'Cập nhật sản phẩm');
            // Dừng xử lý sau khi cập nhật
            redirect('index.php?page=product');
        }

        $product = $this->product_model->get_by_id($id);
        if (!$product) {
            // Không tìm thấy sản phẩm -> dừng và redirect
            $this->not_found_redirect('Sản phẩm');
            return;
        }

        // Nếu hợp lệ -> load dữ liệu hiển thị form
        $this->load_common_data();
        $this->data['product'] = $product;
    }

    public function soft_delete(): void { $this->process_post_action('soft_delete', 'Xóa sản phẩm'); }
    public function delete(): void { $this->process_post_action('delete', 'Xóa sản phẩm'); }
    public function restore(): void { $this->process_post_action('restore', 'Khôi phục sản phẩm'); }

    public function toggle_view(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            $view = intval($_POST['view'] ?? 1);
            if ($id > 0) {
                $this->product_model->toggle_view($id, $view);
            }
        }
        redirect('index.php?page=product');
    }

    public function trash(): void
    {
        $this->data['deleted_products'] = $this->product_model->get_deleted_products();
    }

    public function get_data(): array
    {
        return $this->data;
    }

    // --- CATEGORY METHODS ---

    public function category_add(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            if ($name === '') {
                // Tên trống -> dừng và redirect
                $this->set_flash_redirect('error', 'Tên danh mục không được để trống!');
                return;
            }

            if ($this->category_model->exists_by_name($name)) {
                // Trùng tên -> dừng và redirect
                $this->set_flash_redirect('error', 'Tên danh mục đã tồn tại!');
                return;
            }

            $success = $this->category_model->insert(['name' => $name]);
            $this->set_result_flash($success, 'Thêm danh mục');
            redirect('index.php?page=product');
        }
    }

    public function category_edit(): void
    {
        $id = intval($_GET['id'] ?? ($_POST['id'] ?? 0));
        if ($id <= 0) {
            // ID không hợp lệ -> dừng
            $this->invalid_id_redirect('danh mục');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            if ($name === '') {
                $this->set_flash_redirect('error', 'Tên danh mục không được để trống!');
                return;
            }

            if ($this->category_model->exists_by_name($name, $id)) {
                $this->set_flash_redirect('error', 'Tên danh mục đã tồn tại!');
                return;
            }

            $success = $this->category_model->update($id, ['name' => $name]);
            $this->set_result_flash($success, 'Cập nhật danh mục');
            redirect('index.php?page=product');
        }

        $category = $this->category_model->get_by_id($id);
        if (!$category) {
            // Không tìm thấy danh mục -> dừng
            $this->not_found_redirect('Danh mục');
            return;
        }

        $this->data['category'] = $category;
    }

    public function category_delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            if ($id <= 0) {
                $this->set_flash_redirect('error', 'ID danh mục không hợp lệ!');
                return;
            }

            $success = $this->category_model->delete($id);
            $this->set_result_flash($success, 'Xóa danh mục');
        }

        redirect('index.php?page=product');
    }

    // --- Private Helper Methods ---

    private function extract_product_data(bool $include_thumbnail = false): array
    {
        $data = [
            'name' => $_POST['name'] ?? '',
            'description' => $_POST['description'] ?? '',
            'price' => floatval($_POST['price'] ?? 0),
            'discount' => floatval($_POST['discount'] ?? 0),
            'stock' => intval($_POST['stock'] ?? 0),
            'category_id' => intval($_POST['category_id'] ?? 0),
            'brand_id' => intval($_POST['brand_id'] ?? 0),
        ];

        if ($include_thumbnail) {
            $upload = handle_file_upload();
            if ($upload !== '') $data['thumbnail'] = $upload;
        }

        return $data;
    }

    private function set_result_flash(bool $success, string $action): void
    {
        set_flash($success ? 'success' : 'error', $success ? "$action thành công!" : "$action thất bại!");
    }

    private function process_post_action(string $method, string $action): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            if ($id <= 0) {
                set_flash('error', "ID không hợp lệ!");
            } else {
                $success = $this->product_model->{$method}($id);
                $this->set_result_flash($success, $action);
            }
        }
        redirect('index.php?page=product');
    }

    private function set_flash_redirect(string $type, string $message): void
    {
        set_flash($type, $message);
        redirect('index.php?page=product');
    }

    private function invalid_id_redirect(string $type = 'sản phẩm'): void
    {
        // ID không hợp lệ -> hiển thị thông báo và dừng
        $this->set_flash_redirect('error', "ID $type không hợp lệ!");
    }

    private function not_found_redirect(string $type): void
    {
        // Không tìm thấy dữ liệu -> hiển thị thông báo và dừng
        $this->set_flash_redirect('error', "$type không tồn tại!");
    }

    private function load_common_data(): void
    {
        $this->data['categories'] = $this->category_model->get_all();
        $this->data['brands'] = $this->brand_model->get_all();
    }
}
