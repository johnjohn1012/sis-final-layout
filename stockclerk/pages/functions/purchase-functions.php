<?php
// Include database connection
include('connection.php');

// Fetch purchase orders from the database
$query = "SELECT po.purchase_order_id, po.purchase_order_date, po.status, po.purchase_expected_delivery_date, 
                 s.supplier_name, po.purchase_created_at, 
                 CONCAT(e.first_name, ' ', e.last_name) AS employee_name 
          FROM tbl_purchase_order_list po
          LEFT JOIN tbl_suppliers s ON po.supplier_id = s.supplier_id
          LEFT JOIN tbl_employee e ON po.employee_id = e.employee_id 
          ORDER BY po.purchase_created_at DESC";
$result = mysqli_query($conn, $query);

// Fetch suppliers
$supplier_query = "SELECT supplier_id, supplier_name FROM tbl_suppliers ORDER BY supplier_name ASC";
$supplier_result = mysqli_query($conn, $supplier_query);

// Fetch employees
$employee_query = "SELECT employee_id, CONCAT(first_name, ' ', last_name) AS employee_name FROM tbl_employee ORDER BY first_name ASC";
$employee_result = mysqli_query($conn, $employee_query);

// Add purchase order
if(isset($_POST['add_purchase_order'])){
    $supplier_id = intval($_POST['supplier_id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $expected_delivery_date = $_POST['purchase_expected_delivery_date'];
    $employee_id = intval($_POST['employee_id']);

    // Start a transaction to ensure both the purchase order and items are added
    mysqli_begin_transaction($conn);
    try {
        // Add the purchase order
        $query_add = "INSERT INTO tbl_purchase_order_list (supplier_id, status, purchase_expected_delivery_date, employee_id) 
                      VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query_add);
        mysqli_stmt_bind_param($stmt, "issi", $supplier_id, $status, $expected_delivery_date, $employee_id);
        mysqli_stmt_execute($stmt);
        $purchase_order_id = mysqli_insert_id($conn);  // Get the last inserted purchase order ID

        // Add purchase items to tbl_purchase_items (new products for the order)
        if (isset($_POST['purchase_items']) && !empty($_POST['purchase_items'])) {
            $items = $_POST['purchase_items']; // Should be an array of product IDs and quantities, e.g., [product_id:quantity, product_id:quantity]
            foreach ($items as $item) {
                list($product_id, $quantity_ordered) = explode(':', $item);

                // Insert each item into tbl_purchase_items
                $query_item = "INSERT INTO tbl_purchase_items (purchase_order_id, product_id, quantity_ordered, employee_id)
                               VALUES (?, ?, ?, ?)";
                $stmt_item = mysqli_prepare($conn, $query_item);
                mysqli_stmt_bind_param($stmt_item, "iiii", $purchase_order_id, $product_id, $quantity_ordered, $employee_id);
                mysqli_stmt_execute($stmt_item);
            }
        }

        // Commit the transaction
        mysqli_commit($conn);

        echo "<script>alert('Purchase order and items recorded successfully'); window.location.href = 'index_admin.php?page=purchase_orders';</script>";
    } catch (Exception $e) {
        // Rollback the transaction if an error occurs
     
        echo "<script>alert('Error: " . $e->getMessage() . "'); window.location.href = 'index_admin.php?page=purchase_orders';</script>";
    }
    exit;
}

// Edit purchase order
if(isset($_POST['edit_purchase_order'])){
    $purchase_order_id = intval($_POST['purchase_order_id']);
    $supplier_id = intval($_POST['supplier_id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $expected_delivery_date = $_POST['purchase_expected_delivery_date'];
    $employee_id = intval($_POST['employee_id']);

    // Update purchase order
    $query_edit = "UPDATE tbl_purchase_order_list SET supplier_id = ?, status = ?, purchase_expected_delivery_date = ?, 
                   employee_id = ? WHERE purchase_order_id = ?";
    $stmt = mysqli_prepare($conn, $query_edit);
    mysqli_stmt_bind_param($stmt, "issii", $supplier_id, $status, $expected_delivery_date, $employee_id, $purchase_order_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Optionally update purchase items if needed (e.g., add or remove items from the order)
    echo "<script>alert('Purchase order updated successfully'); window.location.href = 'index_admin.php?page=purchase_orders';</script>";
    exit;
}

// Handle deletion
if (isset($_POST['delete_purchase_order'])) {
    $purchase_order_id = intval($_POST['delete_purchase_order']);
    $query_delete = "DELETE FROM tbl_purchase_order_list WHERE purchase_order_id = ?";
    $stmt = mysqli_prepare($conn, $query_delete);
    mysqli_stmt_bind_param($stmt, "i", $purchase_order_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo "<script>alert('Purchase order deleted successfully'); window.location.href = 'index_admin.php?page=purchase_orders';</script>";
    exit;
}
?>
