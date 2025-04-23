<link rel="stylesheet" href="views/assets/css/customer/contactCSS.css">
<body>
    <!-- Header Banner -->
    <div class="bg-dark py-5 mb-5 text-white lazy-load">
        <div class="container text-center">
            <h1>Liên Hệ Với Chúng Tôi</h1>
            <p class="lead">Hãy để chúng tôi giúp bạn tìm giải pháp màu sắc hoàn hảo</p>
        </div>
    </div>

    <!-- Contact Info -->
    <div class="container mb-5 lazy-load">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card shadow h-100 text-center p-4">
                    <div class="card-body">
                        <i class="fas fa-map-marker-alt text-primary fs-1 mb-3"></i>
                        <h4>Địa Chỉ</h4>
                        <p>123 Đường Lê Lợi, Quận 1<br>TP. Hồ Chí Minh, Việt Nam</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow h-100 text-center p-4">
                    <div class="card-body">
                        <i class="fas fa-phone-alt text-primary fs-1 mb-3"></i>
                        <h4>Điện Thoại</h4>
                        <p>Hotline: 1900 1234 56<br>Tư vấn: 028.3456.7890</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow h-100 text-center p-4">
                    <div class="card-body">
                        <i class="fas fa-envelope text-primary fs-1 mb-3"></i>
                        <h4>Email</h4>
                        <p>info@colormaster.vn<br>cskh@colormaster.vn</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Form and Map -->
    <div class="container mb-5 lazy-load">
        <div class="row">
            <!-- Contact Form -->
            <div class="col-lg-6 mb-5">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h3 class="mb-4">Gửi Thông Tin Cho Chúng Tôi</h3>
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="name" placeholder="Nhập họ và tên của bạn">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Nhập địa chỉ email của bạn">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="tel" class="form-control" id="phone" placeholder="Nhập số điện thoại của bạn">
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Chủ đề</label>
                                <select class="form-select" id="subject">
                                    <option selected>Chọn chủ đề liên hệ</option>
                                    <option value="product">Thông tin sản phẩm</option>
                                    <option value="service">Dịch vụ tư vấn</option>
                                    <option value="pricing">Báo giá</option>
                                    <option value="complaint">Khiếu nại</option>
                                    <option value="other">Khác</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Nội dung</label>
                                <textarea class="form-control" id="message" rows="5" placeholder="Nhập nội dung tin nhắn của bạn"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi Tin Nhắn</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Map -->
            <div class="col-lg-6 mb-5">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h3 class="mb-4">Vị Trí Của Chúng Tôi</h3>
                        <div class="mb-4 rounded">
                            <img src="/api/placeholder/600/400" alt="Bản đồ vị trí cửa hàng" class="img-fluid rounded">
                        </div>
                        <div class="mt-4">
                            <h4>Giờ Làm Việc</h4>
                            <p><strong>Thứ Hai - Thứ Sáu:</strong> 8:00 - 17:30</p>
                            <p><strong>Thứ Bảy:</strong> 8:00 - 12:00</p>
                            <p><strong>Chủ Nhật:</strong> Nghỉ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Showroom and Distributors -->
    <div class="container mb-5 lazy-load">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h2>Hệ Thống Showroom & Đại Lý</h2>
                <p class="lead">Chúng tôi có mặt tại nhiều tỉnh thành trên toàn quốc</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title">Showroom TP.HCM</h5>
                        <p class="card-text">123 Đường Lê Lợi, Quận 1<br>TP. Hồ Chí Minh</p>
                        <p class="card-text">Điện thoại: 028.3456.7890</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title">Showroom Hà Nội</h5>
                        <p class="card-text">456 Đường Trần Phú, Quận Ba Đình<br>Hà Nội</p>
                        <p class="card-text">Điện thoại: 024.3567.8901</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title">Showroom Đà Nẵng</h5>
                        <p class="card-text">789 Đường Nguyễn Văn Linh, Quận Hải Châu<br>Đà Nẵng</p>
                        <p class="card-text">Điện thoại: 0236.3678.901</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 text-center">
                <a href="#" class="btn btn-outline-primary">Xem tất cả đại lý</a>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="container mb-5 lazy-load">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h2>Câu Hỏi Thường Gặp</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                Làm thế nào để chọn loại sơn phù hợp cho ngôi nhà của tôi?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Việc chọn loại sơn phù hợp phụ thuộc vào nhiều yếu tố như không gian sử dụng (trong nhà/ngoài trời), bề mặt cần sơn, điều kiện thời tiết và yêu cầu về độ bền. Bạn có thể liên hệ với đội ngũ tư vấn của chúng tôi để được hỗ trợ tốt nhất.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                ColorMaster có dịch vụ thi công sơn không?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Có, chúng tôi cung cấp dịch vụ thi công sơn chuyên nghiệp với đội ngũ thợ sơn có tay nghề cao và nhiều năm kinh nghiệm. Chúng tôi cam kết mang đến chất lượng tốt nhất cho mọi công trình.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                Tôi có thể nhận báo giá như thế nào?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Bạn có thể nhận báo giá bằng cách điền vào form liên hệ trên website, gọi điện trực tiếp đến hotline hoặc đến showroom gần nhất của chúng tôi. Đội ngũ tư vấn sẽ liên hệ với bạn trong vòng 24 giờ.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>