<?php
// Include database connection
include('connection.php');

// Fetch products from the database
$query = "SELECT p.*, c.category_name, e.employee_name FROM tbl_products p 
          LEFT JOIN tbl_categories c ON p.category_id = c.category_id 
          LEFT JOIN tbl_employee e ON p.employee_id = e.employee_id
          ORDER BY p.product_created_at DESC";
$result = mysqli_query($conn, $query);

// Fetch categories and employees for dropdowns
$categories = mysqli_query($conn, "SELECT * FROM tbl_categories ORDER BY category_name ASC");
$employees = mysqli_query($conn, "SELECT * FROM tbl_employee ORDER BY employee_name ASC");

// Add product
if(isset($_POST['add_product'])){
    $product_name = $_POST['product_name'];
    $product_selling_price = $_POST['product_selling_price'];
    $product_stock_quantity = $_POST['product_stock_quantity'];
    $product_reorder_level = $_POST['product_reorder_level'];
    $category_id = $_POST['category_id'];
    $employee_id = $_POST['employee_id'];

    $query_add = "INSERT INTO tbl_products (product_name, product_selling_price, product_stock_quantity, product_reorder_level, category_id, employee_id) 
                  VALUES ('$product_name', '$product_selling_price', '$product_stock_quantity', '$product_reorder_level', '$category_id', '$employee_id')";
    mysqli_query($conn, $query_add);
    echo "<script>alert('Recorded successfully'); window.location.href = 'index_admin.php?page=products';</script>";
    exit;
}

// Edit product
if(isset($_POST['edit_product'])){
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_selling_price = $_POST['product_selling_price'];
    $product_stock_quantity = $_POST['product_stock_quantity'];
    $product_reorder_level = $_POST['product_reorder_level'];
    $category_id = $_POST['category_id'];
    $employee_id = $_POST['employee_id'];

    $query_edit = "UPDATE tbl_products SET product_name = '$product_name', product_selling_price = '$product_selling_price', 
                   product_stock_quantity = '$product_stock_quantity', product_reorder_level = '$product_reorder_level', 
                   category_id = '$category_id', employee_id = '$employee_id' WHERE product_id = $product_id";
    mysqli_query($conn, $query_edit);
    echo "<script>alert('Updated successfully'); window.location.href = 'index_admin.php?page=products';</script>";
    exit;
}

// Handle deletion
if (isset($_POST['delete'])) {
    $product_id = $_POST['delete'];
    $query_delete = "DELETE FROM tbl_products WHERE product_id = $product_id";
    mysqli_query($conn, $query_delete);
    echo "<script>alert('Deleted successfully'); window.location.href = 'index_admin.php?page=products';</script>";
    exit;
}
?>