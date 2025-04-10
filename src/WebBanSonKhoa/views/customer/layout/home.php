<link rel="stylesheet" href="views/assets/css/style-products.css">
<link rel="stylesheet" href="views/assets/css/style-home.css">
<script src="views/assets/js/home.js"></script>

<?php
    include("banner.php");
    include("products_section.php");

    // include("services.php");
?>

<!-- Services Section -->
<section id="services" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Dịch vụ của chúng tôi</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card text-center h-100">
                    <div class="card-body shadow">
                        <i class="fas fa-palette fa-3x mb-3 text-primary"></i>
                        <h4 class="card-title">Tư vấn màu sắc</h4>
                        <p class="card-text">Chuyên gia của chúng tôi sẽ giúp bạn chọn màu sắc phù hợp cho không gian
                            của bạn.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card text-center h-100">
                    <div class="card-body shadow">
                        <i class="fas fa-paint-roller fa-3x mb-3 text-primary"></i>
                        <h4 class="card-title">Dịch vụ sơn</h4>
                        <p class="card-text">Đội ngũ thợ sơn chuyên nghiệp với nhiều năm kinh nghiệm.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card text-center h-100">
                    <div class="card-body shadow">
                        <i class="fas fa-truck fa-3x mb-3 text-primary"></i>
                        <h4 class="card-title">Giao hàng tận nơi</h4>
                        <p class="card-text">Miễn phí giao hàng cho đơn hàng trên 1 triệu đồng trong nội thành.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- paint Selector Tool -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Công cụ chọn màu</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title">Thử màu sắc</h5>
                        <div id="colorPreview"></div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="redRange" class="form-label">Đỏ</label>
                                <input type="range" class="form-range" id="redRange" min="0" max="255" value="100">
                            </div>
                            <div class="col-md-4">
                                <label for="greenRange" class="form-label">Xanh lá</label>
                                <input type="range" class="form-range" id="greenRange" min="0" max="255" value="150">
                            </div>
                            <div class="col-md-4">
                                <label for="blueRange" class="form-label">Xanh dương</label>
                                <input type="range" class="form-range" id="blueRange" min="0" max="255" value="200">
                            </div>
                        </div>
                        <div class="mt-3">
                            <label for="colorHex" class="form-label">Mã màu HEX</label>
                            <input type="text" class="form-control text-center" id="colorHex" value="#6496C8" readonly>
                        </div>
                        <button class="btn btn-primary mt-3" id="saveColorBtn">Lưu màu này</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Us Section -->
<section id="about" class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="mb-4">Về chúng tôi</h2>
                <p>PaintMaster là nhà phân phối sơn hàng đầu Việt Nam với hơn 15 năm kinh nghiệm. Chúng tôi cung cấp các
                    sản phẩm sơn chất lượng cao từ các thương hiệu uy tín trên thế giới.</p>
                <p>Sứ mệnh của chúng tôi là mang đến những giải pháp màu sắc tốt nhất, an toàn cho sức khỏe và thân
                    thiện với môi trường.</p>
                <button class="btn btn-outline-primary mt-3" id="readMoreBtn">Tìm hiểu thêm</button>
            </div>
            <div class="col-lg-6">
                <img src="views/assets/images/Debirun.jpg" alt="Về PaintMaster" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Khách hàng nói gì về chúng tôi</h2>
        <div class="row" id="testimonialsList">

        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section id="contact" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Liên hệ với chúng tôi</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <form id="contactForm" novalidate>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Họ và tên</label>
                                    <input type="text" class="form-control" id="name" required>
                                    <div class="invalid-feedback">Vui lòng nhập họ tên</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" required>
                                    <div class="invalid-feedback">Vui lòng nhập email hợp lệ</div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="tel" class="form-control" id="phone" pattern="[0-9]{10}" required>
                                <div class="invalid-feedback">Vui lòng nhập số điện thoại hợp lệ (10 số)</div>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Chủ đề</label>
                                <select class="form-select" id="subject" required>
                                    <option value="" selected disabled>Chọn chủ đề</option>
                                    <option value="Thông tin sản phẩm">Thông tin sản phẩm</option>
                                    <option value="Báo giá">Báo giá</option>
                                    <option value="Dịch vụ">Dịch vụ</option>
                                    <option value="Khác">Khác</option>
                                </select>
                                <div class="invalid-feedback">Vui lòng chọn chủ đề</div>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Tin nhắn</label>
                                <textarea class="form-control" id="message" rows="4" required></textarea>
                                <div class="invalid-feedback">Vui lòng nhập nội dung tin nhắn</div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Gửi tin nhắn</button>
                            </div>
                        </form>
                        <div id="formSubmitStatus" class="mt-3 text-center" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>