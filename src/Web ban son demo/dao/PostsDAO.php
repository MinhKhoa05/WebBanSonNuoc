<?php
require_once '../models/Post.php';
require_once 'BaseDAO.php';

class PostDAO extends BaseDAO
{
    protected string $table = 'posts';

    public function insert($model)
    {
        $sql = "INSERT INTO {$this->table} 
            (title, content, author_id, category, status, thumbnail, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        pdo_execute($sql,
            $model->title,
            $model->content,
            $model->author_id,
            $model->category,
            $model->status,
            $model->thumbnail,
            $model->created_at,
            $model->updated_at
        );
    }

    public function update($id, $model)
    {
        $sql = "UPDATE {$this->table} SET 
            title = ?, 
            content = ?, 
            author_id = ?, 
            category = ?, 
            status = ?, 
            thumbnail = ?, 
            created_at = ?, 
            updated_at = ?
            WHERE id = ?";

        pdo_execute($sql,
            $model->title,
            $model->content,
            $model->author_id,
            $model->category,
            $model->status,
            $model->thumbnail,
            $model->created_at,
            $model->updated_at,
            $id
        );
    }

    public function get_by_author($authorId)
    {
        $sql = "SELECT * FROM {$this->table} WHERE author_id = ?";
        return pdo_query($sql, $authorId);
    }

    public function get_published_posts()
    {
        $sql = "SELECT * FROM {$this->table} WHERE status = 'published'";
        return pdo_query($sql);
    }
}
?>
