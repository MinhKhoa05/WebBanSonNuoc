<?php
// filepath: c:\xampp\htdocs\WebBanSonLuc\views\pages\customer\product-detail.php
require_once __DIR__ . '/../../../models/product.php';

// Lấy ID sản phẩm từ URL
$productId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Lấy thông tin sản phẩm từ cơ sở dữ liệu
$product = product_select_by_id($productId);

// Kiểm tra nếu sản phẩm không tồn tại
if (!$product) {
    echo "<h2 class='text-center text-danger'>Sản phẩm không tồn tại!</h2>";
    exit;
}
?>
<link rel="stylesheet" href="customer/views/assets/css/product-details.css">

<body>
    <div class="container py-5 my-5">
        <div class="product-detail shadow row">
            <!-- Hình ảnh sản phẩm -->
            <div class="col-md-4">
                <div class="card">
                    <img id="mainImage" src="uploads/<?= htmlspecialchars($product['thumbnail']) ?>"
                        alt="<?= htmlspecialchars($product['name']) ?>" class="card-img-top img-fluid">
                </div>
                <!-- Gallery -->
                <div class="mt-3 d-flex justify-content-center">
                    <?php
                    // Giả sử bạn có thêm các hình ảnh khác trong mảng `$product['gallery']`
                    $gallery = isset($product['gallery']) ? $product['gallery'] : [];
                    foreach ($gallery as $image): ?>
                        <img src="uploads/<?= htmlspecialchars($image) ?>" alt="Gallery Image"
                            class="img-thumbnail mx-2 gallery-image" style="width: 80px; height: 80px; cursor: pointer;">
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Thông tin sản phẩm -->
            <div class="col-md-8 mb-4">
                <h1 class="text-primary"><?= htmlspecialchars($product['name']) ?></h1>
                <p class="text-danger fw-bold fs-4"><?= number_format($product['price'], 0, ',', '.') ?>₫</p>
                <p class="text-muted"><?= htmlspecialchars($product['description']) ?></p>

                <!-- Nút thêm vào giỏ hàng -->
                <form action="customer/controllers/cartController.php?action=add" method="POST">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <div class="d-flex align-items-center mb-3">
                        <label for="quantity" class="me-2">Số lượng:</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" class="form-control"
                            style="width: 80px;">
                    </div>
                    <div class="d-flex flex-column gap-2" style="max-width: 300px;">
                        <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-cart-plus me-2"></i> Thêm vào giỏ hàng
                        </button>

                        <button type="button" class="btn btn-success w-100 d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#zaloModal">
                            <img src="https://stc-zaloprofile.zdn.vn/pc/v1/images/zalo_sharelogo.png" alt="Zalo" style="width: 24px; height: 24px; margin-right: 8px;">
                            Tư vấn qua Zalo
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Mô tả chi tiết -->
        <div class="container product-description shadow">
            <div>
                <h3 class="text-primary">Mô tả sản phẩm</h3>
                <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
            </div>
        </div>

    </div>

    <!-- Modal QR Zalo -->
    <div class="modal fade" id="zaloModal" tabindex="-1" aria-labelledby="zaloModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
          <div class="modal-header">
            <h5 class="modal-title w-100" id="zaloModalLabel">Quét mã QR Zalo để tư vấn</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
          </div>
          <div class="modal-body">
            <img src="customer/views/assets/images/zalome.jpg" alt="QR Zalo" style="max-width: 250px; width: 100%;">
            <p class="mt-2">Mở Zalo, chọn quét mã QR để kết nối với shop!</p>
          </div>
        </div>
      </div>
    </div>

    <script src="customer/views/assets/js/product-details.js"></script>
</body>

</html>