<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/PostModel.php';
require_once __DIR__ . '/../models/CategoryModel.php';
require_once __DIR__ . '/../helpers/Common.php';

class PostController
{
    private PostModel $model;
    private CategoryModel $category_model;
    private array $data = [];

    public function __construct()
    {
        $this->model = new PostModel();
        $this->category_model = new CategoryModel();
    }

    public function index(): void
    {
        $posts = $this->model->get_all();
        $this->data['posts'] = $posts;
        $this->data['categories'] = $this->category_model->get_all();
    }

    public function add(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'] ?? '',
                'content' => $_POST['content'] ?? '',
                'category_id' => intval($_POST['category_id'] ?? 0),
                'category' => $_POST['category'] ?? 'news',
                'status' => $_POST['status'] ?? 'draft',
                'thumbnail' => handle_file_upload()
            ];

            $success = $this->model->insert($data);
            set_flash($success ? 'success' : 'error', $success ? 'Thêm bài viết thành công!' : 'Thêm bài viết thất bại!');
            redirect('index.php?page=post');
        }

        $this->data['categories'] = $this->category_model->get_all();
    }

    public function edit(): void
    {
        $id = intval($_GET['id'] ?? ($_POST['id'] ?? 0));
        if ($id <= 0) {
            set_flash('error', 'ID bài viết không hợp lệ!');
            redirect('index.php?page=post');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'] ?? '',
                'content' => $_POST['content'] ?? '',
                'category_id' => intval($_POST['category_id'] ?? 0),
                'category' => $_POST['category'] ?? 'news',
                'status' => $_POST['status'] ?? 'draft',
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if (!empty($_FILES['thumbnail']['name'])) {
                $upload = handle_file_upload();
                if ($upload !== '') {
                    $data['thumbnail'] = $upload;
                }
            }

            $success = $this->model->update($id, $data);
            set_flash($success ? 'success' : 'error', $success ? 'Cập nhật bài viết thành công!' : 'Cập nhật bài viết thất bại!');
            redirect('index.php?page=post');
        }

        $post = $this->model->get_by_id($id);
        if (!$post) {
            set_flash('error', 'Bài viết không tồn tại!');
            redirect('index.php?page=post');
        }

        $this->data['post'] = $post;
        $this->data['categories'] = $this->category_model->get_all();
    }

    public function soft_delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            if ($id <= 0) {
                set_flash('error', 'ID bài viết không hợp lệ!');
            } else {
                $success = $this->model->soft_delete($id);
                set_flash($success ? 'success' : 'error', $success ? 'Xóa bài viết thành công!' : 'Xóa bài viết thất bại!');
            }
        }
        redirect('index.php?page=post');
    }

    public function change_status(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            $status = $_POST['status'] ?? 'draft';
            if ($id > 0) {
                $this->model->change_status($id, $status);
            }
        }
        redirect('index.php?page=post');
    }

    public function get_data(): array
    {
        return $this->data;
    }
}