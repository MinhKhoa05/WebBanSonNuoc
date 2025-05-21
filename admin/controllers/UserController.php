<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/CategoryModel.php';
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
}