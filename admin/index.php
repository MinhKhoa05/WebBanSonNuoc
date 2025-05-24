<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra đăng nhập
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

require_once 'routes.php';
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin - Quản Lý Sơn Nước</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <link rel="stylesheet" href="views/assets/css/admin.css" />

    <style>
        .sidebar {
            min-height: 100vh;
            position: fixed;
            width: 250px;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="sidebar bg-light">
        <?php include __DIR__ . '/views/layout/sidebar.php'; ?>
    </div>

    <div class="main-content">
        <?php include __DIR__ . '/views/layout/topbar.php'; ?>

        <div class="content-area mt-3">
            <?php
            $viewFile = __DIR__ . "/views/pages/{$page}.php";
            if (file_exists($viewFile) && is_file($viewFile)) {
                include $viewFile;
            } else {
                include __DIR__ . "/views/pages/404.php";
            }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</body>

</html>

<?php if (isset($_SESSION['flash_message'])): ?>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
      icon: '<?= $_SESSION['flash_message']['type'] ?>',
      title: 'Thông báo',
      text: '<?= addslashes($_SESSION['flash_message']['text']) ?>',
      timer: 2500,
      showConfirmButton: false,
    });
  });
</script>
<?php unset($_SESSION['flash_message']); endif; ?>
