<?php
require_once __DIR__ . '/../models/SettingModel.php';

class SettingController {
    private $model;
    private $data = [];

    public function __construct() {
        $this->model = new SettingModel();
    }

    public function index() {
        $banners = $this->model->getBanners('customer_banner_', 8);
        $this->data['banners'] = $banners;
    }

    public function updateBanner() {
        for ($i = 1; $i <= 8; $i++) {
            $banner = '';
            // Xử lý upload ảnh trước
            if (isset($_FILES['banner_img_' . $i]) && $_FILES['banner_img_' . $i]['error'] == UPLOAD_ERR_OK) {
                $file = $_FILES['banner_img_' . $i];
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array($ext, $allowed)) {
                    // Đường dẫn tuyệt đối tới thư mục uploads ở gốc project
                    $uploadDir = dirname(__DIR__, 2) . '/uploads/';
                    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                    $filename = uniqid('banner_'.$i.'_') . '.' . $ext;
                    $target = $uploadDir . $filename;
                    // Debug đường dẫn upload
                    // echo "Đường dẫn upload: $uploadDir<br>";
                    // echo "File sẽ lưu tại: $target<br>";
                    if (move_uploaded_file($file['tmp_name'], $target)) {
                        $banner = $filename; // Chỉ lưu tên file vào DB
                        // echo "Đã upload file: $filename<br>";
                    } else {
                        echo "Không thể upload file. Kiểm tra quyền thư mục uploads!";
                        exit;
                    }
                }
            }
            // Nếu không upload ảnh thì lấy nội dung textarea
            if (empty($banner)) {
                $banner = trim($_POST['banner_' . $i] ?? '');
            }
            $this->model->updateByKey('customer_banner_' . $i, $banner);
        }
        header('Location: index.php?page=setting&success=1');
        exit;
    }

    public function get_data() {
        return $this->data;
    }
} 