<?php
$posts = $data['posts'] ?? [];
?>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    <?php if (!empty($posts)): ?>
        <?php foreach ($posts as $post): ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <?php if (!empty($post['thumbnail'])): ?>
                        <img src="../uploads/<?= htmlspecialchars($post['thumbnail']) ?>" 
                             class="card-img-top" alt="<?= htmlspecialchars($post['title']) ?>" style="height: 180px; object-fit: cover;">
                    <?php else: ?>
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center" 
                             style="height: 180px;">
                            <small>Không có ảnh</small>
                        </div>
                    <?php endif; ?>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title" title="<?= htmlspecialchars($post['title']) ?>">
                            <?= htmlspecialchars(mb_strimwidth($post['title'], 0, 40, '...')) ?>
                        </h5>
                        <p class="card-text flex-grow-1" style="font-size: 0.9rem; color: #555;">
                            <?= htmlspecialchars(mb_strimwidth(strip_tags($post['content']), 0, 100, '...')) ?>
                        </p>
                        <div class="mb-2">
                            <span class="badge <?= ($post['category'] == 'news') ? 'bg-primary' : 'bg-info' ?>">
                                <?= ($post['category'] == 'news') ? 'Tin tức' : 'Blog' ?>
                            </span>
                            <span class="badge <?= ($post['status'] == 'published') ? 'bg-success' : 'bg-secondary' ?> ms-1">
                                <?= ($post['status'] == 'published') ? 'Xuất bản' : 'Nháp' ?>
                            </span>
                        </div>
                        <small class="text-muted mb-3">
                            <time datetime="<?= htmlspecialchars($post['created_at']) ?>" 
                                  title="<?= date('d/m/Y H:i:s', strtotime($post['created_at'])) ?>">
                                <?= date('d/m/Y H:i', strtotime($post['created_at'])) ?>
                            </time>
                        </small>
                        <div>
                            <button type="button" class="btn btn-sm btn-outline-primary me-1"
                                data-id="<?= (int)$post['id'] ?>"
                                data-title="<?= htmlspecialchars($post['title']) ?>"
                                data-content="<?= htmlspecialchars($post['content']) ?>"
                                data-category="<?= htmlspecialchars($post['category']) ?>"
                                data-status="<?= htmlspecialchars($post['status'] ?? 'draft') ?>"
                                data-thumbnail="<?= htmlspecialchars($post['thumbnail']) ?>"
                                onclick="openEditPostModal(this)">
                                <i class="fas fa-edit"></i> Sửa
                            </button>
                            <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete(<?= (int)$post['id'] ?>)">
                                <i class="fas fa-trash"></i> Xóa
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12">
            <p class="text-center text-muted fst-italic">Chưa có bài viết nào.</p>
        </div>
    <?php endif; ?>
</div>
