<?php
$customers = $data['users'] ?? [];
?>

<div class="row" id="customerManagement">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h4 class="m-0 font-weight-bold text-primary text-uppercase">Danh sách khách hàng</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Mã KH</th>
                                <th>Tên khách hàng</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Ngày đăng ký</th>
                                <!-- <th>Thao tác</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($customers)): ?>
                                <?php foreach ($customers as $customer): ?>
                                    <tr>
                                        <td>#<?= htmlspecialchars($customer['id']) ?></td>
                                        <td><?= htmlspecialchars($customer['name'] ?? 'Không rõ') ?></td>
                                        <td><?= htmlspecialchars($customer['email'] ?? '-') ?></td>
                                        <td><?= htmlspecialchars($customer['phone'] ?? '-') ?></td>
                                        <td><?= htmlspecialchars($customer['address'] ?? '-') ?></td>
                                        <td><?= !empty($customer['created_at']) ? date('d/m/Y', strtotime($customer['created_at'])) : '-' ?>
                                        </td>
                                        <!-- <td>
                                    <button type="button" class="btn btn-sm btn-outline-primary me-1"
                                        data-id="<?= (int) $customer['id'] ?>"
                                        data-name="<?= htmlspecialchars($customer['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                        data-email="<?= htmlspecialchars($customer['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                        data-phone="<?= htmlspecialchars($customer['phone'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                        data-address="<?= htmlspecialchars($customer['address'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                        onclick="openEditCustomerModal(this)">
                                        <i class="fas fa-edit"></i> Sửa
                                    </button>

                                    <button class="btn btn-sm btn-outline-danger"
                                        onclick="confirmDeleteCustomer(<?= (int) $customer['id'] ?>)">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                </td> -->
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Không có khách hàng nào.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>