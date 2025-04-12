<style>
    .bg-paint-primary {
        background-color: #2563eb;
    }

    .text-paint-primary {
        color: #2563eb;
    }

    .bg-paint-secondary {
        background-color: #1e40af;
    }

    .paint-gradient {
        background: linear-gradient(135deg, #2563eb, #1e40af);
    }

    .hero-section {
        background: url('views/assets/images/Background.png') no-repeat center center;
        background-size: cover;
        position: relative;
    }

    .hero-overlay {
        background: rgba(0, 0, 0, 0.6);
    }

    .color-dot {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: inline-block;
        margin: 0 3px;
    }
</style>

<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay d-flex align-items-center py-5">
            <div class="container text-center text-white py-5">
                <h1 class="display-4 fw-bold mb-4">Về ColorHomes Paint</h1>
                <p class="lead mb-4">Chất lượng tạo nên sự khác biệt - Hơn 20 năm kinh nghiệm trong ngành sơn</p>
                <div>
                    <span class="color-dot bg-danger"></span>
                    <span class="color-dot bg-warning"></span>
                    <span class="color-dot bg-success"></span>
                    <span class="color-dot bg-info"></span>
                    <span class="color-dot bg-primary"></span>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Story Section -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="views/assets/images/Background.png" alt="Câu chuyện của chúng tôi" class="img-fluid rounded shadow">
                </div>
                <div class="col-lg-6">
                    <div class="ms-lg-4">
                        <h6 class="text-paint-primary fw-bold">CÂU CHUYỆN CỦA CHÚNG TÔI</h6>
                        <h2 class="fw-bold mb-4">Từ xưởng sản xuất nhỏ đến thương hiệu hàng đầu</h2>
                        <p class="text-muted">Được thành lập vào năm 2005, ColorHomes Paint bắt đầu là một xưởng sản
                            xuất sơn nhỏ với mục tiêu cung cấp các sản phẩm sơn chất lượng cao với giá cả hợp lý cho
                            người tiêu dùng Việt Nam.</p>
                        <p class="text-muted">Trải qua hơn 20 năm phát triển, chúng tôi đã trở thành một trong những
                            thương hiệu sơn nước hàng đầu, được tin dùng bởi hàng nghìn khách hàng và đối tác xây dựng
                            trên khắp cả nước.</p>
                        <div class="d-flex align-items-center mt-4">
                            <div class="border rounded-circle p-2 me-3">
                                <i class="bi bi-droplet-half fs-4 text-paint-primary"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Tầm nhìn</h5>
                                <p class="mb-0 text-muted small">Mang màu sắc và bảo vệ đến mọi công trình</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Values -->
    <section class="paint-gradient text-white py-5">
        <div class="container py-4">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="text-center px-4">
                        <div class="bg-white text-paint-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
                            style="width: 80px; height: 80px;">
                            <i class="bi bi-heart-fill fs-1"></i>
                        </div>
                        <h3 class="h4 mb-3">Sứ mệnh</h3>
                        <p class="opacity-75">Cung cấp các sản phẩm sơn chất lượng cao, an toàn và thân thiện với môi
                            trường, giúp bảo vệ và làm đẹp không gian sống của khách hàng.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="text-center px-4">
                        <div class="bg-white text-paint-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
                            style="width: 80px; height: 80px;">
                            <i class="bi bi-award-fill fs-1"></i>
                        </div>
                        <h3 class="h4 mb-3">Giá trị cốt lõi</h3>
                        <p class="opacity-75">Chất lượng, Đổi mới, Trách nhiệm và Khách hàng là trọng tâm trong mọi hoạt
                            động của chúng tôi.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="text-center px-4">
                        <div class="bg-white text-paint-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
                            style="width: 80px; height: 80px;">
                            <i class="bi bi-bullseye fs-1"></i>
                        </div>
                        <h3 class="h4 mb-3">Mục tiêu</h3>
                        <p class="opacity-75">Trở thành thương hiệu sơn số 1 Việt Nam về chất lượng và dịch vụ, mở rộng
                            thị trường ra khu vực Đông Nam Á.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h6 class="text-paint-primary fw-bold">TẠI SAO CHỌN CHÚNG TÔI</h6>
                <h2 class="fw-bold">Những lý do khách hàng tin tưởng ColorHomes Paint</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 70px; height: 70px;">
                                <i class="bi bi-shield-check fs-2 text-paint-primary"></i>
                            </div>
                            <h4 class="card-title h5">Chất lượng hàng đầu</h4>
                            <p class="card-text text-muted small">Sản phẩm đạt các tiêu chuẩn quốc tế về độ bền và an
                                toàn.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 70px; height: 70px;">
                                <i class="bi bi-palette fs-2 text-paint-primary"></i>
                            </div>
                            <h4 class="card-title h5">Đa dạng màu sắc</h4>
                            <p class="card-text text-muted small">Hơn 1000 màu sắc khác nhau, đáp ứng mọi nhu cầu thiết
                                kế.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 70px; height: 70px;">
                                <i class="bi bi-leaf fs-2 text-paint-primary"></i>
                            </div>
                            <h4 class="card-title h5">Thân thiện môi trường</h4>
                            <p class="card-text text-muted small">Sản phẩm có hàm lượng VOC thấp, an toàn cho sức khỏe.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 70px; height: 70px;">
                                <i class="bi bi-headset fs-2 text-paint-primary"></i>
                            </div>
                            <h4 class="card-title h5">Hỗ trợ 24/7</h4>
                            <p class="card-text text-muted small">Đội ngũ tư vấn chuyên nghiệp, sẵn sàng hỗ trợ mọi lúc.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team -->
    <section class="py-5">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h6 class="text-paint-primary fw-bold">ĐỘI NGŨ CỦA CHÚNG TÔI</h6>
                <h2 class="fw-bold">Những người làm nên thành công</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow h-100">
                        <img src="views/assets/images/Debirun.jpg" class="card-img-top" alt="CEO">
                        <div class="card-body text-center">
                            <h5 class="card-title mb-1">Nguyễn Văn A</h5>
                            <p class="text-muted small mb-3">Tổng Giám đốc</p>
                            <p class="card-text small text-muted">Hơn 25 năm kinh nghiệm trong ngành sơn và vật liệu xây
                                dựng.</p>
                        </div>
                        <div class="card-footer bg-white border-0 text-center">
                            <a href="#" class="btn btn-sm btn-light mx-1"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="btn btn-sm btn-light mx-1"><i class="bi bi-envelope"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow h-100">
                        <img src="views/assets/images/Ayaka.jpeg" class="card-img-top" alt="Technical Director">
                        <div class="card-body text-center">
                            <h5 class="card-title mb-1">Trần Thị B</h5>
                            <p class="text-muted small mb-3">Giám đốc Kỹ thuật</p>
                            <p class="card-text small text-muted">Tiến sĩ Hóa học, chuyên gia về công nghệ sơn hiện đại.
                            </p>
                        </div>
                        <div class="card-footer bg-white border-0 text-center">
                            <a href="#" class="btn btn-sm btn-light mx-1"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="btn btn-sm btn-light mx-1"><i class="bi bi-envelope"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow h-100">
                        <img src="views/assets/images/Neuvillete.jpeg" class="card-img-top" alt="Marketing Director">
                        <div class="card-body text-center">
                            <h5 class="card-title mb-1">Lê Văn C</h5>
                            <p class="text-muted small mb-3">Giám đốc Marketing</p>
                            <p class="card-text small text-muted">Chuyên gia về xây dựng thương hiệu và chiến lược phát
                                triển thị trường.</p>
                        </div>
                        <div class="card-footer bg-white border-0 text-center">
                            <a href="#" class="btn btn-sm btn-light mx-1"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="btn btn-sm btn-light mx-1"><i class="bi bi-envelope"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow h-100">
                        <img src="views/assets/images/Kaveh.jpeg" class="card-img-top" alt="Sales Director">
                        <div class="card-body text-center">
                            <h5 class="card-title mb-1">Phạm Thị D</h5>
                            <p class="text-muted small mb-3">Giám đốc Kinh doanh</p>
                            <p class="card-text small text-muted">15 năm kinh nghiệm trong phát triển hệ thống phân phối
                                sơn toàn quốc.</p>
                        </div>
                        <div class="card-footer bg-white border-0 text-center">
                            <a href="#" class="btn btn-sm btn-light mx-1"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="btn btn-sm btn-light mx-1"><i class="bi bi-envelope"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Milestones -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h6 class="text-paint-primary fw-bold">CHẶNG ĐƯỜNG PHÁT TRIỂN</h6>
                <h2 class="fw-bold">Những cột mốc quan trọng</h2>
            </div>
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="row g-4">
                        <div class="col-md-6 mb-4">
                            <div class="card border-0 shadow h-100">
                                <div class="card-body p-4">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <div class="bg-paint-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                                style="width: 50px; height: 50px;">
                                                2005
                                            </div>
                                        </div>
                                        <div>
                                            <h4 class="h5 mb-2">Thành lập công ty</h4>
                                            <p class="text-muted small mb-0">Xưởng sản xuất đầu tiên được thành lập tại
                                                Hà Nội với 15 nhân viên.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card border-0 shadow h-100">
                                <div class="card-body p-4">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <div class="bg-paint-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                                style="width: 50px; height: 50px;">
                                                2010
                                            </div>
                                        </div>
                                        <div>
                                            <h4 class="h5 mb-2">Mở rộng nhà máy</h4>
                                            <p class="text-muted small mb-0">Khánh thành nhà máy sản xuất 5,000m² tại
                                                Khu công nghiệp Bắc Ninh.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card border-0 shadow h-100">
                                <div class="card-body p-4">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <div class="bg-paint-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                                style="width: 50px; height: 50px;">
                                                2015
                                            </div>
                                        </div>
                                        <div>
                                            <h4 class="h5 mb-2">Chứng nhận ISO</h4>
                                            <p class="text-muted small mb-0">Đạt chứng nhận ISO 9001:2015 và ISO
                                                14001:2015 về hệ thống quản lý chất lượng và môi trường.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card border-0 shadow h-100">
                                <div class="card-body p-4">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <div class="bg-paint-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                                style="width: 50px; height: 50px;">
                                                2020
                                            </div>
                                        </div>
                                        <div>
                                            <h4 class="h5 mb-2">Xuất khẩu quốc tế</h4>
                                            <p class="text-muted small mb-0">Bắt đầu xuất khẩu sản phẩm sang thị trường
                                                Đông Nam Á và đạt doanh thu 100 tỷ đồng.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 mb-md-0">
                            <div class="card border-0 shadow h-100">
                                <div class="card-body p-4">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <div class="bg-paint-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                                style="width: 50px; height: 50px;">
                                                2023
                                            </div>
                                        </div>
                                        <div>
                                            <h4 class="h5 mb-2">Nhà máy thông minh</h4>
                                            <p class="text-muted small mb-0">Khánh thành nhà máy thông minh đầu tiên với
                                                dây chuyền sản xuất tự động hóa hoàn toàn.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 shadow h-100">
                                <div class="card-body p-4">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <div class="bg-paint-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                                style="width: 50px; height: 50px;">
                                                2025
                                            </div>
                                        </div>
                                        <div>
                                            <h4 class="h5 mb-2">Mở rộng thị trường</h4>
                                            <p class="text-muted small mb-0">Mục tiêu phát triển 500 điểm bán hàng trên
                                                toàn quốc và đạt doanh thu 500 tỷ đồng.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-5 paint-gradient">
        <div class="container text-center text-white py-4">
            <h2 class="fw-bold mb-4">Sẵn sàng làm mới không gian của bạn?</h2>
            <p class="lead mb-4">Hãy liên hệ với chúng tôi ngay hôm nay để được tư vấn miễn phí về giải pháp sơn phù hợp
                nhất.</p>
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="#" class="btn btn-light btn-lg px-4">Liên hệ ngay</a>
                        <a href="#" class="btn btn-outline-light btn-lg px-4">Xem sản phẩm</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>