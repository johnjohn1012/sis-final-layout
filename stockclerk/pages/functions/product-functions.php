<?php
// Include database connection
include('connection.php');

// Fetch products from the database
$query = "SELECT p.product_id, p.product_name, p.product_selling_price, p.product_stock_quantity, p.product_reorder_level, 
                 c.category_name, p.product_created_at, 
                 CONCAT(e.first_name, ' ', e.last_name) AS employee_name 
          FROM tbl_products p
          LEFT JOIN tbl_categories c ON p.category_id = c.category_id
          LEFT JOIN tbl_employee e ON p.employee_id = e.employee_id 
          ORDER BY p.product_created_at DESC";
$result = mysqli_query($conn, $query);

// Fetch categories
$category_query = "SELECT category_id, category_name FROM tbl_categories ORDER BY category_name ASC";
$category_result = mysqli_query($conn, $category_query);

// Fetch employees
$employee_query = "SELECT employee_id, CONCAT(first_name, ' ', last_name) AS employee_name FROM tbl_employee ORDER BY first_name ASC";
$employee_result = mysqli_query($conn, $employee_query);

// Add product
if(isset($_POST['add_product'])){
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $selling_price = floatval($_POST['product_selling_price']);
    $stock_quantity = intval($_POST['product_stock_quantity']);
    $reorder_level = intval($_POST['product_reorder_level']);
    $category_id = intval($_POST['category_id']);
    $employee_id = intval($_POST['employee_id']);
    
    $query_add = "INSERT INTO tbl_products (product_name, product_selling_price, product_stock_quantity, product_reorder_level, category_id, employee_id) 
                  VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query_add);
    mysqli_stmt_bind_param($stmt, "sdiiii", $product_name, $selling_price, $stock_quantity, $reorder_level, $category_id, $employee_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo "<script>alert('Recorded successfully'); window.location.href = 'index_admin.php?page=products';</script>";
    exit;
}

// Edit product
if(isset($_POST['edit_product'])){
    $product_id = intval($_POST['product_id']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $selling_price = floatval($_POST['product_selling_price']);
    $stock_quantity = intval($_POST['product_stock_quantity']);
    $reorder_level = intval($_POST['product_reorder_level']);
    $category_id = intval($_POST['category_id']);
    $employee_id = intval($_POST['employee_id']);

    $query_edit = "UPDATE tbl_products SET product_name = ?, product_selling_price = ?, product_stock_quantity = ?, 
                    product_reorder_level = ?, category_id = ?, employee_id = ? WHERE product_id = ?";
    $stmt = mysqli_prepare($conn, $query_edit);
    mysqli_stmt_bind_param($stmt, "sdiiiii", $product_name, $selling_price, $stock_quantity, $reorder_level, $category_id, $employee_id, $product_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo "<script>alert('Updated successfully'); window.location.href = 'index_admin.php?page=products';</script>";
    exit;
}

// Handle deletion
if (isset($_POST['delete'])) {
    $product_id = intval($_POST['delete']);
    $query_delete = "DELETE FROM tbl_products WHERE product_id = ?";
    $stmt = mysqli_prepare($conn, $query_delete);
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo "<script>alert('Deleted successfully'); window.location.href = 'index_admin.php?page=products';</script>";
    exit;
}
?>
