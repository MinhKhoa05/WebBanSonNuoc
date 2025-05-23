<?php
echo "<!-- DEBUG: setting.php loaded -->";
$banners = $data['banners'] ?? [];
?>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Cài đặt 6 Banner trang Khách hàng</h5>
                </div>
                <div class="card-body">
                    <?php if (isset($_GET['success'])): ?>
                        <div class="alert alert-success">Cập nhật banner thành công!</div>
                    <?php endif; ?>
                    <form method="post" action="index.php?page=setting&action=updateBanner" enctype="multipart/form-data">
                        <?php for ($i = 1; $i <= 8; $i++): ?>
                        <div class="mb-3">
                            <label for="banner_<?= $i ?>" class="form-label">Banner <?= $i ?> (HTML hoặc text hoặc upload ảnh):</label>
                            <textarea name="banner_<?= $i ?>" id="banner_<?= $i ?>" class="form-control" rows="3"><?= htmlspecialchars($banners[$i-1] ?? '') ?></textarea>
                            <input type="file" name="banner_img_<?= $i ?>" class="form-control mt-2" accept="image/*">
                            <?php if (!empty($banners[$i-1]) && !preg_match('/^(http|https):\\/\\//', $banners[$i-1]) && strpos($banners[$i-1], '/') === false): ?>
                                <img src="uploads/<?= htmlspecialchars($banners[$i-1]) ?>" alt="Banner <?= $i ?>" style="max-width: 100%; margin-top: 10px;">
                            <?php elseif (!empty($banners[$i-1]) && filter_var($banners[$i-1], FILTER_VALIDATE_URL)): ?>
                                <img src="<?= htmlspecialchars($banners[$i-1]) ?>" alt="Banner <?= $i ?>" style="max-width: 100%; margin-top: 10px;">
                            <?php endif; ?>
                        </div>
                        <?php endfor; ?>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 