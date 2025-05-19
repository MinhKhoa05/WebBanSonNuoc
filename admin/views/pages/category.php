<link href="views/assets/css/category.css" rel="stylesheet">

<div class="row" id="productManagement">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Quản lý danh mục</h6>
                <button class="btn btn-primary" onclick="openAddCategoryModal()">
                    <i class="fas fa-plus me-1"></i> Thêm danh mục
                </button>
            </div>
            <div class="card-body">
                <?php include __DIR__ . '/categories/listCategory.php'; ?>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/categories/modalCategory.php'; ?>
<script src="views/assets/js/category.js"></script>