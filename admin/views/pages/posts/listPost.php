<?php
$posts = $data['posts'] ?? [];
?>

<div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Mã</th>
                <th>Hình ảnh</th>
                <th>Tiêu đề</th>
                <th>Loại</th>
                <th>Thời gian</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td>#<?= htmlspecialchars($post['id']) ?></td>
                        <td>
                            <?php if (!empty($post['thumbnail'])): ?>
                                <img src="../uploads/<?= htmlspecialchars($post['thumbnail']) ?>" class="img-thumbnail"
                                    alt="<?= htmlspecialchars($post['title']) ?>" style="max-width: 60px;">
                            <?php else: ?>
                                <span class="text-muted">Không có ảnh</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-start"><?= htmlspecialchars($post['title']) ?></td>
                        <td>
                            <span class="badge <?= ($post['category'] == 'news') ? 'bg-primary' : 'bg-info' ?>">
                                <?= ($post['category'] == 'news') ? 'Tin tức' : 'Blog' ?>
                            </span>
                        </td>
                        <td><?= date('d/m/Y H:i', strtotime($post['created_at'])) ?></td>
                        <td>
                            <form method="post" action="index.php?page=post&action=change_status" style="display:inline;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($post['id']) ?>">
                                <input type="hidden" name="status"
                                    value="<?= ($post['status'] == 'published') ? 'draft' : 'published' ?>">
                                <button type="submit"
                                    class="btn btn-sm <?= ($post['status'] == 'published') ? 'btn-success' : 'btn-warning' ?>">
                                    <?= ($post['status'] == 'published') ? 'Xuất bản' : 'Nháp' ?>
                                </button>
                            </form>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary btn-action me-1"
                                data-id="<?= (int) $post['id'] ?>"
                                data-title="<?= htmlspecialchars($post['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                data-content="<?= htmlspecialchars($post['content'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                data-category-id="<?= (int) ($post['category_id'] ?? 0) ?>"
                                data-category="<?= htmlspecialchars($post['category'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                data-status="<?= htmlspecialchars($post['status'] ?? 'draft', ENT_QUOTES, 'UTF-8') ?>"
                                data-thumbnail="<?= htmlspecialchars($post['thumbnail'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                onclick="openEditPostModal(this)">
                                <i class="fas fa-edit"></i> Sửa
                            </button>

                            <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete(<?= $post['id'] ?>)">
                                <i class="fas fa-trash"></i> Xóa
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center text-muted">Không có bài viết nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>