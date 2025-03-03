<?php
require('../../includes/connection.php');

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

$category_id = $data['category_id'] ?? 0;

if ($category_id > 0) {
    // Fetch products by category
    $product_sql = "SELECT product_id, product_name, product_selling_price, product_stock_quantity, product_reorder_level 
                    FROM tbl_products 
                    WHERE category_id = ?";
    
    $stmt = $conn->prepare($product_sql);
    $stmt->bind_param("i", $category_id);
} else {
    // Fetch all products
    $product_sql = "SELECT product_id, product_name, product_selling_price, product_stock_quantity, product_reorder_level 
                    FROM tbl_products";
    
    $stmt = $conn->prepare($product_sql);
}

$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode($products);

$conn->close();
?>
