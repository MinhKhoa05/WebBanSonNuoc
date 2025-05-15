<div class="row top-bar">
    <div class="col">
        <div class="d-flex justify-content-between align-items-center">
            <div class="search-container">
                <input type="search" class="form-control" placeholder="Tìm kiếm..." aria-label="Search">
            </div>
            <div class="d-flex align-items-center">
                <div class="dropdown d-inline-block me-2">
                    <button class="btn btn-light dropdown-toggle" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span class="badge bg-danger">2</span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="notificationDropdown">
                        <li><a class="dropdown-item" href="#">Thông báo mới về đơn hàng</a></li>
                        <li><a class="dropdown-item" href="#">Sản phẩm sắp hết hàng</a></li>
                    </ul>
                </div>
                <div class="dropdown d-inline-block">
                    <button class="btn btn-light dropdown-toggle" type="button" id="adminDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user me-1"></i>
                        Admin
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                        <li><a class="dropdown-item" href="#">Thông tin cá nhân</a></li>
                        <li><a class="dropdown-item" href="#">Đổi mật khẩu</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="customer/controllers/userController.php?action=logout">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>