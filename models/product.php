<?php
require_once 'pdo.php';

function product_select_all() {
    $sql = "SELECT p.*, c.name AS category_name 
            FROM products p
            JOIN categories c ON p.category_id = c.id
            WHERE p.view = 1";
    return pdo_query($sql);
}

function product_select_by_id($id)
{
    $sql = "SELECT * FROM products WHERE view = 1 AND id = ?";
    return pdo_query_one($sql, $id);
}

function product_select_by_category_id($categoryId)
{
    $sql = "SELECT * FROM products WHERE category_id = ? AND view = 1";
    return pdo_query($sql, $categoryId);
}

function product_select_by_price($maxPrice) {
    $sql = "SELECT * FROM products WHERE price <= ?";
    return pdo_query($sql, $maxPrice);
}

function product_search_by_name($keyword)
{
    $sql = "SELECT * FROM products WHERE name LIKE ? AND view = 1";
    return pdo_query($sql, "%" . $keyword . "%");
}

function product_filter_count($categoryId = null, $maxPrice = null)
{
    $sql = "SELECT COUNT(*) 
            FROM products p
            WHERE p.view = 1";
    $params = [];

    // Lọc theo danh mục
    if (!is_null($categoryId) && $categoryId !== 'all') {
        $sql .= " AND p.category_id = ?";
        $params[] = $categoryId;
    }

    // Lọc theo giá
    if (!is_null($maxPrice)) {
        $sql .= " AND p.price <= ?";
        $params[] = $maxPrice;
    }

    return pdo_query_value($sql, ...$params);
}

function product_filter($categoryId = null, $maxPrice = null, $status = null, $sort = null, $startIndex = 0, $limit = 10)
{
    $sql = "SELECT p.*, c.name as category_name 
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.id
            WHERE p.view = 1";
    $params = [];

    // Lọc theo danh mục
    if (!is_null($categoryId) && $categoryId !== 'all') {
        $sql .= " AND p.category_id = ?";
        $params[] = $categoryId;
    }

    // Lọc theo giá
    if (!is_null($maxPrice)) {
        $sql .= " AND p.price <= ?";
        $params[] = $maxPrice;
    }

    // Sắp xếp
    if (!is_null($sort)) {
        if ($sort === 'price_asc') {
            $sql .= " ORDER BY p.price ASC";
        } elseif ($sort === 'price_desc') {
            $sql .= " ORDER BY p.price DESC";
        } elseif ($sort === 'newest') {
            $sql .= " ORDER BY p.created_at DESC";
        } else {
            $sql .= " ORDER BY p.id DESC"; // Mặc định
        }
    } else {
        $sql .= " ORDER BY p.id DESC"; // Mặc định
    }

    // Giới hạn số lượng sản phẩm
    $sql .= " LIMIT ?, ?";
    $params[] = $startIndex;
    $params[] = $limit;

    return pdo_query($sql, ...$params);
}

class Product {
    private $db;
    private $id;
    private $name;
    private $description;
    private $price;
    private $stock;
    private $category_id;
    private $image;
    private $created_at;
    private $updated_at;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Get total products count
    public function getTotalProducts() {
        $query = "SELECT COUNT(*) as total FROM products";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Get out of stock products count
    public function getOutOfStockCount() {
        $query = "SELECT COUNT(*) as total FROM products WHERE stock <= 0";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Get top selling products
    public function getTopSellingProducts($limit = 4) {
        $query = "SELECT p.*, 
                        COUNT(od.product_id) as total_sold,
                        SUM(od.quantity * od.price) as total_revenue
                 FROM products p
                 LEFT JOIN order_details od ON p.id = od.product_id
                 GROUP BY p.id
                 ORDER BY total_sold DESC
                 LIMIT :limit";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get product by ID
    public function getProductById($id) {
        $query = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create new product
    public function createProduct($data) {
        $query = "INSERT INTO products (name, description, price, stock, category_id, image, created_at) 
                 VALUES (:name, :description, :price, :stock, :category_id, :image, NOW())";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($data);
    }

    // Update product
    public function updateProduct($id, $data) {
        $query = "UPDATE products 
                 SET name = :name, 
                     description = :description, 
                     price = :price, 
                     stock = :stock, 
                     category_id = :category_id, 
                     image = :image, 
                     updated_at = NOW() 
                 WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    // Delete product
    public function deleteProduct($id) {
        $query = "DELETE FROM products WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>