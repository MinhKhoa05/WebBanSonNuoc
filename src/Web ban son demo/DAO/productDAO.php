<?php
require_once __DIR__ . '/../Models/products.php';

class ProductDAO
{
    private $connection;

    public function __construct($database)
    {
        $this->connection = $database->getConnection();
    }

    public function getAll()
    {
        $query = "
            SELECT 
                id,
                name,
                description,
                price,
                discount,
                stock,
                status,
                category_id,
                thumbnail,
                is_deleted,
                created_at,
                updated_at
            FROM products
            WHERE is_deleted = 0
            ORDER BY created_at DESC
        ";

        $statement = $this->connection->prepare($query);
        $statement->execute();

        $products = [];

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $products[] = new Product(
                $row['id'],
                $row['name'],
                $row['description'],
                $row['price'],
                $row['discount'],
                $row['stock'],
                $row['status'],
                $row['category_id'],
                $row['thumbnail'],
                $row['is_deleted'],
                $row['created_at'],
                $row['updated_at']
            );
        }

        return $products;
    }



    public function getById($productId)
    {
        $query = "
            SELECT 
                id,
                name,
                description,
                price,
                discount,
                stock,
                status,
                category_id,
                thumbnail,
                is_deleted,
                created_at,
                updated_at
            FROM products
            WHERE id = :productId
              AND is_deleted = 0
            LIMIT 1
        ";
    
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':productId', $productId, PDO::PARAM_INT);
        $statement->execute();
    
        $row = $statement->fetch(PDO::FETCH_ASSOC);
    
        if ($row) {
            return new Product(
                $row['id'],
                $row['name'],
                $row['description'],
                $row['price'],
                $row['discount'],
                $row['stock'],
                $row['status'],
                $row['category_id'],
                $row['thumbnail'],
                $row['is_deleted'],
                $row['created_at'],
                $row['updated_at']
            );
        }
    
        // Không tìm thấy sản phẩm
        return null;
    }
    

    public function getByCategoryId($categoryId)
    {
        $query = "
            SELECT 
                id,
                name,
                description,
                price,
                discount,
                stock,
                status,
                category_id,
                thumbnail,
                is_deleted,
                created_at,
                updated_at
            FROM products
            WHERE category_id = :category_id
              AND is_deleted = 0
            ORDER BY created_at DESC
        ";
    
        $statement = $this->connection->prepare($query);
        $statement->execute(['category_id' => $categoryId]);
    
        $products = [];
    
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $products[] = new Product(
                $row['id'],
                $row['name'],
                $row['description'],
                $row['price'],
                $row['discount'],
                $row['stock'],
                $row['status'],
                $row['category_id'],
                $row['thumbnail'],
                $row['is_deleted'],
                $row['created_at'],
                $row['updated_at']
            );
        }
    
        return $products;
    }
    

    public function getBestSellingProducts($limit = 8)
    {
        $query = "
        SELECT 
            p.id,
            p.name,
            p.description,
            p.price,
            p.discount,
            p.stock,
            p.status,
            p.thumbnail,
            p.category_id,
            p.warranty,
            ROUND(AVG(r.rating), 1) AS rating,
            COUNT(oi.product_id) AS total_sold,
            COUNT(r.id) AS reviews,
            p.created_at,
            p.updated_at
        FROM products p
        LEFT JOIN order_items oi ON p.id = oi.product_id
        LEFT JOIN reviews r ON p.id = r.product_id
        GROUP BY p.id
        ORDER BY total_sold DESC
        LIMIT :limit
    ";

        $statement = $this->connection->prepare($query);
        $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
        $statement->execute();

        $products = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $products[] = new Product(
                $row['id'],
                $row['user_id'],
                $row['name'],
                $row['description'],
                $row['price'],
                $row['category_id'],
                $row['condition'],
                $row['location'],
                $row['status'],
                $row['warranty'],
                $row['discount'],
                $row['rating'],
                $row['reviews'],
                $row['created_at'],
                $row['updated_at']
            );
        }

        return $products;
    }
}
?>