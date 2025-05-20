<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="plugins/ckeditor/ckeditor.js"></script>
</head>

<body>
    <form>
        <textarea name="editor" id="editor" rows="10" cols="80">
            This is my textarea to be replaced with CKEditor 4.
        </textarea>
        <script>
            CKEDITOR.replace('editor');
        </script>
    </form>
</body>

</html> -->

<link href="views/assets/css/post.css" rel="stylesheet">

<div class="row" id="postManagement">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Quản lý bài viết</h6>
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