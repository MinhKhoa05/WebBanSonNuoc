USE SonNuoc;

CREATE OR REPLACE VIEW best_selling_products AS
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
WHERE p.is_deleted = 0
GROUP BY p.id
ORDER BY total_sold DESC;