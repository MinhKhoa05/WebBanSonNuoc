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
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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
        
        .post-content h2, .post-content h3 {
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
        
        .fb-bg { background-color: #3b5998; }
        .tw-bg { background-color: #1da1f2; }
        .pin-bg { background-color: #bd081c; }
        .wa-bg { background-color: #25d366; }
        .email-bg { background-color: #777; }
    </style>
</head>

<body>
    <!-- Post Header -->
    <header class="post-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <?php
                    require_once __DIR__ . '/../../../models/post.php';
                    // Lấy ID từ query string
                    $post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
                    
                    // Lấy thông tin bài viết
                    $post = post_select_by_id($post_id);
                    
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
                        <span class="me-3"><i class="far fa-calendar-alt me-1"></i> <?= date("d/m/Y", strtotime($post['created_at'] ?? date("Y-m-d"))) ?></span>
                        <span class="me-3"><i class="far fa-user me-1"></i> Admin</span>
                        <span><i class="far fa-eye me-1"></i> <?= rand(50, 500) ?> lượt xem</span>
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
                <div class="col-lg-8">
                    <!-- Featured Image -->
                    <img src="uploads/<?= htmlspecialchars($post['thumbnail']) ?>" 
                         alt="<?= htmlspecialchars($post['title']) ?>" 
                         class="img-fluid post-featured-img mb-4 w-100">
                    
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
                            <a href="#" class="fb-bg"><i class="fab fa-facebook-f"></i></a>
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
                            <p class="mb-0">Với hơn 10 năm kinh nghiệm trong lĩnh vực sơn và trang trí nội thất, chúng tôi mang đến những kiến thức và hướng dẫn chi tiết nhất cho bạn.</p>
                        </div>
                    </div>
                    
                    <!-- Comments Section -->
                    <div class="comments-section mt-5">
                        <h4 class="mb-4">Bình luận (3)</h4>
                        
                        <!-- Comment 1 -->
                        <div class="comment-item d-flex mb-4">
                            <img src="/api/placeholder/50/50" alt="User" class="comment-avatar me-3">
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="mb-0">Nguyễn Văn A</h6>
                                    <small class="text-muted">2 ngày trước</small>
                                </div>
                                <p class="mb-1">Bài viết rất hay và chi tiết. Tôi đã áp dụng thành công cho căn nhà của mình. Cảm ơn tác giả!</p>
                                <button class="btn btn-sm btn-light">Trả lời</button>
                            </div>
                        </div>
                        
                        <!-- Comment 2 -->
                        <div class="comment-item d-flex mb-4">
                            <img src="/api/placeholder/50/50" alt="User" class="comment-avatar me-3">
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="mb-0">Trần Thị B</h6>
                                    <small class="text-muted">1 tuần trước</small>
                                </div>
                                <p class="mb-1">Cho hỏi loại sơn này có thể sử dụng cho tường ngoại thất không ạ?</p>
                                <button class="btn btn-sm btn-light">Trả lời</button>
                                
                                <!-- Reply to Comment 2 -->
                                <div class="comment-reply ms-5 mt-3 d-flex">
                                    <img src="/api/placeholder/50/50" alt="Admin" class="comment-avatar me-3" style="width: 40px; height: 40px;">
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <h6 class="mb-0">Admin</h6>
                                            <small class="text-muted">5 ngày trước</small>
                                        </div>
                                        <p class="mb-1">Chào bạn, loại sơn này có thể sử dụng cho cả nội thất và ngoại thất. Tuy nhiên, với ngoại thất bạn nên chọn dòng chuyên dụng để đảm bảo độ bền màu.</p>
                                        <button class="btn btn-sm btn-light">Trả lời</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Comment 3 -->
                        <div class="comment-item d-flex">
                            <img src="/api/placeholder/50/50" alt="User" class="comment-avatar me-3">
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="mb-0">Lê Văn C</h6>
                                    <small class="text-muted">2 tuần trước</small>
                                </div>
                                <p class="mb-1">Cần tư vấn thêm về giá cả và địa chỉ mua sản phẩm thì liên hệ theo số nào vậy admin?</p>
                                <button class="btn btn-sm btn-light">Trả lời</button>
                            </div>
                        </div>
                        
                        <!-- Comment Form -->
                        <div class="comment-form mt-5">
                            <h5 class="mb-4">Để lại bình luận</h5>
                            <form>
                                <div class="row mb-3">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <input type="text" class="form-control" placeholder="Họ tên">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" rows="4" placeholder="Nội dung bình luận"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary px-4">Gửi bình luận</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Search Widget -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Tìm kiếm</h5>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Tìm kiếm...">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Categories Widget -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Danh mục</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Hướng dẫn sử dụng
                                    <span class="badge rounded-pill bg-primary">14</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Kỹ thuật sơn
                                    <span class="badge rounded-pill bg-primary">8</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Xu hướng màu sắc
                                    <span class="badge rounded-pill bg-primary">9</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Dự án tham khảo
                                    <span class="badge rounded-pill bg-primary">12</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Mẹo vặt
                                    <span class="badge rounded-pill bg-primary">10</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Popular Posts Widget -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Bài viết phổ biến</h5>
                            
                            <?php
                            // Giả sử chúng ta có các bài viết phổ biến (thường sẽ lấy từ database)
                            $popular_posts = array_slice($posts ?? [], 0, 4);
                            
                            foreach ($popular_posts as $pop_post):
                            ?>
                            <div class="d-flex mb-3">
                                <img src="../../../uploads/<?= htmlspecialchars($pop_post['thumbnail']) ?>" 
                                     alt="<?= htmlspecialchars($pop_post['title']) ?>" 
                                     class="rounded" style="width: 70px; height: 70px; object-fit: cover;">
                                <div class="ms-3">
                                    <a href="post.php?id=<?= $pop_post['id'] ?>" class="text-decoration-none fw-bold text-dark">
                                        <?= htmlspecialchars(mb_substr($pop_post['title'], 0, 60)) ?>...
                                    </a>
                                    <p class="text-muted small mb-0 mt-1">
                                        <i class="far fa-calendar-alt me-1"></i> 
                                        <?= date("d/m/Y", strtotime($pop_post['created_at'] ?? date("Y-m-d"))) ?>
                                    </p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <!-- Tags Widget -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Tags</h5>
                            <div>
                                <a href="#" class="badge bg-light text-dark text-decoration-none mb-2 me-2 p-2">Sơn nước</a>
                                <a href="#" class="badge bg-light text-dark text-decoration-none mb-2 me-2 p-2">Sơn dầu</a>
                                <a href="#" class="badge bg-light text-dark text-decoration-none mb-2 me-2 p-2">Sơn epoxy</a>
                                <a href="#" class="badge bg-light text-dark text-decoration-none mb-2 me-2 p-2">Sơn chống thấm</a>
                                <a href="#" class="badge bg-light text-dark text-decoration-none mb-2 me-2 p-2">Sơn nội thất</a>
                                <a href="#" class="badge bg-light text-dark text-decoration-none mb-2 me-2 p-2">Sơn ngoại thất</a>
                                <a href="#" class="badge bg-light text-dark text-decoration-none mb-2 me-2 p-2">Màu sắc</a>
                                <a href="#" class="badge bg-light text-dark text-decoration-none mb-2 me-2 p-2">Không gian</a>
                                <a href="#" class="badge bg-light text-dark text-decoration-none mb-2 me-2 p-2">Trang trí</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Newsletter Widget -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Đăng ký nhận tin</h5>
                            <p class="card-text">Nhận thông báo khi có bài viết mới về hướng dẫn sử dụng sơn</p>
                            <form>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Email của bạn">
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Đăng ký ngay</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Related Posts -->
            <div class="related-posts mt-5">
                <h3 class="mb-4">Bài viết liên quan</h3>
                <div class="row">
                    <?php
                    // Giả sử chúng ta có các bài viết liên quan (thường sẽ lấy từ database)
                    $related_posts = array_slice($posts ?? [], 0, 3);
                    
                    foreach ($related_posts as $rel_post):
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card related-post-card h-100 shadow-sm">
                            <img src="../../../uploads/<?= htmlspecialchars($rel_post['thumbnail']) ?>" 
                                 class="card-img-top" alt="<?= htmlspecialchars($rel_post['title']) ?>"
                                 style="height: 180px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="post.php?id=<?= $rel_post['id'] ?>" class="text-decoration-none text-dark">
                                        <?= htmlspecialchars(mb_substr($rel_post['title'], 0, 60)) ?>...
                                    </a>
                                </h5>
                                <p class="card-text text-muted">
                                    <?= mb_substr(strip_tags($rel_post['content']), 0, 80) ?>...
                                </p>
                                <a href="post.php?id=<?= $rel_post['id'] ?>" class="btn btn-sm btn-outline-primary">Đọc tiếp</a>
                            </div>
                            <div class="card-footer bg-white text-muted small">
                                <i class="far fa-calendar-alt me-1"></i> 
                                <?= date("d/m/Y", strtotime($rel_post['created_at'] ?? date("Y-m-d"))) ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
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