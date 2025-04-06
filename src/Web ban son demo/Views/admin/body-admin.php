<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-md-3 col-lg-2 sidebar p-0">
        <div class="d-flex flex-column p-3">
          <a href="#" class="navbar-brand d-flex align-items-center mb-3">
            <i class="fas fa-paint-roller me-2"></i>
            <span>Admin Sơn Nước</span>
          </a>
          <hr class="text-light">
          <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
              <a href="#" class="nav-link active">
                <i class="fas fa-tachometer-alt"></i> Tổng quan
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-box"></i> Sản phẩm
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-shopping-cart"></i> Đơn hàng
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-users"></i> Khách hàng
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-palette"></i> Danh mục màu
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-tags"></i> Khuyến mãi
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-truck"></i> Nhà cung cấp
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-clipboard-list"></i> Tồn kho
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-chart-line"></i> Báo cáo
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-cog"></i> Cài đặt
              </a>
            </li>
          </ul>
        </div>
      </div>
      
      <!-- Main content -->
      <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
        <!-- Top navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 rounded">
          <div class="container-fluid">
            <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="d-flex align-items-center">
              <input class="form-control me-2" type="search" placeholder="Tìm kiếm..." aria-label="Search">
            </div>
            <ul class="navbar-nav ms-auto">
              <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown">
                  <i class="fas fa-bell"></i>
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                </a>
              </li>
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
        </nav>
        
        <!-- Dashboard -->
        <div class="container-fluid">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Tổng quan</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Chia sẻ</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Xuất</button>
              </div>
              <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <i class="fas fa-calendar me-1"></i>
                Tuần này
              </button>
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
          
          <!-- Content Row -->
          <div class="row">
            <!-- Recent Orders -->
            <div class="col-lg-7 mb-4">
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
              <!-- Top Colors -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Màu sắc phổ biến</h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-4 mb-3">
                      <div class="d-flex flex-column align-items-center">
                        <div class="color-preview mb-2" style="background-color: #f5f5f5; width: 50px; height: 50px;"></div>
                        <div class="font-weight-bold">Trắng ngà</div>
                        <div class="small text-muted">#f5f5f5</div>
                      </div>
                    </div>
                    <div class="col-lg-4 mb-3">
                      <div class="d-flex flex-column align-items-center">
                        <div class="color-preview mb-2" style="background-color: #e1f5fe; width: 50px; height: 50px;"></div>
                        <div class="font-weight-bold">Xanh nhạt</div>
                        <div class="small text-muted">#e1f5fe</div>
                      </div>
                    </div>
                    <div class="col-lg-4 mb-3">
                      <div class="d-flex flex-column align-items-center">
                        <div class="color-preview mb-2" style="background-color: #fff9c4; width: 50px; height: 50px;"></div>
                        <div class="font-weight-bold">Vàng chanh</div>
                        <div class="small text-muted">#fff9c4</div>
                      </div>
                    </div>
                    <div class="col-lg-4 mb-3">
                      <div class="d-flex flex-column align-items-center">
                        <div class="color-preview mb-2" style="background-color: #e8f5e9; width: 50px; height: 50px;"></div>
                        <div class="font-weight-bold">Xanh lá</div>
                        <div class="small text-muted">#e8f5e9</div>
                      </div>
                    </div>
                    <div class="col-lg-4 mb-3">
                      <div class="d-flex flex-column align-items-center">
                        <div class="color-preview mb-2" style="background-color: #fce4ec; width: 50px; height: 50px;"></div>
                        <div class="font-weight-bold">Hồng pastel</div>
                        <div class="small text-muted">#fce4ec</div>
                      </div>
                    </div>
                    <div class="col-lg-4 mb-3">
                      <div class="d-flex flex-column align-items-center">
                        <div class="color-preview mb-2" style="background-color: #f3e5f5; width: 50px; height: 50px;"></div>
                        <div class="font-weight-bold">Tím nhạt</div>
                        <div class="small text-muted">#f3e5f5</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Top Selling Products -->
            <div class="col-lg-5 mb-4">
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
           
              <!-- chart -->
              <div class="py-5">
                <h4 class="text-primary mb-4">Biểu đồ sản phẩm bán chạy (theo số lượng đã bán)</h4>
                
                <div class="card shadow-sm">
                  <div class="card-body">
                    <canvas id="productChart" width="200" height="200"></canvas>
                  </div>
                </div>
              </div>
            
              <script>
                const ctx = document.getElementById('productChart').getContext('2d');
                const productChart = new Chart(ctx, {
                  type: 'pie',
                  data: {
                    labels: ['Sơn Dulux', 'Sơn Jotun', 'Sơn TOA', 'Sơn Nippon'],
                    datasets: [{
                      label: 'Đã bán',
                      data: [145, 132, 98, 87],
                      backgroundColor: [
                        '#0d6efd', // Dulux - Xanh dương
                        '#198754', // Jotun - Xanh lá
                        '#ffc107', // TOA - Vàng
                        '#dc3545'  // Nippon - Đỏ
                      ],
                      borderWidth: 1
                    }]
                  },
                  options: {
                    responsive: true,
                    plugins: {
                      legend: {
                        position: 'bottom',
                      },
                      tooltip: {
                        callbacks: {
                          label: function(context) {
                            const total = context.chart._metasets[context.datasetIndex].total;
                            const value = context.parsed;
                            const percent = ((value / total) * 100).toFixed(1);
                            return `${context.label}: ${value} (${percent}%)`;
                          }
                        }
                      }
                    }
                  }
                });
              </script>
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
</body>
</html>