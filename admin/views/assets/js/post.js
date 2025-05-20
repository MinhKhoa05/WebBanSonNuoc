document.addEventListener('DOMContentLoaded', function () {
    // Khởi tạo CKEditor cho textarea
    if (document.getElementById('postContent')) {
        ClassicEditor
            .create(document.getElementById('postContent'), {
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'fontFamily',
                        'fontSize',
                        'fontColor',
                        'fontBackgroundColor',
                        '|',
                        'bold',
                        'italic',
                        'underline',
                        'strikethrough',
                        'link',
                        '|',
                        'alignment',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'indent',
                        'outdent',
                        '|',
                        'imageUpload',
                        'blockQuote',
                        'insertTable',
                        'mediaEmbed',
                        'undo',
                        'redo'
                    ]
                },
                language: 'vi',
                image: {
                    toolbar: [
                        'imageTextAlternative',
                        'imageStyle:full',
                        'imageStyle:side'
                    ]
                },
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells'
                    ]
                },
                licenseKey: '',
            })
            .then(editor => {
                console.log('CKEditor đã khởi tạo thành công');
                window.editor = editor;
            })
            .catch(error => {
                console.error('Lỗi khi khởi tạo CKEditor:', error);
            });
    }

    // Hàm mở modal thêm bài viết
    window.openAddPostModal = function () {
        const modal = new bootstrap.Modal(document.getElementById('postModal'));
        const form = document.getElementById('postForm');

        form.action = 'index.php?page=post&action=add';
        form.reset();

        document.getElementById('postId').value = '';
        if (window.editor) {
            window.editor.setData('');
        }

        document.getElementById('currentPostImage').style.display = 'none';
        document.getElementById('imageHelpText').textContent = 'Bắt buộc với thêm mới, để trống nếu không thay đổi hình ảnh khi sửa.';
        document.getElementById('submitButton').textContent = 'Thêm';

        modal.show();
    };

    // Hàm mở modal chỉnh sửa bài viết (Trong trường hợp sửa từ modal)
    window.openEditPostModal = function (id, title, content, category_id, category, status, thumbnail) {
        const modal = new bootstrap.Modal(document.getElementById('postModal'));
        const form = document.getElementById('postForm');

        form.action = 'index.php?page=post&action=edit';

        document.getElementById('postId').value = id;
        document.getElementById('postTitle').value = title;
        
        if (window.editor) {
            window.editor.setData(content);
        } else {
            document.getElementById('postContent').value = content;
        }
        
        document.getElementById('postCategory').value = category_id;
        document.getElementById('postType').value = category;
        document.getElementById('postStatus').value = status;

        const img = document.getElementById('currentPostImage');
        if (thumbnail) {
            img.src = '../uploads/' + thumbnail;
            img.style.display = 'block';
            document.getElementById('imageHelpText').textContent = 'Để trống nếu không thay đổi hình ảnh';
        } else {
            img.style.display = 'none';
            img.src = '';
            document.getElementById('imageHelpText').textContent = 'Bạn có thể thêm hình ảnh cho bài viết';
        }

        document.getElementById('submitButton').textContent = 'Lưu thay đổi';

        modal.show();
    };

    // Hàm xác nhận xóa bài viết
    window.confirmDelete = function (id) {
        Swal.fire({
            title: 'Bạn có chắc muốn xóa bài viết này?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Có, xóa nó!',
            cancelButtonText: 'Hủy',
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'index.php?page=post&action=soft_delete';
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'id';
                input.value = id;
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        });
    };
});