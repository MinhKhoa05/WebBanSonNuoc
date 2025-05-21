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
    private array $data = [];

    public function __construct()
    {
        $this->model = new PostModel();
    }

    public function index(): void
    {
        $posts = $this->model->get_all();
        $this->data['posts'] = $posts;
    }

    public function add(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $slug = $this->toSlug($title);

            $data = [
                'title' => $title,
                'slug' => $slug,
                'content' => $_POST['content'] ?? '',
                'category' => $_POST['category'] ?? 'news',
                'status' => $_POST['status'] ?? 'draft',
                'thumbnail' => handle_file_upload()
            ];

            $success = $this->model->insert($data);
            set_flash($success ? 'success' : 'error', $success ? 'Thêm bài viết thành công!' : 'Thêm bài viết thất bại!');
            redirect('index.php?page=post');
        }
    }

    public function edit(): void
    {
        $id = intval($_GET['id'] ?? ($_POST['id'] ?? 0));
        if ($id <= 0) {
            set_flash('error', 'ID bài viết không hợp lệ!');
            redirect('index.php?page=post');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $slug = $this->toSlug($title);

            $data = [
                'title' => $title,
                'slug' => $slug,
                'content' => $_POST['content'] ?? '',
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
    }

    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id'] ?? 0);
            if ($id <= 0) {
                set_flash('error', 'ID bài viết không hợp lệ!');
            } else {
                $success = $this->model->delete($id);
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

    function toSlug(string $str): string
    {
        $str = mb_strtolower($str, 'UTF-8');
        $str = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $str);
        $str = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $str);
        $str = preg_replace('/[iíìỉĩị]/u', 'i', $str);
        $str = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $str);
        $str = preg_replace('/[úùủũụưứừửữự]/u', 'u', $str);
        $str = preg_replace('/[ýỳỷỹỵ]/u', 'y', $str);
        $str = preg_replace('/[đ]/u', 'd', $str);
        $str = preg_replace('/[^a-z0-9\s-]/', '', $str);
        $str = preg_replace('/[\s-]+/', '-', $str);
        return trim($str, '-');
    }
}