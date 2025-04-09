<?php
require_once '../models/Feedback.php';
require_once 'BaseDAO.php';

class FeedbackDAO extends BaseDAO
{
    protected string $table = 'feedback';

    public function insert($model)
    {
        $sql = "INSERT INTO {$this->table} (user_id, subject, comment, created_at) 
                VALUES (?, ?, ?, ?)";
        pdo_execute($sql, $model->user_id, $model->subject, $model->comment, $model->created_at);
    }

    public function update($id, $model)
    {
        $sql = "UPDATE {$this->table} SET 
                    user_id = ?, 
                    subject = ?, 
                    comment = ?, 
                    created_at = ?
                WHERE id = ?";
        pdo_execute($sql, $model->user_id, $model->subject, $model->comment, $model->created_at, $id);
    }

    public function get_by_user_id($userId): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = ?";
        return pdo_query($sql, $userId);
    }
}
?>
