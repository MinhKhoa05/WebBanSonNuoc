<link href="views/assets/css/post.css" rel="stylesheet">

<div class="row" id="postManagement">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h4 class="m-0 font-weight-bold text-primary text-uppercase">Quản lý bài viết</h4>
                <button class="btn btn-primary" onclick="openAddPostModal()">
                    <i class="fas fa-plus me-1"></i> Thêm bài viết
                </button>
            </div>
            <div class="card-body">
                <?php include __DIR__ . '/posts/listPost.php'; ?>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/posts/modalPost.php'; ?>
<script src="views/assets/js/post.js"></script>