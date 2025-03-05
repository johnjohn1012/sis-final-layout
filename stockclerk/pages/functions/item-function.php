<?php
// Include the database connection
include('connection.php');

// Fetch items from the database and join with suppliers, employees, and categories to display names
$query = "SELECT i.*, s.supplier_name, e.first_name AS employee_name, c.category_name 
          FROM tbl_item_list i
          INNER JOIN tbl_suppliers s ON i.supplier_id = s.supplier_id
          INNER JOIN tbl_employee e ON i.employee_id = e.employee_id
          INNER JOIN tbl_categories c ON i.category_id = c.category_id
          ORDER BY i.date_created DESC";
$result = mysqli_query($conn, $query);

// Fetch suppliers for the dropdown
$supplier_query = "SELECT * FROM tbl_suppliers";
$supplier_result = mysqli_query($conn, $supplier_query);

// Fetch employees for the dropdown
$employee_query = "SELECT * FROM tbl_employee";
$employee_result = mysqli_query($conn, $employee_query);

// Fetch categories for the dropdown
$category_query = "SELECT * FROM tbl_categories";
$category_result = mysqli_query($conn, $category_query);

// Add item functionality
if(isset($_POST['add_item'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $supplier_id = $_POST['supplier_id'];
    $employee_id = $_POST['employee_id'];
    $category_id = $_POST['category_id'];
    $cost = $_POST['cost'];
    $status = $_POST['status'];

    $query_add = "INSERT INTO tbl_item_list (name, description, supplier_id, employee_id, category_id, cost, status) 
                  VALUES ('$name', '$description', '$supplier_id', '$employee_id', '$category_id', '$cost', '$status')";
    mysqli_query($conn, $query_add);
    echo "<script>alert('Item added successfully'); window.location.href = 'index_admin.php?page=item_list';</script>";
    exit;
}

// Edit item functionality
if(isset($_POST['edit_item'])){
    $item_id = $_POST['item_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $supplier_id = $_POST['supplier_id'];
    $employee_id = $_POST['employee_id'];
    $category_id = $_POST['category_id'];
    $cost = $_POST['cost'];
    $status = $_POST['status'];

    $query_edit = "UPDATE tbl_item_list 
                   SET name = '$name', description = '$description', supplier_id = '$supplier_id', 
                       employee_id = '$employee_id', category_id = '$category_id', cost = '$cost', status = '$status' 
                   WHERE item_id = $item_id";
    mysqli_query($conn, $query_edit);
    echo "<script>alert('Item updated successfully'); window.location.href = 'index_admin.php?page=item_list';</script>";
    exit;
}

// Handle deletion
if (isset($_POST['delete'])) {
    $item_id = $_POST['delete'];
    $query_delete = "DELETE FROM tbl_item_list WHERE item_id = $item_id";
    mysqli_query($conn, $query_delete);
    echo "<script>alert('Item deleted successfully'); window.location.href = 'index_admin.php?page=item_list';</script>";
    exit;
}
?>
