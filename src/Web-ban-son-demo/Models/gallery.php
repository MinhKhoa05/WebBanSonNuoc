<?php
class Gallery {
    public int $id;
    public int $product_id;
    public string $thumbnail;

    public function __construct(array $data = []) {
        $this->id = (int)($data['id'] ?? 0);
        $this->product_id = (int)($data['product_id'] ?? 0);
        $this->thumbnail = $data['thumbnail'] ?? '';
    }
}
?>
