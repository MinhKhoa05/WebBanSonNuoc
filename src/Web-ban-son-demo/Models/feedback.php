<?php
class Feedback {
    public int $id;
    public int $user_id;
    public string $subject;
    public string $comment;
    public string $created_at;

    public function __construct(array $data = []) {
        $this->id = (int)($data['id'] ?? 0);
        $this->user_id = (int)($data['user_id'] ?? 0);
        $this->subject = $data['subject'] ?? '';
        $this->comment = $data['comment'] ?? '';
        $this->created_at = $data['created_at'] ?? '';
    }
}
?>
