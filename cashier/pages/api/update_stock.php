<?php
require('../includes/connection.php');

// Set response headers for CORS and JSON response
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS, GET');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Handle preflight request for CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Handle GET request (for testing in the browser)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode([
        "success" => false,
        "message" => "This API only accepts POST requests with JSON data",
        "test_example" => [
            "product_id" => 1,
            "quantity" => 5
        ]
    ]);
    exit;
}

// Get the raw input data for POST request
$input = file_get_contents("php://input");

if (!$input) {
    echo json_encode(["success" => false, "message" => "No data received"]);
    exit;
}

$data = json_decode($input, true);

if (!$data) {
    echo json_encode([
        "success" => false, 
        "message" => "Invalid JSON input", 
        "raw_input" => $input, 
        "json_error" => json_last_error_msg()
    ]);
    exit;
}

if (isset($data['product_id']) && isset($data['quantity'])) {
    $product_id = $data['product_id'];
    $quantity = $data['quantity'];

    // Log received data for debugging
    error_log("Received product_id: $product_id, quantity: $quantity");

    // Check if product exists and get current stock
    $check_sql = "SELECT product_stock_quantity FROM tbl_products WHERE product_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    
    if ($check_stmt) {
        $check_stmt->bind_param("i", $product_id);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows === 0) {
            echo json_encode(["success" => false, "message" => "Product not found"]);
            exit;
        }

        $product = $result->fetch_assoc();
        $current_stock = $product['product_stock_quantity'];

        if ($current_stock < $quantity) {
            echo json_encode(["success" => false, "message" => "Not enough stock available", "current_stock" => $current_stock]);
            exit;
        }

        // Proceed with stock update
        $update_sql = "UPDATE tbl_products SET product_stock_quantity = product_stock_quantity - ? WHERE product_id = ?";
        $stmt = $conn->prepare($update_sql);

        if ($stmt) {
            $stmt->bind_param("ii", $quantity, $product_id);

            if ($stmt->execute()) {
                echo json_encode([
                    "success" => true, 
                    "message" => "Stock updated successfully", 
                    "product_id" => $product_id, 
                    "quantity" => $quantity,
                    "new_stock" => $current_stock - $quantity,
                    "affected_rows" => $stmt->affected_rows
                ]);
            } else {
                echo json_encode([
                    "success" => false, 
                    "message" => "Failed to update stock", 
                    "error" => $stmt->error
                ]);
            }

            $stmt->close();
        } else {
            echo json_encode([
                "success" => false, 
                "message" => "SQL preparation failed", 
                "error" => $conn->error
            ]);
        }

        $check_stmt->close();
    } else {
        echo json_encode([
            "success" => false, 
            "message" => "Failed to check product existence", 
            "error" => $conn->error
        ]);
    }
} else {
    echo json_encode([
        "success" => false, 
        "message" => "Missing product_id or quantity", 
        "received_data" => $data
    ]);
}

$conn->close();
?>



<!-- Example POST request to test -->
<!-- 
fetch('http://localhost/sis-final-layout/cashier/pages/api/update_stock.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
        product_id: 1,
        new_quantity: 50
    })
})
.then(response => response.json())
.then(data => console.log(data));
-->
