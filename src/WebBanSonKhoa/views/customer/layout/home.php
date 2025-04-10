<link rel="stylesheet" href="views/assets/css/style-products.css">
<link rel="stylesheet" href="views/assets/css/style-home.css">
<script src="views/assets/js/home.js"></script>

<!-- banner section -->
<section class="slider-container container text-center py-5" id="image-slider">
    <div>
        <h2>Sự kiện</h2>
        <button class="slider-btn prev" aria-label="Hình ảnh trước">&#10094;</button>
        <div class="slider py-2">
            <a href="https://example.com/product1" class="slide"><img src="views/assets/images/Background.png" alt="Sự kiện 1" loading="lazy"></a>
            <a href="https://example.com/product2" class="slide"><img src="views/assets/images/Background.png" alt="Sự kiện 2" loading="lazy"></a>
            <a href="https://example.com/product3" class="slide"><img src="views/assets/images/Background.png" alt="Sự kiện 3" loading="lazy"></a>
        </div>
        <button class="slider-btn next" aria-label="Hình ảnh tiếp theo">&#10095;</button>
    </div>
</section>

<!-- Products Section -->
<section id="products" class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Sản phẩm nổi bật</h2>
        
        <div class="row">
            <!-- Sidebar Menu - Danh mục sản phẩm -->
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">DANH MỤC SẢN PHẨM</h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a href="#" class="sidebar-link" data-filter="son-dulux">
                                    <i class="fa fa-angle-double-right text-danger me-2"></i> SƠN DULUX
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="sidebar-link" data-filter="son-jotun">
                                    <i class="fa fa-angle-double-right text-danger me-2"></i> SƠN JOTUN
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="sidebar-link" data-filter="son-maxilite">
                                    <i class="fa fa-angle-double-right text-danger me-2"></i> SƠN MAXILITE
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="sidebar-link" data-filter="son-kova">
                                    <i class="fa fa-angle-double-right text-danger me-2"></i> SƠN KOVA
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="sidebar-link" data-filter="bot-nippon">
                                    <i class="fa fa-angle-double-right text-danger me-2"></i> SƠN NIPPON
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="sidebar-link" data-filter="son-toa">
                                    <i class="fa fa-angle-double-right text-danger me-2"></i> SƠN TOA
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="sidebar-link" data-filter="son-mykolor">
                                    <i class="fa fa-angle-double-right text-danger me-2"></i> SƠN MYKOLOR
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="sidebar-link" data-filter="son-expo">
                                    <i class="fa fa-angle-double-right text-danger me-2"></i> SƠN EXPO
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="sidebar-link" data-filter="son-da-hoa-binh">
                                    <i class="fa fa-angle-double-right text-danger me-2"></i> SƠN ĐÁ HÒA BÌNH
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="sidebar-link" data-filter="TRỐNG THẤM SIKA">
                                    <i class="fa fa-angle-double-right text-danger me-2"></i> TRỐNG THẤM SIKA
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Price Filter -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Lọc theo giá</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="priceRange">Khoảng giá:</label>
                            <input type="range" class="form-range" id="priceRange" min="0" max="10000000" step="100000">
                            <div class="d-flex justify-content-between">
                                <span>0đ</span>
                                <span id="priceValue">5,000,000đ</span>
                                <span>10,000,000đ</span>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-primary w-100 mt-2">Áp dụng</button>
                    </div>
                </div>
            </div>
            
            
            <!-- Main Content - Products -->
            <div class="col-lg-9">
                <!-- Filter Buttons -->
                <!-- <div class="text-center mb-4">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-primary active filter-btn" data-filter="all">Tất cả</button>
                        <button type="button" class="btn btn-outline-primary filter-btn" data-filter="dulux">Sơn DULUX</button>
                        <button type="button" class="btn btn-outline-primary filter-btn" data-filter="jotun">Sơn JOTUN</button>
                        <button type="button" class="btn btn-outline-primary filter-btn" data-filter="maxilite">Sơn MAXILITE</button>
                        <button type="button" class="btn btn-outline-primary filter-btn" data-filter="kova">Sơn KOVA</button>
                        <button type="button" class="btn btn-outline-primary filter-btn" data-filter="nippon">Sơn NIPPON</button>
                        <button type="button" class="btn btn-outline-primary filter-btn" data-filter="toa">Sơn TOA</button>
                        <button type="button" class="btn btn-outline-primary filter-btn" data-filter="mykolor">Sơn MYKOLOR</button>
                        <button type="button" class="btn btn-outline-primary filter-btn" data-filter="expo">Sơn EXPO</button>
                        <button type="button" class="btn btn-outline-primary filter-btn" data-filter="da-hoa-binh">Sơn ĐÁ HÒA BÌNH</button>
                        <button type="button" class="btn btn-outline-primary filter-btn" data-filter="trong-tham">TRỐNG THẤM</button>
                    </div>
                </div> -->
                
                <!-- Sort Options -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <span class="me-2">Hiển thị <span id="productCount">12</span> sản phẩm</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="me-2">Sắp xếp theo:</label>
                        <select class="form-select form-select-sm" style="width: auto">
                            <option value="newest">Mới nhất</option>
                            <option value="price-asc">Giá: Thấp đến cao</option>
                            <option value="price-desc">Giá: Cao đến thấp</option>
                            <option value="popular">Phổ biến nhất</option>
                        </select>
                    </div>
                </div>
                
                <div class="row" id="productsList">
                    <!-- Product Cards - Will be filled dynamically -->
                </div>
                
                <!-- Pagination -->
                <nav aria-label="Product pagination" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Trước</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Sau</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>

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
                        <p class="card-text">Chuyên gia của chúng tôi sẽ giúp bạn chọn màu sắc phù hợp cho không gian của bạn.</p>
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
                <p>PaintMaster là nhà phân phối sơn hàng đầu Việt Nam với hơn 15 năm kinh nghiệm. Chúng tôi cung cấp các sản phẩm sơn chất lượng cao từ các thương hiệu uy tín trên thế giới.</p>
                <p>Sứ mệnh của chúng tôi là mang đến những giải pháp màu sắc tốt nhất, an toàn cho sức khỏe và thân thiện với môi trường.</p>
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