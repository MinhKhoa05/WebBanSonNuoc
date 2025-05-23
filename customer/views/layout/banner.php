<?php
// $customer_banners = [banner1, banner2, banner3, banner4, banner5, banner6, banner7, banner8];

var_dump($customer_banners);

function render_banner($banner) {
    if (preg_match('/\\.(jpg|jpeg|png|gif)$/i', $banner)) {
        // Nếu là URL tuyệt đối (http...) hoặc bắt đầu bằng /
        if (preg_match('/^(http|https):\\/\\//', $banner) || strpos($banner, '/') === 0) {
            $src = $banner;
        } else {
            // Mặc định lấy từ thư mục uploads/
            $src = 'uploads/' . $banner;
        }
        echo '<img src="' . htmlspecialchars($src) . '" class="d-block w-100" alt="Banner">';
    } else {
        // Nếu là HTML hoặc text, in ra luôn
        echo $banner;
    }
}
?>
<style>
    #banner-section {
        margin-bottom: 20px;
    }

    #banner-section .carousel-item img {
        height: 400px;
        /* Chiều cao cố định cho banner */
        object-fit: cover;
        /* Đảm bảo hình ảnh giữ tỷ lệ */
    }

    #banner-section .carousel-caption {
        background-color: rgba(0, 0, 0, 0.5);
        /* Nền đen mờ */
        padding: 15px;
        border-radius: 5px;
    }

    #banner-section .carousel-caption h5 {
        font-size: 1.5rem;
        font-weight: bold;
    }

    #banner-section .carousel-caption p {
        font-size: 1rem;
    }

    #banner-section-1 .banner-small img,
    #banner-section-1 .banner-large img {
        width: 100%; /* Chiều rộng 100% */
        height: auto; /* Tự động điều chỉnh chiều cao theo tỷ lệ */
        object-fit: cover; /* Đảm bảo hình ảnh giữ tỷ lệ và không bị méo */
        border-radius: 5px; /* Bo góc nhẹ */
    }

    #banner-section-1 .banner-small img{
        height: 300px;
        overflow: hidden;
    }

    #banner-section-1 .banner-large img{
        height: 600px;
        overflow: hidden;
    }

    #banner-section-2 .banner-medium img {
        height: 400px;
        width: 100%;
        object-fit: cover;
        border-radius: 5px;
    }
</style>

<!-- Main Banner Carousel Section -->
<section id="banner-section" class="mb-4">
    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
        <!-- Indicators -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <!-- Slides -->
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active">
                <?php render_banner($customer_banners[0] ?? ''); ?>
            </div>
            <!-- Slide 2 -->
            <div class="carousel-item">
                <?php render_banner($customer_banners[1] ?? ''); ?>
            </div>
            <!-- Slide 3 -->
            <div class="carousel-item">
                <?php render_banner($customer_banners[2] ?? ''); ?>
            </div>
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<!-- Secondary Banner Section -->
<section id="banner-section-1" class="mb-4">
    <div class="container lazy-load">
        <div class="row g-3">
            <!-- Banner nhỏ bên trái -->
            <div class="col-md-3 d-flex flex-column justify-content-between">
                <div class="banner-small">
                    <?php render_banner($customer_banners[3] ?? ''); ?>
                </div>
                <div class="banner-small mt-3">
                    <?php render_banner($customer_banners[4] ?? ''); ?>
                </div>
            </div>

            <!-- Banner lớn ở giữa -->
            <div class="col-md-6">
                <div class="banner-large">
                    <?php render_banner($customer_banners[5] ?? ''); ?>
                </div>
            </div>

            <!-- Banner nhỏ bên phải -->
            <div class="col-md-3 d-flex flex-column justify-content-between">
                <div class="banner-small">
                    <?php render_banner($customer_banners[6] ?? ''); ?>
                </div>
                <div class="banner-small mt-3">
                    <?php render_banner($customer_banners[7] ?? ''); ?>
                </div>
            </div>
        </div>
    </div>
</section>