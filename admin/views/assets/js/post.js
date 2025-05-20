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

    window.openAddPostModal = function () {
        const modal = new bootstrap.Modal(document.getElementById('postModal'));
        const form = document.getElementById('postForm');

        form.action = 'index.php?page=post&action=add';
        form.reset();

        document.getElementById('postId').value = '';
        if (window.editor) {
            window.editor.setData('');
        }

        const currentImageEl = document.getElementById('currentPostImage');
        if (currentImageEl) {
            currentImageEl.style.display = 'none';
        }

        const submitBtn = document.getElementById('submitButton');
        if (submitBtn) {
            submitBtn.textContent = 'Thêm';
        }

        modal.show();
    };

    window.openEditPostModal = function (button) {
        const modal = new bootstrap.Modal(document.getElementById('postModal'));
        const form = document.getElementById('postForm');

        form.action = 'index.php?page=post&action=edit';

        // Lấy dữ liệu từ data-* attributes
        const id = button.dataset.id || '';
        const title = button.dataset.title || '';
        const content = button.dataset.content || '';
        const category = button.dataset.category || '';
        const status = button.dataset.status || '';
        const thumbnail = button.dataset.thumbnail || '';

        document.getElementById('postId').value = id;
        document.getElementById('postTitle').value = title;
        setEditorDataWhenReady(content);
        document.getElementById('postType').value = category;
        document.getElementById('postStatus').value = status;

        const img = document.getElementById('currentPostImage');
        if (img) {
            if (thumbnail) {
                img.src = '../uploads/' + thumbnail;
                img.style.display = 'block';
            } else {
                img.src = '';
                img.style.display = 'none';
            }
        }

        const submitBtn = document.getElementById('submitButton');
        if (submitBtn) {
            submitBtn.textContent = 'Lưu thay đổi';
        }

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

function setEditorDataWhenReady(data) {
    const safeData = typeof data === 'string' ? data : '';

    if (window.editor) {
        window.editor.setData(safeData);
    } else {
        setTimeout(() => setEditorDataWhenReady(safeData), 100);
    }
}