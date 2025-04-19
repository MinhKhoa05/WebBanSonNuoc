<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý Sản phẩm - Admin Sơn Nước</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <link rel="stylesheet" href="css/admin-product.css">
</head>
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
      
      <!-- Main Content -->
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
        
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2 class="mb-0">Sản phẩm</h2>
          <div class="button-group">
            <button type="button" class="btn btn-outline-secondary me-2">
              <i class="fas fa-upload me-1"></i> Nhập file
            </button>
            <button type="button" class="btn btn-outline-secondary me-2">
              <i class="fas fa-download me-1"></i> Xuất
            </button>
            <button type="button" class="btn btn-outline-secondary me-2">
                <i class="fas fa-plus me-1"></i> Thêm sản phẩm
            </button>
          </div>
        </div>
        
        <!-- Products Table Card -->
        <div class="card">
          <div class="card-body">
            <!-- Filters -->
            <div class="row mb-4">
              <div class="col-md-3 mb-2">
                <select class="form-select">
                  <option selected>Tất cả danh mục</option>
                  <option>Sơn nội thất</option>
                  <option>Sơn ngoại thất</option>
                  <option>Sơn chống thấm</option>
                  <option>Sơn lót</option>
                </select>
              </div>
              <div class="col-md-3 mb-2">
                <select class="form-select">
                  <option selected>Tất cả trạng thái</option>
                  <option>Còn hàng</option>
                  <option>Sắp hết hàng</option>
                  <option>Hết hàng</option>
                </select>
              </div>
              <div class="col-md-3 mb-2">
                <select class="form-select">
                  <option selected>Tất cả nhà cung cấp</option>
                  <option>Sơn Dulux</option>
                  <option>Sơn Jotun</option>
                  <option>Sơn Nippon</option>
                  <option>Sơn Toa</option>
                </select>
              </div>
              <div class="col-md-3 mb-2">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Tìm sản phẩm...">
                  <button class="btn btn-outline-secondary" type="button">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
            
            <!-- Table -->
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Mã SP</th>
                    <th scope="col">Sản phẩm</th>
                    <th scope="col">Danh mục</th>
                    <th scope="col">Giá bán</th>
                    <th scope="col">Tồn kho</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>SP-001</td>
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="/api/placeholder/50/50" alt="Sơn nội thất" class="me-2">
                        <div>
                          <div class="product-title">Sơn nội thất cao cấp - Trắng 5L</div>
                          <div class="product-sku">SKU: SNT-TR-5L</div>
                        </div>
                      </div>
                    </td>
                    <td>Sơn nội thất</td>
                    <td>850,000 đ</td>
                    <td>56</td>
                    <td><span class="status-badge status-instock">Còn hàng</span></td>
                    <td>
                      <div class="d-flex">
                        <div class="action-icon">
                          <i class="fas fa-eye"></i>
                        </div>
                        <div class="action-icon">
                          <i class="fas fa-edit"></i>
                        </div>
                        <div class="action-icon">
                          <i class="fas fa-trash-alt"></i>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>SP-002</td>
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="/api/placeholder/50/50" alt="Sơn ngoại thất" class="me-2">
                        <div>
                          <div class="product-title">Sơn ngoại thất chống thấm - Xám 5L</div>
                          <div class="product-sku">SKU: SNCT-XM-5L</div>
                        </div>
                      </div>
                    </td>
                    <td>Sơn ngoại thất</td>
                    <td>950,000 đ</td>
                    <td>32</td>
                    <td><span class="status-badge status-instock">Còn hàng</span></td>
                    <td>
                      <div class="d-flex">
                        <div class="action-icon">
                          <i class="fas fa-eye"></i>
                        </div>
                        <div class="action-icon">
                          <i class="fas fa-edit"></i>
                        </div>
                        <div class="action-icon">
                          <i class="fas fa-trash-alt"></i>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>SP-003</td>
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="/api/placeholder/50/50" alt="Sơn lót" class="me-2">
                        <div>
                          <div class="product-title">Sơn lót chống kiềm - Trắng 5L</div>
                          <div class="product-sku">SKU: SL-CK-TR-5L</div>
                        </div>
                      </div>
                    </td>
                    <td>Sơn lót</td>
                    <td>750,000 đ</td>
                    <td>8</td>
                    <td><span class="status-badge status-lowstock">Sắp hết hàng</span></td>
                    <td>
                      <div class="d-flex">
                        <div class="action-icon">
                          <i class="fas fa-eye"></i>
                        </div>
                        <div class="action-icon">
                          <i class="fas fa-edit"></i>
                        </div>
                        <div class="action-icon">
                          <i class="fas fa-trash-alt"></i>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>SP-004</td>
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="/api/placeholder/50/50" alt="Sơn chống thấm" class="me-2">
                        <div>
                          <div class="product-title">Sơn chống thấm cao cấp - Đỏ 5L</div>
                          <div class="product-sku">SKU: SCT-D-5L</div>
                        </div>
                      </div>
                    </td>
                    <td>Sơn chống thấm</td>
                    <td>1,050,000 đ</td>
                    <td>0</td>
                    <td><span class="status-badge status-outofstock">Hết hàng</span></td>
                    <td>
                      <div class="d-flex">
                        <div class="action-icon">
                          <i class="fas fa-eye"></i>
                        </div>
                        <div class="action-icon">
                          <i class="fas fa-edit"></i>
                        </div>
                        <div class="action-icon">
                          <i class="fas fa-trash-alt"></i>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>SP-005</td>
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="/api/placeholder/50/50" alt="Sơn nội thất" class="me-2">
                        <div>
                          <div class="product-title">Sơn nội thất bóng - Kem 5L</div>
                          <div class="product-sku">SKU: SNT-B-K-5L</div>
                        </div>
                      </div>
                    </td>
                    <td>Sơn nội thất</td>
                    <td>890,000 đ</td>
                    <td>42</td>
                    <td><span class="status-badge status-instock">Còn hàng</span></td>
                    <td>
                      <div class="d-flex">
                        <div class="action-icon">
                          <i class="fas fa-eye"></i>
                        </div>
                        <div class="action-icon">
                          <i class="fas fa-edit"></i>
                        </div>
                        <div class="action-icon">
                          <i class="fas fa-trash-alt"></i>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
              <div class="pagination-info">
                Hiển thị 1-5 của 24 sản phẩm
              </div>
              <nav aria-label="Page navigation">
                <ul class="pagination">
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <li class="page-item active"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">4</a></li>
                  <li class="page-item"><a class="page-link" href="#">5</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>