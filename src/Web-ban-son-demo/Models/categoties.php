<?php
class Categories
{
    public int $id;
    public string $name;
    public string $created_at;

    public function __construct(array $data = [])
    {
        $this->id = (int)($data['id'] ?? 0);
        $this->name = $data['name'] ?? '';
        $this->created_at = $data['created_at'] ?? '';
    }
}
?>
