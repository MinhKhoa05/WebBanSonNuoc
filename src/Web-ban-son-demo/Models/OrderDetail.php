<?php
class OrderDetail {
    public int $id;
    public int $order_id;
    public int $product_id;
    public int $quantity;
    public float $subtotal;

    public function __construct(array $data = []) {
        $this->id = (int)($data['id'] ?? 0);
        $this->order_id = (int)($data['order_id'] ?? 0);
        $this->product_id = (int)($data['product_id'] ?? 0);
        $this->quantity = (int)($data['quantity'] ?? 0);
        $this->subtotal = (float)($data['subtotal'] ?? 0);
    }
}
?>
