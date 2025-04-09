<?php
class Payment {
    public int $id;
    public int $order_id;
    public string $method;
    public string $status;
    public string $created_at;

    public function __construct(array $data = []) {
        $this->id = (int)($data['id'] ?? 0);
        $this->order_id = (int)($data['order_id'] ?? 0);
        $this->method = $data['method'] ?? '';
        $this->status = $data['status'] ?? '';
        $this->created_at = $data['created_at'] ?? '';
    }
}
?>
