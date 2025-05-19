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

    // Thêm đơn hàng mới
    public function add(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'user_id' => intval($_POST['user_id'] ?? 0),
                'order_date' => $_POST['order_date'] ?? date('Y-m-d H:i:s'),
                'total' => floatval($_POST['total'] ?? 0),
                'status' => $_POST['status'] ?? 'pending',
                'note' => $_POST['note'] ?? null,
            ];

            $success = $this->model->insert($data);
            set_flash($success ? 'success' : 'error', $success ? 'Thêm đơn hàng thành công!' : 'Thêm đơn hàng thất bại!');
            redirect('index.php?page=order');
        }
    }

    // Sửa đơn hàng theo ID
    public function edit(): void
    {
        $id = intval($_GET['id'] ?? ($_POST['id'] ?? 0));
        if ($id <= 0) {
            set_flash('error', 'ID đơn hàng không hợp lệ!');
            redirect('index.php?page=order');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'user_id' => intval($_POST['user_id'] ?? 0),
                'order_date' => $_POST['order_date'] ?? date('Y-m-d H:i:s'),
                'total' => floatval($_POST['total'] ?? 0),
                'status' => $_POST['status'] ?? 'pending',
                'note' => $_POST['note'] ?? null,
            ];

            $success = $this->model->update($id, $data);
            set_flash($success ? 'success' : 'error', $success ? 'Cập nhật đơn hàng thành công!' : 'Cập nhật đơn hàng thất bại!');
            redirect('index.php?page=order');
        }

        $order = $this->model->get_by_id($id);
        if (!$order) {
            set_flash('error', 'Đơn hàng không tồn tại!');
            redirect('index.php?page=order');
        }

        $this->data['order'] = $order;
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
