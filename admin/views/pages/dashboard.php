<link rel="stylesheet" href="views/assets/css/admin.css">

<body class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2 mb-0">Tổng quan</h1>
        <div class="button-group">
            <button type="button" class="btn btn-outline-secondary me-2">
                <i class="fas fa-share me-1"></i> Chia sẻ
            </button>
            <button type="button" class="btn btn-outline-secondary me-2">
                <i class="fas fa-download me-1"></i> Xuất
            </button>

            <select class="btn btn-outline-secondary me-2" name="" id="">
                <option value="" selected>Tuần này</option>
                <option value="">1 tuần trước</option>
                <option value="">2 tuần trước</option>
                <option value="">3 tuần trước</option>
                <option value="">1 tháng trước</option>
            </select>
        </div>
    </div>

    <!-- Stats cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card border-0 shadow h-100 py-2" style="border-left-color: #4e73df !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Doanh thu (Tháng)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">235,000,000 đ</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card border-0 shadow h-100 py-2" style="border-left-color: #1cc88a !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Đơn hàng mới</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card border-0 shadow h-100 py-2" style="border-left-color: #36b9cc !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Khách hàng mới</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">12</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card border-0 shadow h-100 py-2" style="border-left-color: #f6c23e !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Sản phẩm hết hàng</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">8</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- chart -->
    <div class="cardRevenue card shadow mb-4">
        <div class="cardRevenue-header card-header py-3 d-flex justify-content-between align-items-center">
            <h2 class="m-0 font-weight-bold">Biểu đồ doanh thu</h2>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-primary active" id="dayBtn">Theo ngày</button>
                <button type="button" class="btn btn-outline-primary" id="monthBtn">Theo tháng</button>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-xl-6 col-md-6">
                    <div class="card shadow h-100 py-2 summary-card border-revenue">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-revenue text-uppercase mb-1">
                                        Tổng doanh thu</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalRevenue">
                                        150,000,000 VNĐ</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="card shadow h-100 py-2 summary-card border-growth">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-growth text-uppercase mb-1">
                                        Tăng trưởng</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="growth">12.5%</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="chart-revenue-container">
                <canvas id="revenueChart"></canvas>
            </div>

            <div class="table-responsive mt-4">
                <table class="table table-bordered table-hover" id="dataTable">
                    <thead class="table-light">
                        <tr>
                            <th>Thời gian</th>
                            <th>Doanh thu (VNĐ)</th>
                            <th>Thay đổi</th>
                        </tr>
                    </thead>
                    <tbody id="revenueTable">
                        <!-- Dữ liệu sẽ được thêm bằng JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    <!-- Top Selling Products -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sản phẩm bán chạy</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Đã bán</th>
                                    <th>Doanh thu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="d-flex align-items-center">
                                        <div class="product-image me-2"
                                            style="background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; width: 60px; height: 60px;">
                                            <i class="fas fa-paint-roller fa-2x text-primary"></i>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">Sơn Dulux</div>
                                            <div class="small text-muted">Ngoại thất cao cấp</div>
                                        </div>
                                    </td>
                                    <td>145</td>
                                    <td>43,500,000 đ</td>
                                </tr>
                                <tr>
                                    <td class="d-flex align-items-center">
                                        <div class="product-image me-2"
                                            style="background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; width: 60px; height: 60px;">
                                            <i class="fas fa-fill-drip fa-2x text-success"></i>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">Sơn Jotun</div>
                                            <div class="small text-muted">Nội thất kháng khuẩn</div>
                                        </div>
                                    </td>
                                    <td>132</td>
                                    <td>39,600,000 đ</td>
                                </tr>
                                <tr>
                                    <td class="d-flex align-items-center">
                                        <div class="product-image me-2"
                                            style="background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; width: 60px; height: 60px;">
                                            <i class="fas fa-brush fa-2x text-warning"></i>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">Sơn TOA</div>
                                            <div class="small text-muted">Chống thấm đặc biệt</div>
                                        </div>
                                    </td>
                                    <td>98</td>
                                    <td>29,400,000 đ</td>
                                </tr>
                                <tr>
                                    <td class="d-flex align-items-center">
                                        <div class="product-image me-2"
                                            style="background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; width: 60px; height: 60px;">
                                            <i class="fas fa-paint-brush fa-2x text-danger"></i>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold">Sơn Nippon</div>
                                            <div class="small text-muted">Dễ lau chùi</div>
                                        </div>
                                    </td>
                                    <td>87</td>
                                    <td>26,100,000 đ</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- chart  -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h2 class="text-center mb-0">Thống kê sản phẩm bán chạy</h2>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="productPieChart"></canvas>
                    </div>
                    <div class="mt-4">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng đã bán</th>
                                        <th>Phần trăm</th>
                                    </tr>
                                </thead>
                                <tbody id="productTable">
                                    Dữ liệu sẽ được thêm bằng JavaScript
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="views/assets/js/dashboard.js"></script>
</body>

</html>