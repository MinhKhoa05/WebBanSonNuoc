<?php
class User {
    public int $id;
    public string $username;
    public string $password;
    public string $email;
    public string $phone;
    public string $address;
    public string $role;
    public int $is_delete;
    public string $create_at;
    public string $update_at;

    public function __construct(array $data = []) {
        $this->id = (int)($data['id'] ?? 0);
        $this->username = $data['username'] ?? '';
        $this->password = $data['password'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->phone = $data['phone'] ?? '';
        $this->address = $data['address'] ?? '';
        $this->role = $data['role'] ?? '';
        $this->is_delete = (int)($data['is_delete'] ?? 0);
        $this->create_at = $data['create_at'] ?? '';
        $this->update_at = $data['update_at'] ?? '';
    }
}
?>
