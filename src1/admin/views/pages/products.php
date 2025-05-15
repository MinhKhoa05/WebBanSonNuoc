<?php
require_once __DIR__ . '/../../../models/category.php';
require_once __DIR__ . '/../../../models/product.php';

require_once __DIR__ . '/../../controllers/productController.php';

// Lấy danh sách danh mục
$products = product_select_all();
$totalproducts = product_count_all();

$categories = category_select_all();
?>
<style>
  .img-thumbnail {
    width: 100px;
    height: 100px;
    object-fit: cover;
  }

  .modal-body img {
    max-width: 100%;
    height: auto;
  }
</style>
<!-- Modal Thêm Sản Phẩm -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="addProductForm" method="POST" action="admin.php?page=product&action=add" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="addProductModalLabel">Thêm sản phẩm</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="productName" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="productName" name="name" required>
          </div>
          <div class="mb-3">
            <label for="productDescription" class="form-label">Mô tả</label>
            <textarea class="form-control" id="productDescription" name="description" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="productCategory" class="form-label">Danh mục</label>
            <select class="form-select" id="productCategory" name="category_id" required>
              <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="productPrice" class="form-label">Giá bán</label>
            <input type="number" class="form-control" id="productPrice" name="price" required>
          </div>
          <div class="mb-3">
            <label for="productDiscount" class="form-label">Giảm giá (%)</label>
            <input type="number" class="form-control" id="productDiscount" name="discount">
          </div>
          <div class="mb-3">
            <label for="productStock" class="form-label">Tồn kho</label>
            <input type="number" class="form-control" id="productStock" name="stock" required>
          </div>
          <div class="mb-3">
            <label for="productStatus" class="form-label">Trạng thái</label>
            <select class="form-select" id="productStatus" name="status" required>
              <option value="1">Còn hàng</option>
              <option value="0">Hết hàng</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="productImage" class="form-label">Hình ảnh</label>
            <input type="file" class="form-control" id="productImage" name="thumbnail" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
          <button type="submit" class="btn btn-primary">Thêm</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal sửa sản phẩm -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editProductForm" method="POST" action="admin.php?page=product&action=edit" enctype="multipart/form-data">
        <input type="hidden" id="editProductId" name="id">
        <div class="modal-header">
          <h5 class="modal-title" id="editProductModalLabel">Sửa sản phẩm</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="editProductName" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="editProductName" name="name" required>
          </div>
          <div class="mb-3">
            <label for="editProductDescription" class="form-label">Mô tả</label>
            <textarea class="form-control" id="editProductDescription" name="description" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="editProductCategory" class="form-label">Danh mục</label>
            <select class="form-select" id="editProductCategory" name="category_id" required>
              <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="editProductPrice" class="form-label">Giá bán</label>
            <input type="number" class="form-control" id="editProductPrice" name="price" required>
          </div>
          <div class="mb-3">
            <label for="editProductDiscount" class="form-label">Giảm giá (%)</label>
            <input type="number" class="form-control" id="editProductDiscount" name="discount">
          </div>
          <div class="mb-3">
            <label for="editProductStock" class="form-label">Tồn kho</label>
            <input type="number" class="form-control" id="editProductStock" name="stock" required>
          </div>
          <div class="mb-3">
            <label for="editProductStatus" class="form-label">Trạng thái</label>
            <select class="form-select" id="editProductStatus" name="status" required>
              <option value="1">Còn hàng</option>
              <option value="0">Hết hàng</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="editProductImage" class="form-label">Hình ảnh</label>
            <input type="file" class="form-control" id="editProductImage" name="thumbnail">
            <div class="mt-2">
              <img id="currentProductImage" src="" alt="Hình ảnh hiện tại" style="max-width: 100px; max-height: 100px;">
              <input type="hidden" name="current_thumbnail" id="currentThumbnail">
              <div class="form-text">Để trống nếu không muốn thay đổi hình ảnh</div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
          <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal xác nhận xóa sản phẩm -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteProductModalLabel">Xác nhận xóa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Bạn có chắc chắn muốn xóa sản phẩm <strong id="deleteProductName"></strong>?</p>
        <p class="text-danger">Hành động này không thể hoàn tác.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <form id="deleteProductForm" method="POST" action="admin.php?page=product&action=delete">
          <input type="hidden" id="deleteProductId" name="id">
          <button type="submit" class="btn btn-danger">Xóa</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Product Management Preview -->
<div class="row" id="productManagement">
  <div class="col-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Quản lý sản phẩm</h6>
        <button class="btn btn-primary align-item-right me-2" data-bs-toggle="modal" data-bs-target="#addProductModal">
          <i class="fas fa-plus me-1"></i> Thêm sản phẩm
        </button>
        <div class="btn-group">
          <button class="btn btn-outline-secondary">
            <i class="fas fa-share-alt me-1"></i> Chia sẻ
          </button>
          <button class="btn btn-outline-secondary">
            <i class="fas fa-download me-1"></i> Xuất
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
            <thead class="table-light">
              <tr>
                <th>Mã SP</th>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Giá bán</th>
                <th>Tồn kho</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product): ?>
                <tr>
                  <td>#<?= $product['id'] ?></td>
                  <td>
                    <img src="/uploads/<?= htmlspecialchars($product['thumbnail']) ?>" class="img-thumbnail" alt="<?= htmlspecialchars($product['name']) ?>">
                  </td>
                  <td><?= htmlspecialchars($product['name']) ?></td>
                  <td><?= htmlspecialchars($product['category_name']) ?></td>
                  <td><?= number_format($product['price'], 0, ',', '.') ?> đ</td>
                  <td><?= $product['stock'] ?></td>
                  <td>
                    <?php if ($product['status']): ?>
                      <span class="badge bg-success">Còn hàng</span>
                    <?php else: ?>
                      <span class="badge bg-danger">Hết hàng</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <!-- Nút sửa sản phẩm -->
                    <button type="button" class="btn btn-sm btn-outline-primary me-1"
                      data-bs-toggle="modal"
                      data-bs-target="#editProductModal"
                      data-id="<?= $product['id'] ?>"
                      data-name="<?= htmlspecialchars($product['name']) ?>"
                      data-description="<?= htmlspecialchars($product['description']) ?>"
                      data-price="<?= $product['price'] ?>"
                      data-discount="<?= $product['discount'] ?>"
                      data-stock="<?= $product['stock'] ?>"
                      data-status="<?= $product['status'] ?>"
                      data-category="<?= $product['category_id'] ?>"
                      data-thumbnail="<?= $product['thumbnail'] ?>">
                      <i class="fas fa-edit"></i>
                    </button>

                    <!-- Nút xóa sản phẩm -->
                    <button type="button" class="btn btn-sm btn-outline-danger"
                      data-bs-toggle="modal"
                      data-bs-target="#deleteProductModal"
                      data-id="<?= $product['id'] ?>"
                      data-name="<?= htmlspecialchars($product['name']) ?>">
                      <i class="fas fa-trash"></i>
                    </button>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Pagination -->
<div class="d-flex justify-content-between align-items-center flex-wrap">
  <div class="mb-3 mb-md-0">Hiển thị 1-5 của 124 sản phẩm</div>
  <nav>
    <ul class="pagination mb-0">
      <li class="page-item disabled">
        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Trước</a>
      </li>
      <li class="page-item active"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link" href="#">Tiếp</a>
      </li>
    </ul>
  </nav>
</div>

<!-- JavaScript để điều khiển modals - đặt ở cuối trang -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Xử lý modal sửa sản phẩm
    const editProductModal = document.getElementById('editProductModal');
    if (editProductModal) {
      editProductModal.addEventListener('show.bs.modal', function(event) {
        // Lấy button đã kích hoạt modal
        const button = event.relatedTarget;

        // Trích xuất thông tin sản phẩm từ thuộc tính data
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const description = button.getAttribute('data-description');
        const price = button.getAttribute('data-price');
        const discount = button.getAttribute('data-discount');
        const stock = button.getAttribute('data-stock');
        const status = button.getAttribute('data-status');
        const category = button.getAttribute('data-category');
        const thumbnail = button.getAttribute('data-thumbnail');

        // Cập nhật nội dung của modal
        const modalForm = editProductModal.querySelector('#editProductForm');
        modalForm.querySelector('#editProductId').value = id;
        modalForm.querySelector('#editProductName').value = name;
        modalForm.querySelector('#editProductDescription').value = description;
        modalForm.querySelector('#editProductPrice').value = price;
        modalForm.querySelector('#editProductDiscount').value = discount || 0;
        modalForm.querySelector('#editProductStock').value = stock;
        modalForm.querySelector('#editProductStatus').value = status;
        modalForm.querySelector('#editProductCategory').value = category;
        modalForm.querySelector('#currentThumbnail').value = thumbnail;

        // Hiển thị hình ảnh hiện tại
        const imgElement = modalForm.querySelector('#currentProductImage');
        imgElement.src = '../uploads/' + thumbnail;
        imgElement.alt = name;
      });
    }

    // Xử lý modal xóa sản phẩm
    const deleteProductModal = document.getElementById('deleteProductModal');
    if (deleteProductModal) {
      deleteProductModal.addEventListener('show.bs.modal', function(event) {
        // Lấy button đã kích hoạt modal
        const button = event.relatedTarget;

        // Trích xuất thông tin
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');

        // Cập nhật nội dung của modal
        deleteProductModal.querySelector('#deleteProductId').value = id;
        deleteProductModal.querySelector('#deleteProductName').textContent = name;
      });
    }
  });
</script>
<!-- Bootstrap Bundle with Popper -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> -->