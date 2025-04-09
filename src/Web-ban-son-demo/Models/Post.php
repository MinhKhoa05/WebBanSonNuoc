<?php
class Post {
    public int $id;
    public string $title;
    public string $content;
    public int $author_id;
    public string $category;
    public string $status;
    public string $thumbnail;
    public string $created_at;
    public string $updated_at;

    public function __construct(array $data = []) {
        $this->id = (int)($data['id'] ?? 0);
        $this->title = $data['title'] ?? '';
        $this->content = $data['content'] ?? '';
        $this->author_id = (int)($data['author_id'] ?? 0);
        $this->category = $data['category'] ?? '';
        $this->status = $data['status'] ?? '';
        $this->thumbnail = $data['thumbnail'] ?? '';
        $this->created_at = $data['created_at'] ?? '';
        $this->updated_at = $data['updated_at'] ?? '';
    }
}
?>
