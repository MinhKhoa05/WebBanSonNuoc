<?php
require_once __DIR__ . '/../../../models/category.php';
require_once __DIR__ . '/../../../models/product.php';

require_once __DIR__ . '/../../controllers/productController.php';

// Lấy danh sách danh mục
$products = product_select_all();
$totalproducts = product_count_all();

$categories = category_select_all();
?>

<link rel="stylesheet" href="admin/views/assets/css/admin.css">

<body>
  <!-- Modal Thêm Sản Phẩm -->
  <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="addProductForm" method="POST" action="admin.php?page=product&action=add" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="addProductModalLabel">Thêm sản phẩm</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="productName" class="form-label">Tên sản phẩm</label>
              <input type="text" class="form-control" id="productName" name="name" required>
            </div>
            <div class="mb-3">
              <label for="productDescription" class="form-label">Mô tả</label>
              <textarea class="form-control" id="productDescription" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
              <label for="productCategory" class="form-label">Danh mục</label>
              <select class="form-select" id="productCategory" name="category_id" required>
                <?php foreach ($categories as $category): ?>
                  <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="productPrice" class="form-label">Giá bán</label>
              <input type="number" class="form-control" id="productPrice" name="price" required>
            </div>
            <div class="mb-3">
              <label for="productDiscount" class="form-label">Giảm giá (%)</label>
              <input type="number" class="form-control" id="productDiscount" name="discount">
            </div>
            <div class="mb-3">
              <label for="productStock" class="form-label">Tồn kho</label>
              <input type="number" class="form-control" id="productStock" name="stock" required>
            </div>
            <div class="mb-3">
              <label for="productStatus" class="form-label">Trạng thái</label>
              <select class="form-select" id="productStatus" name="status" required>
                <option value="1">Còn hàng</option>
                <option value="0">Hết hàng</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="productImage" class="form-label">Hình ảnh</label>
              <input type="file" class="form-control" id="productImage" name="thumbnail" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            <button type="submit" class="btn btn-primary">Thêm</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal sửa sản phẩm -->
  <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="editProductForm" method="POST" action="admin.php?page=product&action=edit" enctype="multipart/form-data">
          <input type="hidden" id="editProductId" name="id">
          <div class="modal-header">
            <h5 class="modal-title" id="editProductModalLabel">Sửa sản phẩm</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="editProductName" class="form-label">Tên sản phẩm</label>
              <input type="text" class="form-control" id="editProductName" name="name" required>
            </div>
            <div class="mb-3">
              <label for="editProductDescription" class="form-label">Mô tả</label>
              <textarea class="form-control" id="editProductDescription" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
              <label for="editProductCategory" class="form-label">Danh mục</label>
              <select class="form-select" id="editProductCategory" name="category_id" required>
                <?php foreach ($categories as $category): ?>
                  <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="editProductPrice" class="form-label">Giá bán</label>
              <input type="number" class="form-control" id="editProductPrice" name="price" required>
            </div>
            <div class="mb-3">  
              <label for="editProductDiscount" class="form-label">Giảm giá (%)</label>
              <input type="number" class="form-control" id="editProductDiscount" name="discount">
            </div>
            <div class="mb-3">
              <label for="editProductStock" class="form-label">Tồn kho</label>
              <input type="number" class="form-control" id="editProductStock" name="stock" required>
            </div>
            <div class="mb-3">
              <label for="editProductStatus" class="form-label">Trạng thái</label>
              <select class="form-select" id="editProductStatus" name="status" required>
                <option value="1">Còn hàng</option>
                <option value="0">Hết hàng</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="editProductImage" class="form-label">Hình ảnh</label>
              <input type="file" class="form-control" id="editProductImage" name="thumbnail">
              <div class="mt-2">
                <img id="currentProductImage" src="" alt="Hình ảnh hiện tại" style="max-width: 100px; max-height: 100px;">
                <input type="hidden" name="current_thumbnail" id="currentThumbnail">
                <div class="form-text">Để trống nếu không muốn thay đổi hình ảnh</div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal xác nhận xóa sản phẩm -->
  <div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteProductModalLabel">Xác nhận xóa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Bạn có chắc chắn muốn xóa sản phẩm <strong id="deleteProductName"></strong>?</p>
          <p class="text-danger">Hành động này không thể hoàn tác.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
          <form id="deleteProductForm" method="POST" action="admin.php?page=product&action=delete">
            <input type="hidden" id="deleteProductId" name="id">
            <button type="submit" class="btn btn-danger">Xóa</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->

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

      <!--Section Product Management Preview -->

    </div>
  </div>

  <script src="admin/views/assets/js/general.js"></script>
</body>

</html>