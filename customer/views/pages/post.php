<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Tin tức - Hướng dẫn sử dụng sơn</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');

        :root {
            --primary-color: #3498db;
            --secondary-color: #e74c3c;
            --accent-color: #2ecc71;
            --dark-color: #2c3e50;
            --light-color: #ecf0f1;
            --shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4eaef 100%);
            color: #333;
            line-height: 1.6;
        }

        .header {
            background: linear-gradient(to right, var(--primary-color), #2980b9);
            color: white;
            padding: 40px 0;
            text-align: center;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('/api/placeholder/1000/300') center/cover no-repeat;
            opacity: 0.1;
            z-index: 0;
        }

        .header-content {
            position: relative;
            z-index: 1;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .subtitle {
            font-size: 1.2rem;
            font-weight: 300;
            margin-bottom: 20px;
        }

        .search-bar {
            display: flex;
            max-width: 500px;
            margin: 20px auto 0;
            border-radius: 50px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .search-input {
            width: 85%;
            padding: 15px 20px;
            border: none;
            font-size: 1rem;
        }

        .search-btn {
            width: 15%;
            background: var(--dark-color);
            border: none;
            color: white;
            cursor: pointer;
            transition: var(--transition);
        }

        .search-btn:hover {
            background: var(--secondary-color);
        }

        .categories {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin: 30px 0;
        }

        .category-btn {
            padding: 8px 15px;
            background: white;
            border: none;
            border-radius: 20px;
            color: var(--dark-color);
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .category-btn:hover,
        .category-btn.active {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .main-content {
            padding: 40px 0;
        }

        .posts-container {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .news-item {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            display: flex;
            flex-direction: row;
        }

        .news-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .news-item-reverse {
            flex-direction: row-reverse;
        }

        .news-thumb {
            flex: 0 0 40%;
            overflow: hidden;
            position: relative;
        }

        .news-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .news-item:hover .news-thumb img {
            transform: scale(1.05);
        }

        .news-content {
            flex: 0 0 60%;
            padding: 25px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .news-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 10px;
            font-size: 0.9rem;
            color: #666;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .news-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--dark-color);
            text-decoration: none;
            transition: var(--transition);
            line-height: 1.3;
        }

        .news-title:hover {
            color: var(--primary-color);
        }

        .news-desc {
            font-size: 1rem;
            color: #555;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .read-more {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-weight: 600;
            color: var(--primary-color);
            text-decoration: none;
            transition: var(--transition);
            margin-top: auto;
        }

        .read-more:hover {
            color: var(--secondary-color);
            gap: 10px;
        }

        .tag {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-right: 5px;
            margin-bottom: 5px;
            background: var(--light-color);
            color: var(--dark-color);
        }

        .featured-label {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--secondary-color);
            color: white;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            z-index: 1;
        }

        .footer {
            background: var(--dark-color);
            color: white;
            padding: 40px 0;
            text-align: center;
        }

        .newsletter {
            max-width: 500px;
            margin: 0 auto 30px;
        }

        .newsletter h3 {
            margin-bottom: 15px;
        }

        .newsletter-form {
            display: flex;
            overflow: hidden;
            border-radius: 30px;
        }

        .newsletter-input {
            flex: 1;
            padding: 12px 20px;
            border: none;
        }

        .newsletter-btn {
            padding: 0 20px;
            background: var(--primary-color);
            color: white;
            border: none;
            cursor: pointer;
            transition: var(--transition);
        }

        .newsletter-btn:hover {
            background: var(--secondary-color);
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 20px 0;
        }

        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            text-decoration: none;
            transition: var(--transition);
        }

        .social-link:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
        }

        .copyright {
            font-size: 0.9rem;
            opacity: 0.7;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin-top: 40px;
        }

        .page-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 5px;
            background: white;
            border: 1px solid #ddd;
            color: var(--dark-color);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .page-btn:hover,
        .page-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        /* Responsive */
        @media (max-width: 768px) {

            .news-item,
            .news-item-reverse {
                flex-direction: column;
            }

            .news-thumb {
                flex: 0 0 200px;
            }

            h1 {
                font-size: 2rem;
            }

            .search-input {
                padding: 12px 15px;
            }

            .pagination {
                gap: 3px;
            }

            .page-btn {
                width: 35px;
                height: 35px;
            }
        }
    </style>
</head>

<body class="mt-4">
    <header class="header">
        <div class="header-content">
            <div class="container">
                <h1>Tin Tức & Hướng Dẫn Sử Dụng Sơn</h1>
                <p class="subtitle">Khám phá các bài viết chuyên sâu và hướng dẫn chi tiết về sơn</p>
                <div class="search-bar">
                    <input type="text" class="search-input" placeholder="Tìm kiếm bài viết...">
                    <button class="search-btn"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="categories">
            <button class="category-btn active">Tất cả</button>
            <button class="category-btn">Hướng dẫn sử dụng</button>
            <button class="category-btn">Kỹ thuật sơn</button>
            <button class="category-btn">Xu hướng màu sắc</button>
            <button class="category-btn">Dự án tham khảo</button>
            <button class="category-btn">Mẹo vặt</button>
        </div>

        <div class="main-content">
            <div class="posts-container">
                <?php
                require_once __DIR__ . '/../../../models/post.php';
                $posts = post_select_all();
                $i = 0; // dùng để check chẵn lẻ cho layout
                
                foreach ($posts as $post):
                    $is_even = ($i % 2 === 0);
                    $is_featured = ($i === 0); // Giả sử bài đầu tiên là featured
                    ?>
                    <div class="news-item <?= !$is_even ? 'news-item-reverse' : '' ?>">
                        <div class="news-thumb">
                            <?php if ($is_featured): ?>
                                <div class="featured-label">Nổi bật</div>
                            <?php endif; ?>
                            <img src="uploads/<?= htmlspecialchars($post['thumbnail']) ?>"
                                alt="<?= htmlspecialchars($post['title']) ?>">
                        </div>
                        <div class="news-content">
                            <div class="news-meta">
                                <div class="meta-item">
                                    <i class="far fa-calendar-alt"></i>
                                    <span><?= date("d/m/Y", strtotime($post['created_at'] ?? date("Y-m-d"))) ?></span>
                                </div>
                                <div class="meta-item">
                                    <i class="far fa-user"></i>
                                    <span>Admin</span>
                                </div>
                            </div>

                            <a href="index.php?page=post_detail&id=<?= $post['id'] ?>" class="news-title">
                                <?= htmlspecialchars($post['title']) ?>
                            </a>

                            <p class="news-desc">
                                <?= mb_substr(strip_tags($post['content']), 0, 200) ?>...
                            </p>

                            <div class="tags">
                                <span class="tag">Sơn nước</span>
                                <span class="tag">Hướng dẫn</span>
                            </div>

                            <a href="index.php?page=post_detail&id=<?= $post['id'] ?>" class="read-more">
                                Đọc tiếp <i class="fas fa-arrow-right"></i>
                            </a>

                        </div>
                    </div>
                    <?php
                    $i++;
                endforeach;
                ?>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <button class="page-btn"><i class="fas fa-angle-left"></i></button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">...</button>
                <button class="page-btn">7</button>
                <button class="page-btn"><i class="fas fa-angle-right"></i></button>
            </div>
        </div>
    </div>

    <script>
        // Script để làm cho trang web tương tác hơn
        document.addEventListener('DOMContentLoaded', function () {
            // Xử lý danh mục
            const categoryBtns = document.querySelectorAll('.category-btn');
            categoryBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    // Xóa active trước đó
                    categoryBtns.forEach(b => b.classList.remove('active'));
                    // Thêm active vào nút được nhấp
                    this.classList.add('active');
                });
            });

            // Xử lý phân trang
            const pageBtns = document.querySelectorAll('.page-btn');
            pageBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    if (btn.textContent !== '...') {
                        pageBtns.forEach(b => b.classList.remove('active'));
                        this.classList.add('active');
                    }
                });
            });
        });
    </script>
</body>

</html>