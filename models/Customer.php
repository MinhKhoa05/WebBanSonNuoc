<?php
class Customer {
    private $db;
    private $id;
    private $name;
    private $email;
    private $phone;
    private $address;
    private $created_at;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Get total customers count
    public function getTotalCustomers() {
        $query = "SELECT COUNT(*) as total FROM customers";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Get new customers count (last 30 days)
    public function getNewCustomersCount() {
        $query = "SELECT COUNT(*) as total FROM customers 
                 WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Get customer by ID
    public function getCustomerById($id) {
        $query = "SELECT * FROM customers WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create new customer
    public function createCustomer($data) {
        $query = "INSERT INTO customers (name, email, phone, address, created_at) 
                 VALUES (:name, :email, :phone, :address, NOW())";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($data);
    }

    // Update customer
    public function updateCustomer($id, $data) {
        $query = "UPDATE customers 
                 SET name = :name, 
                     email = :email, 
                     phone = :phone, 
                     address = :address 
                 WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    // Delete customer
    public function deleteCustomer($id) {
        $query = "DELETE FROM customers WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
} 