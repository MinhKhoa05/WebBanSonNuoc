<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Quản Lý Sơn Nước</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <link rel="stylesheet" href="../assets/css/admin/style-admin.css">
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Main content -->
      <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
        <!-- Top Bar -->
        <div class="row top-bar">
          <div class="col">
            <div class="d-flex justify-content-between align-items-center">
              <div class="search-container">
                <input type="search" class="form-control" placeholder="Tìm kiếm..." aria-label="Search">
              </div>
              <div class="d-flex align-items-center">
                <div class="position-relative me-3">
                  <i class="fas fa-bell"></i>
                  <span class="notification-badge">3</span>
                </div>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                          <i class="fas fa-user-circle me-1"></i>
                          Admin
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                          <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Hồ sơ</a></li>
                          <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Cài đặt</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i>Đăng xuất</a></li>
                        </ul>
                    </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      
        <!-- Dashboard -->
        <div class="container-fluid">
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

                <!-- <ul class="navbar-nav ms-auto">
                  <li class="nav-item dropdown">
                    <button type="button" class="btn btn-outline-secondary dropdown-toggle me-2" data-bs-toggle="dropdown">
                      <i class="fas fa-calendar me-1"></i> Tuần này
                    </button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"></i>1 Tuần trước</a></li>
                        <li><a class="dropdown-item" href="#"></i>2 Tuần trước</a></li>
                        <li><a class="dropdown-item" href="#"></i>3 Tuần trước</a></li>
                        <li><a class="dropdown-item" href="#"></i>1 tháng trước</a></li>
                      </ul>
                  </li>
                </ul> -->
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
          
            <!-- Recent Orders -->
          <div class="mb-4">
            <div class="card shadow mb-4">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Đơn hàng gần đây</h6>
                <div class="dropdown no-arrow">
                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end shadow animated--fade-in">
                    <a class="dropdown-item" href="#">Tất cả đơn hàng</a>
                    <a class="dropdown-item" href="#">Xuất báo cáo</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Mã đơn</th>
                        <th>Khách hàng</th>
                        <th>Ngày đặt</th>
                        <th>Trạng thái</th>
                        <th>Tổng tiền</th>
                        <th>Thao tác</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>#ORD-2023</td>
                        <td>Nguyễn Văn A</td>
                        <td>05/04/2025</td>
                        <td><span class="badge bg-success">Hoàn thành</span></td>
                        <td>3,560,000 đ</td>
                        <td>
                          <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                        </td>
                      </tr>
                      <tr>
                        <td>#ORD-2022</td>
                        <td>Trần Thị B</td>
                        <td>04/04/2025</td>
                        <td><span class="badge bg-warning text-dark">Đang giao</span></td>
                        <td>2,800,000 đ</td>
                        <td>
                          <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                        </td>
                      </tr>
                      <tr>
                        <td>#ORD-2021</td>
                        <td>Lê Văn C</td>
                        <td>04/04/2025</td>
                        <td><span class="badge bg-info">Đã xác nhận</span></td>
                        <td>1,720,000 đ</td>
                        <td>
                          <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                        </td>
                      </tr>
                      <tr>
                        <td>#ORD-2020</td>
                        <td>Phạm Thị D</td>
                        <td>03/04/2025</td>
                        <td><span class="badge bg-danger">Đã hủy</span></td>
                        <td>4,150,000 đ</td>
                        <td>
                          <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                        </td>
                      </tr>
                      <tr>
                        <td>#ORD-2019</td>
                        <td>Hoàng Văn E</td>
                        <td>02/04/2025</td>
                        <td><span class="badge bg-success">Hoàn thành</span></td>
                        <td>2,340,000 đ</td>
                        <td>
                          <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
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
                                          <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalRevenue">150,000,000 VNĐ</div>
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
                            <div class="product-image me-2" style="background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; width: 60px; height: 60px;">
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
                            <div class="product-image me-2" style="background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; width: 60px; height: 60px;">
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
                            <div class="product-image me-2" style="background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; width: 60px; height: 60px;">
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
                            <div class="product-image me-2" style="background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; width: 60px; height: 60px;">
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
                      
          <!-- Product Management Preview -->
          <div class="row">
            <div class="col-12">
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Quản lý sản phẩm</h6>
                  <button class="btn btn-sm btn-primary">
                    <i class="fas fa-plus me-1"></i> Thêm sản phẩm
                  </button>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Sản phẩm</th>
                          <th>Loại</th>
                          <th>Giá bán</th>
                          <th>Tồn kho</th>
                          <th>Trạng thái</th>
                          <th>Thao tác</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>SPP001</td>
                          <td class="d-flex align-items-center">
                            <div class="product-image me-2" style="background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; width: 40px; height: 40px;">
                              <i class="fas fa-paint-roller text-primary"></i>
                            </div>
                            <div>
                              <div class="font-weight-bold">Sơn Dulux Weathershield</div>
                              <div class="small text-muted">5L - Trắng ngà</div>
                            </div>
                          </td>
                          <td>Ngoại thất</td>
                          <td>850,000 đ</td>
                          <td>42</td>
                          <td><span class="badge bg-success">Còn hàng</span></td>
                          <td>
                            <button class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                          </td>
                        </tr>
                        <tr>
                          <td>SPP002</td>
                          <td class="d-flex align-items-center">
                            <div class="product-image me-2" style="background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; width: 40px; height: 40px;">
                              <i class="fas fa-paint-brush text-success"></i>
                            </div>
                            <div>
                              <div class="font-weight-bold">Sơn Jotun Essence Easy Clean</div>
                              <div class="small text-muted">5L - Xanh nhạt</div>
                            </div>
                          </td>
                          <td>Nội thất</td>
                          <td>920,000 đ</td>
                          <td>28</td>
                          <td><span class="badge bg-success">Còn hàng</span></td>
                          <td>
                            <button class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                          </td>
                        </tr>
                        <tr>
                          <td>SPP003</td>
                          <td class="d-flex align-items-center">
                            <div class="product-image me-2" style="background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; width: 40px; height: 40px;">
                              <i class="fas fa-fill-drip text-warning"></i>
                            </div>
                            <div>
                              <div class="font-weight-bold">Sơn TOA SuperShield</div>
                              <div class="small text-muted">18L - Vàng chanh</div>
                            </div>
                          </td>
                          <td>Ngoại thất</td>
                          <td>1,650,000 đ</td>
                          <td>15</td>
                          <td><span class="badge bg-warning text-dark">Sắp hết</span></td>
                          <td>
                            <button class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                          </td>
                        </tr>
                        <tr>
                          <td>SPP004</td>
                          <td class="d-flex align-items-center">
                            <div class="product-image me-2" style="background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; width: 40px; height: 40px;">
                              <i class="fas fa-brush text-danger"></i>
                            </div>
                            <div>
                              <div class="font-weight-bold">Sơn Nippon Odour-less</div>
                              <div class="small text-muted">5L - Hồng pastel</div>
                            </div>
                          </td>
                          <td>Nội thất</td>
                          <td>780,000 đ</td>
                          <td>0</td>
                          <td><span class="badge bg-danger">Hết hàng</span></td>
                          <td>
                            <button class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="../../../assets/js/admin/general.js"></script>
</body>
</html>