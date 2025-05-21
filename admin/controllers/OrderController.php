<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/OrderModel.php';
require_once __DIR__ . '/../helpers/Common.php';

class OrderController
{
    private OrderModel $model;
    private array $data = [];

    public function __construct()
    {
        $this->model = new OrderModel();
    }

    // Hiển thị danh sách đơn hàng
    public function index(): void
    {
        $orders = $this->model->get_all();
        $this->data['orders'] = $orders;
    }

    // Xem chi tiết đơn hàng
    public function view($id): void
    {
        if (!$id) {
            header('Location: index.php?page=order');
            exit;
        }

        // Lấy thông tin đơn hàng theo id
        $order = $this->model->get_by_id($id);
        if (!$order) {
            set_flash('error', 'Đơn hàng không tồn tại!');
            header('Location: index.php?page=order');
            exit;
        }

        // Lấy danh sách sản phẩm trong đơn
        $orderItems = $this->model->get_order_details($id);

        // Truyền dữ liệu ra view
        $this->data['order'] = $order;
        $this->data['orderItems'] = $orderItems;
        
        // Chỉ định view hiển thị thay vì include trực tiếp
        $this->data['view'] = 'orders/order_detail';
    }

    // Xóa mềm đơn hàng
    public function soft_delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            if ($id <= 0) {
                set_flash('error', 'ID đơn hàng không hợp lệ!');
            } else {
                $success = $this->model->soft_delete($id);
                set_flash($success ? 'success' : 'error', $success ? 'Xóa đơn hàng thành công!' : 'Xóa đơn hàng thất bại!');
            }
        }
        redirect('index.php?page=order');
    }

    // Cập nhật trạng thái đơn hàng (ví dụ pending, delivering, completed)
    public function update_status(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            $status = $_POST['status'] ?? '';
            if ($id > 0 && in_array($status, ['pending', 'delivering', 'completed'], true)) {
                $this->model->update_status($id, $status);
                set_flash('success', 'Cập nhật trạng thái đơn hàng thành công!');
            } else {
                set_flash('error', 'Dữ liệu không hợp lệ!');
            }
        }
        redirect('index.php?page=order');
    }

    // Lấy dữ liệu để render view
    public function get_data(): array
    {
        return $this->data;
    }
}