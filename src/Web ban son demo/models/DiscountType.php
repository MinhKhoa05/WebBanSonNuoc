<?php
class DiscountType {
    public int $id;
    public string $name;
    public string $description;

    public function __construct(array $data = []) {
        $this->id = (int)($data['id'] ?? 0);
        $this->name = $data['name'] ?? '';
        $this->description = $data['description'] ?? '';
    }
}
?>
