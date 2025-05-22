<?php
require_once __DIR__ . '/../../models/BaseModel.php';
require_once __DIR__ . '/../../models/ProductModel.php';
require_once __DIR__ . '/../../models/UserModel.php';
require_once __DIR__ . '/../../models/OrderModel.php';

// Khởi tạo các model
$productModel = new ProductModel();
$userModel = new UserModel();
$orderModel = new OrderModel();

// Lấy dữ liệu thống kê
$totalProducts = $productModel->count();
$totalUsers = $userModel->count();
$totalOrders = $orderModel->count();

// Lấy đơn hàng gần đây
$recentOrders = $orderModel->getRecentOrders(5);

// Lấy sản phẩm bán chạy
$topProducts = $productModel->getTopSellingProducts(4);

// Lấy số khách hàng mới
$newUsers = $userModel->getNewUsersCount();

// Lấy số sản phẩm hết hàng
$outOfStockProducts = $productModel->getOutOfStockCount();
?>

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
            <div class="card stats-card border-0 shadow h-100 py-2" style="border-left-color: #1cc88a !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Đơn hàng mới</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalOrders; ?></div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $newUsers; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card border-0 shadow h-100 py-2" style="border-left-color: #4e73df !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Tổng sản phẩm</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalProducts; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $outOfStockProducts; ?></div>
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
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Đơn hàng gần đây</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Ngày đặt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($recentOrders)): ?>
                            <?php foreach ($recentOrders as $order): ?>
                            <tr>
                                <td>#<?php echo $order['id']; ?></td>
                                <td><?php echo $order['customer_name']; ?></td>
                                <td><?php echo number_format($order['total']); ?> đ</td>
                                <td>
                                    <span class="badge bg-<?php echo $order['status'] == 'completed' ? 'success' : 'warning'; ?>">
                                        <?php echo $order['status'] == 'completed' ? 'Hoàn thành' : 'Đang xử lý'; ?>
                                    </span>
                                </td>
                                <td><?php echo date('d/m/Y', strtotime($order['order_date'])); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">Không có đơn hàng nào</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Top Selling Products -->
    <div class="row">
        <div class="col-lg mb-4">
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
                                <?php if (!empty($topProducts)): ?>
                                    <?php foreach ($topProducts as $product): ?>
                                    <tr>
                                        <td class="d-flex align-items-center">
                                            <div class="product-image me-2">
                                                <?php if (!empty($product['image'])): ?>
                                                    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                                <?php else: ?>
                                                    <i class="fas fa-paint-roller fa-2x text-primary"></i>
                                                <?php endif; ?>
                                            </div>
                                            <div>
                                                <div class="font-weight-bold"><?php echo $product['name']; ?></div>
                                                <div class="small text-muted"><?php echo $product['category_name']; ?></div>
                                            </div>
                                        </td>
                                        <td><?php echo $product['total_sold']; ?></td>
                                        <td><?php echo number_format($product['total_revenue']); ?> đ</td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center">Không có sản phẩm nào</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="views/assets/js/dashboard.js"></script>
</body>

</html>