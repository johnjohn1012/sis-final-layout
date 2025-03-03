<?php
// Include database connection
include('connection.php');

// Fetch raw ingredients
$query = "SELECT r.raw_ingredient_id, r.raw_name, r.raw_unit_of_measure, r.raw_stock_quantity, 
                 r.raw_cost_per_unit, r.raw_reorder_level, s.supplier_name, 
                 c.category_name, CONCAT(e.first_name, ' ', e.last_name) AS employee_name 
          FROM tbl_raw_ingredients r
          LEFT JOIN tbl_suppliers s ON r.supplier_id = s.supplier_id
          LEFT JOIN tbl_categories c ON r.category_id = c.category_id
          LEFT JOIN tbl_employee e ON r.employee_id = e.employee_id
          ORDER BY r.raw_name ASC";
$result = mysqli_query($conn, $query);

// Fetch categories
$category_query = "SELECT category_id, category_name FROM tbl_categories ORDER BY category_name ASC";
$category_result = mysqli_query($conn, $category_query);

// Fetch employees
$employee_query = "SELECT employee_id, CONCAT(first_name, ' ', last_name) AS employee_name FROM tbl_employee ORDER BY first_name ASC";
$employee_result = mysqli_query($conn, $employee_query);

// Fetch suppliers
$supplier_query = "SELECT supplier_id, supplier_name FROM tbl_suppliers ORDER BY supplier_name ASC";
$supplier_result = mysqli_query($conn, $supplier_query);

// Add raw ingredient
if(isset($_POST['add_raw_ingredient'])){
    $raw_name = mysqli_real_escape_string($conn, $_POST['raw_name']);
    $raw_description = mysqli_real_escape_string($conn, $_POST['raw_description']);
    $unit_of_measure = mysqli_real_escape_string($conn, $_POST['raw_unit_of_measure']);
    $stock_quantity = intval($_POST['raw_stock_quantity']);
    $cost_per_unit = floatval($_POST['raw_cost_per_unit']);
    $reorder_level = intval($_POST['raw_reorder_level']);
    $category_id = intval($_POST['category_id']);
    $employee_id = intval($_POST['employee_id']);
    $supplier_id = intval($_POST['supplier_id']);
    
    $query_add = "INSERT INTO tbl_raw_ingredients (raw_name, raw_description, raw_unit_of_measure, raw_stock_quantity, raw_cost_per_unit, raw_reorder_level, category_id, employee_id, supplier_id) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query_add);
    mysqli_stmt_bind_param($stmt, "sssidiiii", $raw_name, $raw_description, $unit_of_measure, $stock_quantity, $cost_per_unit, $reorder_level, $category_id, $employee_id, $supplier_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo "<script>alert('Recorded successfully'); window.location.href = 'index_admin.php?page=ingredients';</script>";
    exit;
}

// Edit raw ingredient
if(isset($_POST['edit_raw_ingredient'])){
    $raw_ingredient_id = intval($_POST['raw_ingredient_id']);
    $raw_name = mysqli_real_escape_string($conn, $_POST['raw_name']);
    $raw_description = mysqli_real_escape_string($conn, $_POST['raw_description']);
    $unit_of_measure = mysqli_real_escape_string($conn, $_POST['raw_unit_of_measure']);
    $stock_quantity = intval($_POST['raw_stock_quantity']);
    $cost_per_unit = floatval($_POST['raw_cost_per_unit']);
    $reorder_level = intval($_POST['raw_reorder_level']);
    $category_id = intval($_POST['category_id']);
    $employee_id = intval($_POST['employee_id']);
    $supplier_id = intval($_POST['supplier_id']);

    $query_edit = "UPDATE tbl_raw_ingredients SET raw_name = ?, raw_description = ?, raw_unit_of_measure = ?, raw_stock_quantity = ?, raw_cost_per_unit = ?, raw_reorder_level = ?, category_id = ?, employee_id = ?, supplier_id = ? WHERE raw_ingredient_id = ?";
    $stmt = mysqli_prepare($conn, $query_edit);
    mysqli_stmt_bind_param($stmt, "sssidiiiii", $raw_name, $raw_description, $unit_of_measure, $stock_quantity, $cost_per_unit, $reorder_level, $category_id, $employee_id, $supplier_id, $raw_ingredient_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo "<script>alert('Updated successfully'); window.location.href = 'index_admin.php?page=ingredients';</script>";
    exit;
}

// Handle deletion
if (isset($_POST['delete_raw_ingredient'])) {
    $raw_ingredient_id = intval($_POST['delete_raw_ingredient']);
    $query_delete = "DELETE FROM tbl_raw_ingredients WHERE raw_ingredient_id = ?";
    $stmt = mysqli_prepare($conn, $query_delete);
    mysqli_stmt_bind_param($stmt, "i", $raw_ingredient_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo "<script>alert('Deleted successfully'); window.location.href = 'index_admin.php?page=ingredients';</script>";
    exit;
}
?>
