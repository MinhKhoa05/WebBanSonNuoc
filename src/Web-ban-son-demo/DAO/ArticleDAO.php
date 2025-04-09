<?php
require_once '../models/Article.php';
require_once 'BaseDAO.php';

class ArticleDAO extends BaseDAO
{
    protected string $table = 'articles';

    public function insert($model)
    {
        $sql = "INSERT INTO {$this->table} 
            (title, content, author_id, category, thumbnail, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

        pdo_execute($sql,
            $model->title,
            $model->content,
            $model->author_id,
            $model->category,
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
            thumbnail = ?, 
            created_at = ?, 
            updated_at = ?
            WHERE id = ?";

        pdo_execute($sql,
            $model->title,
            $model->content,
            $model->author_id,
            $model->category,
            $model->thumbnail,
            $model->created_at,
            $model->updated_at,
            $id
        );
    }

    public function select_by_author($authorId): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE author_id = ?";
        return pdo_query($sql, $authorId);
    }

    public function select_recent($limit = 5): array
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY created_at DESC LIMIT ?";
        return pdo_query($sql, (int) $limit);
    }
}
?>
