<link rel="stylesheet" href="views/assets/css/brand.css">

<div class="row" id="brandManagement">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h4 class="m-0 font-weight-bold text-primary text-uppercase">Danh sách thương hiệu</h4>
                <button class="btn btn-primary" onclick="openAddBrandModal()">
                    <i class="fas fa-plus me-1"></i> Thêm thương hiệu
                </button>
            </div>
            <div class="card-body">
                <?php include __DIR__ . '/brands/listBrand.php'; ?>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/brands/modalBrand.php'; ?>
<script src="views/assets/js/brand.js"></script>