<?php
class Product {
    public $id;
    public $username;
    public $description;
    public $price;
    public $discount;
    public $stock;
    public $status;
    public $category_id;
    public $thumbnail;
    public $is_delete;
    public $created_at;
    public $updated_at;

    public function __construct(
        $id,
        $username,
        $description,
        $price,
        $discount,
        $stock,
        $status,
        $category_id,
        $thumbnail,
        $is_delete,
        $created_at,
        $updated_at,
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->description = $description;
        $this->price = $price;
        $this->discount = $discount;
        $this->stock = $stock;
        $this->status = $status;
        $this->category_id = $category_id;
        $this->thumbnail = $thumbnail;
        $this->is_delete = $is_delete;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
}
?>