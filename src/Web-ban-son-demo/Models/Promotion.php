<?php
class Promotion {
    public int $id;
    public int $product_id;
    public int $discount_type_id;
    public float $value;
    public string $start_date;
    public string $end_date;
    public string $created_at;

    public function __construct(array $data = []) {
        $this->id = (int)($data['id'] ?? 0);
        $this->product_id = (int)($data['product_id'] ?? 0);
        $this->discount_type_id = (int)($data['discount_type_id'] ?? 0);
        $this->value = (float)($data['value'] ?? 0);
        $this->start_date = $data['start_date'] ?? '';
        $this->end_date = $data['end_date'] ?? '';
        $this->created_at = $data['created_at'] ?? '';
    }
}
?>
