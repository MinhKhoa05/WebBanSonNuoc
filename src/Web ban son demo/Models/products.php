<?php
class Product {
    public int $id;
    public string $name;
    public string $description;
    public float $price;
    public float $discount;
    public int $stock;
    public string $status;
    public int $category_id;
    public string $thumbnail;
    public int $is_deleted;
    public string $created_at;
    public string $updated_atad;

    public function __construct(array $data = []) {
        $this->id = (int)($data['id'] ?? 0);
        $this->name = $data['name'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->price = (float)($data['price'] ?? 0);
        $this->discount = (float)($data['discount'] ?? 0);
        $this->stock = (int)($data['stock'] ?? 0);
        $this->status = $data['status'] ?? '';
        $this->category_id = (int)($data['category_id'] ?? 0);
        $this->thumbnail = $data['thumbnail'] ?? '';
        $this->is_deleted = (int)($data['is_deleted'] ?? 0);
        $this->created_at = $data['created_at'] ?? '';
        $this->updated_atad = $data['updated_at'] ?? '';
    }
}
?>
