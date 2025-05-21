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

    public function index(): void
    {
        // Lấy tất cả đơn hàng
        $orders = $this->model->get_all();

        // Với mỗi đơn, lấy chi tiết sản phẩm và gán vào key 'items'
        foreach ($orders as &$order) {
            $orderId = $order['id'] ?? 0;
            if ($orderId > 0) {
                $order['items'] = $this->model->get_order_details($orderId);
            } else {
                $order['items'] = [];
            }
        }
        unset($order); // tránh tham chiếu ngoài ý muốn

        $this->data['orders'] = $orders;
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
