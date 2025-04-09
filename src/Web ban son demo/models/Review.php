<?php
class Review {
    public int $id;
    public int $user_id;
    public int $product_id;
    public int $rating;
    public string $comment;
    public string $created_at;

    public function __construct(array $data = []) {
        $this->id = (int)($data['id'] ?? 0);
        $this->user_id = (int)($data['user_id'] ?? 0);
        $this->product_id = (int)($data['product_id'] ?? 0);
        $this->rating = (int)($data['rating'] ?? 0);
        $this->comment = $data['comment'] ?? '';
        $this->created_at = $data['created_at'] ?? '';
    }
}
?>
