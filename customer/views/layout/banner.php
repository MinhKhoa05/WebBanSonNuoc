<!-- banner section -->
<style>
    #banner-section {
        margin-bottom: 20px;
    }

    #banner-section .carousel-item img {
        height: 550px;
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

    @media (max-width: 767.98px) {
    #banner-section .carousel-item {
        height: 200px; /* Giảm chiều cao carousel trên mobile */
    }
    #banner-section-1 .banner-small {
        height: 100px; /* Giảm chiều cao banner nhỏ */
    }
    #banner-section-1 .banner-large {
        height: 200px; /* Giảm chiều cao banner lớn */
    }
}
</style>

<!-- Banner Section -->
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
                <a href="">
                    <img src="customer/views/assets/images/background.png" class="d-block w-100" alt="Banner 1">
                </a>
                <div class="carousel-caption d-none d-md-block">
                    <h5>PaintMart - Siêu thị sơn số 1 Việt Nam</h5>
                    <p>Phối màu sơn nhà 3D miễn phí - 5 gam màu sơn đẹp nhất.</p>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item">
                <a href="">
                    <img src="customer/views/assets/images/banner-cr.png" class="d-block w-100" alt="Banner 2">
                </a>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Mua sơn tặng ghế</h5>
                    <p>Giảm giá 50% và nhận ngay bộ 4 ghế khi mua sơn Jotun.</p>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item">
                <a href="">
                    <img src="customer/views/assets/images/Banner nana.jpg" class="d-block w-100" alt="Banner 3">
                </a>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Ambiance 5in1</h5>
                    <p>Sơn sáng - Quá xịn, giảm giá lên đến 44%.</p>
                </div>
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

<section id="banner-section-1" class="mb-4">
    <div class="container lazy-load">
        <div class="row g-3">
            <!-- Banner nhỏ bên trái -->
            <div class="col-md-3 d-flex flex-column justify-content-between">
                <div class="banner-small">
                    <a href="">
                        <img src="customer/views/assets/images/livingroom.jpg" class="img-fluid rounded" alt="Banner Left 1">
                    </a>
                </div>
                <div class="banner-small mt-3">
                    <a href="">
                        <img src="customer/views/assets/images/timthumb.jpg" class="img-fluid rounded" alt="Banner Left 2">
                    </a>
                </div>
            </div>

            <!-- Banner lớn ở giữa -->
            <div class="col-md-6">
                <div class="banner-large">
                    <a href="">
                        <img src="customer/views/assets/images/company.jpg" class="img-fluid rounded" alt="Banner Center">
                    </a>
                </div>
            </div>

            <!-- Banner nhỏ bên phải -->
            <div class="col-md-3 d-flex flex-column justify-content-between">
                <div class="banner-small">
                    <a href="">
                        <img src="customer/views/assets/images/paintcan.jpg" class="img-fluid rounded" alt="Banner Right 1">
                    </a>
                </div>
                <div class="banner-small mt-3">
                    <a href="">
                        <img src="customer/views/assets/images/livingroom2.jpg" class="img-fluid rounded" alt="Banner Right 2">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>