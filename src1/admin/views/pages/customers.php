<?php
?>

<div class="row">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Quản lý khách hàng</h5>
            <div>
                <button class="btn btn-primary btn-sm mr-2"><i class="fas fa-plus mr-1"></i> Thêm khách hàng</button>
                <button class="btn btn-outline-secondary btn-sm mr-2"><i class="fas fa-file-export mr-1"></i> Xuất</button>
                <button class="btn btn-outline-secondary btn-sm"><i class="fas fa-share-alt mr-1"></i> Chia sẻ</button>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-bordered">
            <thead class="table-light">
                    <tr>
                        <th>Mã KH</th>
                        <th>Họ tên</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Nhóm khách hàng</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#KH001</td>
                        <td>Nguyễn Văn A</td>
                        <td>0912345678</td>
                        <td>nguyenvana@email.com</td>
                        <td>123 Đường Lê Lợi, Q.1, TP.HCM</td>
                        <td>Khách VIP</td>
                        <td><span class="badge badge-success">Hoạt động</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>#KH002</td>
                        <td>Trần Thị B</td>
                        <td>0923456789</td>
                        <td>tranthib@email.com</td>
                        <td>456 Đường Nguyễn Huệ, Q.1, TP.HCM</td>
                        <td>Khách thường xuyên</td>
                        <td><span class="badge badge-success">Hoạt động</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>#KH003</td>
                        <td>Lê Văn C</td>
                        <td>0934567890</td>
                        <td>levanc@email.com</td>
                        <td>789 Đường Trần Hưng Đạo, Q.5, TP.HCM</td>
                        <td>Khách thường xuyên</td>
                        <td><span class="badge badge-danger">Không hoạt động</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>#KH004</td>
                        <td>Phạm Thị D</td>
                        <td>0945678901</td>
                        <td>phamthid@email.com</td>
                        <td>101 Đường Hai Bà Trưng, Q.3, TP.HCM</td>
                        <td>Khách mới</td>
                        <td><span class="badge badge-warning">Chờ xác nhận</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>#KH005</td>
                        <td>Võ Văn E</td>
                        <td>0956789012</td>
                        <td>vovane@email.com</td>
                        <td>202 Đường Nguyễn Văn Cừ, Q.5, TP.HCM</td>
                        <td>Khách VIP</td>
                        <td><span class="badge badge-success">Hoạt động</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>#KH006</td>
                        <td>Đặng Thị F</td>
                        <td>0967890123</td>
                        <td>dangthif@email.com</td>
                        <td>303 Đường 3/2, Q.10, TP.HCM</td>
                        <td>Khách thường xuyên</td>
                        <td><span class="badge badge-success">Hoạt động</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>#KH007</td>
                        <td>Hồ Văn G</td>
                        <td>0978901234</td>
                        <td>hovang@email.com</td>
                        <td>404 Đường Cách Mạng Tháng 8, Q.3, TP.HCM</td>
                        <td>Khách mới</td>
                        <td><span class="badge badge-success">Hoạt động</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>#KH008</td>
                        <td>Lý Thị H</td>
                        <td>0989012345</td>
                        <td>lythih@email.com</td>
                        <td>505 Đường Nguyễn Thị Minh Khai, Q.1, TP.HCM</td>
                        <td>Khách mới</td>
                        <td><span class="badge badge-danger">Không hoạt động</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>