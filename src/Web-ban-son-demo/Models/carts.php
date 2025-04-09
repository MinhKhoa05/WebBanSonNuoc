<?php
class Cart
{
    public int $id;
    public int $user_id;
    public int $product_id;
    public int $quantity;
    public string $added_at;

    public function __construct(array $data = [])
    {
        $this->id = (int)($data['id'] ?? 0);
        $this->user_id = (int)($data['user_id'] ?? 0);
        $this->product_id = (int)($data['product_id'] ?? 0);
        $this->quantity = (int)($data['quantity'] ?? 1);
        $this->added_at = $data['added_at'] ?? '';
    }
}
?>
