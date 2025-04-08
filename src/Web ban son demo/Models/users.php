<?php
class user {
    public $id;
    public $username;
    public $password;
    public $email;
    public $phone;
    public $address;
    public $role;
    public $is_delete;
    public $create_at;
    public $update_at;

    public function __construct($id, $username, $password, $email, $phone, $address, $role, $is_delete, $create_at, $update_at) {
        $this->id = $id;
        $this->name = $username;
        $this->password = $password;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->role = $role;
        $this->delete = $is_delete;
        $this->created_at = $create_at;
        $this->updated_at = $update_at;
    }
}

?>
