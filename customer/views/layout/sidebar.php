<!-- Sidebar -->
<div class="card card-sidebar border-0 shadow-sm mt-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">DANH MỤC SẢN PHẨM</h5>
    </div>
    <div class="card-body p-0">
        <ul class="list-group list-group-flush">
            <?php foreach ($categories as $cat): ?>
                <li class="list-group-item">
                    <a href="#category-<?= htmlspecialchars($cat['id']) ?>" class="sidebar-link">
                        <i class="fa fa-angle-double-right text-danger me-2"></i>
                        <?= htmlspecialchars($cat['name']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<!-- Price Filter -->
<!-- <div class="card card-price border-0 shadow-sm mt-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Lọc theo giá</h5>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="priceRange">Khoảng giá:</label>
            <input type="range" class="form-range" id="priceRange" min="0" max="10000000" step="100000" value="5000000">
            <div class="d-flex justify-content-between">
                <span>0đ</span>
                <span id="priceValue">5,000,000đ</span>
                <span>10,000,000đ</span>
            </div>
        </div>
        <button id="applyPriceFilter" class="btn btn-sm btn-primary w-100 mt-2">Áp dụng</button>
    </div>
</div> -->