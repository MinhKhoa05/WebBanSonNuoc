<?php
class Categories {
    public $id;
    public $name;
    public $created_at;
    public $updated_at;

    public function __construct($id, $name, $created_at, $updated_at) {
        $this->id = $id;
        $this->name = $name;
        $this->created_at = $created_at;
        $this->created_at = $updated_at;
    }
}
?>
