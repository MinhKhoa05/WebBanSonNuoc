<link href="views/assets/css/product.css" rel="stylesheet">

<div class="row" id="productManagement">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Quản lý sản phẩm</h6>
                <button class="btn btn-primary" onclick="openAddProductModal()">
                    <i class="fas fa-plus me-1"></i> Thêm sản phẩm
                </button>
            </div>
            <div class="card-body">
                <?php include __DIR__ . '/products/listProduct.php'; ?>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/products/modalProduct.php'; ?>
<script src="views/assets/js/product.js"></script>