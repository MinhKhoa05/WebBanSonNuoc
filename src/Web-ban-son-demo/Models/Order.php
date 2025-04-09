<?php
class Order
{
    public int $id;
    public int $user_id;
    public string $order_date;
    public float $total;
    public string $status;

    public function __construct(array $data = [])
    {
        $this->id = (int)($data['id'] ?? 0);
        $this->user_id = (int)($data['user_id'] ?? 0);
        $this->order_date = $data['order_date'] ?? date('Y-m-d H:i:s');
        $this->total = (float)($data['total'] ?? 0);
        $this->status = $data['status'] ?? 'pending';
    }
}
?>
