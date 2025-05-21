<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chi tiết bài viết - Hướng dẫn sử dụng sơn</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-brand i {
            color: #3498db;
            margin-right: 5px;
        }

        .post-header {
            background-color: #2c3e50;
            color: white;
            padding: 60px 0;
            position: relative;
        }

        .post-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 50px;
            background: linear-gradient(to bottom right, transparent 49%, white 50%);
        }

        .post-featured-img {
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .post-content {
            font-size: 1.1rem;
            line-height: 1.8;
        }

        .post-content img {
            max-width: 100%;
            height: auto;
            margin: 20px 0;
            border-radius: 8px;
        }

        .post-content h2,
        .post-content h3 {
            margin-top: 30px;
            margin-bottom: 15px;
        }

        .post-content p {
            margin-bottom: 20px;
        }

        .post-meta {
            font-size: 0.9rem;
        }

        .post-meta i {
            color: #3498db;
        }

        .author-box {
            background-color: #f1f2f6;
            border-radius: 8px;
        }

        .author-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
        }

        .related-post-card {
            transition: transform 0.3s;
            height: 100%;
        }

        .related-post-card:hover {
            transform: translateY(-5px);
        }

        .tag-badge {
            background-color: #e1f0ff;
            color: #3498db;
            font-weight: normal;
        }

        .comment-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .social-share a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            color: white;
            margin-right: 10px;
            transition: transform 0.3s;
        }

        .social-share a:hover {
            transform: translateY(-3px);
        }

        .fb-bg {
            background-color: #3b5998;
        }

        .tw-bg {
            background-color: #1da1f2;
        }

        .pin-bg {
            background-color: #bd081c;
        }

        .wa-bg {
            background-color: #25d366;
        }

        .email-bg {
            background-color: #777;
        }
    </style>
</head>

<body>
    <!-- Post Header -->
    <header class="post-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <?php
                    $post = $GLOBALS['post'] ?? null;

                    // Kiểm tra bài viết tồn tại
                    if (!$post) {
                        echo '<h1 class="fw-bold mb-3">Bài viết không tồn tại</h1>';
                        echo '<p class="lead">Bài viết bạn đang tìm kiếm không tồn tại hoặc đã bị xóa.</p>';
                        echo '<a href="index.php" class="btn btn-light mt-3">Quay lại trang chủ</a>';
                    } else {
                        ?>
                        <span class="badge bg-primary mb-3">Hướng dẫn sử dụng sơn</span>
                        <h1 class="fw-bold mb-3"><?= htmlspecialchars($post['title']) ?></h1>
                        <div class="post-meta text-white-50">
                            <span class="me-3"><i class="far fa-calendar-alt me-1"></i>
                                <?= date("d/m/Y", strtotime($post['created_at'] ?? date("Y-m-d"))) ?></span>
                            <span class="me-3"><i class="far fa-user me-1"></i> Admin</span>
                            <!-- <span><i class="far fa-eye me-1"></i> <?= rand(50, 500) ?> lượt xem</span> -->
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-5">
        <div class="container">
            <?php if (isset($post) && $post): ?>
                <div class="row">
                    <!-- Post Content Column -->
                    <div class="col">
                        <!-- Featured Image -->
                        <img src="/WebBanSonNuoc/uploads/<?= htmlspecialchars($post['thumbnail']) ?>"
                            alt="<?= htmlspecialchars($post['title']) ?>" class="img-fluid post-featured-img mb-4 w-100">

                        <!-- Tags -->
                        <div class="mb-4">
                            <span class="badge tag-badge me-2">Sơn nước</span>
                            <span class="badge tag-badge me-2">Hướng dẫn</span>
                            <span class="badge tag-badge me-2">Trang trí</span>
                        </div>

                        <!-- Post Content -->
                        <div class="post-content">
                            <?= $post['content'] ?>
                        </div>

                        <!-- Social Share -->
                        <div class="social-share mt-5 pt-4 border-top">
                            <h5 class="mb-3">Chia sẻ bài viết này:</h5>
                            <div>
                                <a href="https://www.facebook.com/honguyen.minhkhoa/?locale=vi_VN" class="fb-bg"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="tw-bg"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="pin-bg"><i class="fab fa-pinterest-p"></i></a>
                                <a href="#" class="wa-bg"><i class="fab fa-whatsapp"></i></a>
                                <a href="#" class="email-bg"><i class="far fa-envelope"></i></a>
                            </div>
                        </div>

                        <!-- Author Box -->
                        <div class="author-box p-4 mt-5 d-flex align-items-center">
                            <img src="/api/placeholder/80/80" alt="Author" class="author-img me-4">
                            <div>
                                <h5>Admin</h5>
                                <p class="mb-2 text-muted">Chuyên gia tư vấn sơn</p>
                                <p class="mb-0">Với hơn 10 năm kinh nghiệm trong lĩnh vực sơn và trang trí nội thất, chúng
                                    tôi mang đến những kiến thức và hướng dẫn chi tiết nhất cho bạn.</p>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <div class="display-1 text-muted mb-4"><i class="fas fa-exclamation-circle"></i></div>
                        <h2>Không tìm thấy bài viết</h2>
                        <p class="lead">Rất tiếc, bài viết bạn đang tìm không tồn tại hoặc đã bị xóa.</p>
                        <a href="index.php" class="btn btn-primary">Quay lại trang chủ</a>
                    </div>
                <?php endif; ?>
            </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>