<link href="views/assets/css/product.css" rel="stylesheet">

<div class="row" id="productManagement">
    <div class="col-12">
        <div class="card shadow mb-4">
            <?php $action = $_GET['action'] ?? ''; ?>

            <?php if ($action === 'trash'): ?>
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h3 class="m-0 text-danger text-uppercase">Thùng rác sản phẩm</h3>
                    <a href="index.php?page=product" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Quay lại danh sách sản phẩm
                    </a>
                </div>
                <div class="card-body">
                    <?php include __DIR__ . '/products/listTrash.php'; ?>
                </div>
            <?php else: ?>
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h4 class="m-0 font-weight-bold text-primary text-uppercase">Danh sách sản phẩm</h4>
                    <div>
                        <button class="btn btn-success" onclick="openAddCategoryModal()">
                            <i class="fas fa-plus me-1"></i> Thêm danh mục
                        </button>
                        <button class="btn btn-primary" onclick="openAddProductModal()">
                            <i class="fas fa-plus me-1"></i> Thêm sản phẩm
                        </button>
                        <a href="index.php?page=product&action=trash" class="btn btn-outline-secondary">
                            <i class="fas fa-trash"></i> Thùng rác
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <?php include __DIR__ . '/products/listProduct.php'; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/products/modalProduct.php'; ?>
<?php include __DIR__ . '/products/modalCategory.php'; ?>
<script src="views/assets/js/product.js"></script>
<script src="views/assets/js/category.js"></script>
