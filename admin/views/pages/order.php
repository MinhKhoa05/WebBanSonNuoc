<link href="views/assets/css/order.css" rel="stylesheet">

<div class="row" id="orderManagement">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h4 class="m-0 font-weight-bold text-primary text-uppercase">Quản lý đơn hàng</h4>
                <button class="btn btn-primary" onclick="openAddOrderModal()">
                    <i class="fas fa-plus me-1"></i> Thêm đơn hàng
                </button>
            </div>
            <div class="card-body">
                <?php include __DIR__ . '/orders/listOrder.php'; ?>
            </div>
        </div>
    </div>
</div>

<script src="views/assets/js/order.js"></script>
