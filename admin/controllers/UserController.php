<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../helpers/Common.php';

class UserController
{
    private UserModel $model;
    private array $data = [];

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function index(): void
    {
        $users = $this->model->get_all();
        $this->data['users'] = $users;
    }

    public function get_data(): array
    {
        return $this->data;
    }

    public function admin_login(): void
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->model->admin_login($email, $password);

        if ($user !== null) {
            $_SESSION['user'] = $user;
            $_SESSION['flash_message'] = ['type' => 'success', 'text' => 'Đăng nhập thành công!'];
            header('Location: index.php');
            exit;
        } else {
            $_SESSION['flash_message'] = ['type' => 'error', 'text' => 'Tài khoản hoặc mật khẩu sai, hoặc không có quyền!'];
            header('Location: login.php');
            exit;
        }
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: login.php');
        exit;
    }
}