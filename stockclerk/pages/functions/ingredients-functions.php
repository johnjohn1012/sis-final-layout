<?php
// Enable error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connection.php');

// Your query to fetch raw ingredient details
$query = "
    SELECT 
    ri.raw_ingredient_id, 
    ri.raw_unit_of_measure, 
    ri.raw_stock_quantity, 
    ri.raw_reorder_level, 
    ri.raw_stock_in, 
    ri.raw_stock_out, 
    i.name AS raw_name, 
    i.cost AS item_cost, 
    c.category_name, 
    s.supplier_name,  
    CONCAT(e.first_name, ' ', e.last_name) AS employee_name  -- Concatenate first and last name
FROM tbl_raw_ingredients ri
JOIN tbl_item_list i ON ri.item_id = i.item_id
LEFT JOIN tbl_categories c ON i.category_id = c.category_id
LEFT JOIN tbl_suppliers s ON i.supplier_id = s.supplier_id
LEFT JOIN tbl_employee e ON i.employee_id = e.employee_id;

";

// Run the query
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


// Fetch item list and store in array for reuse
$item_query = "SELECT item_id, name FROM tbl_item_list ORDER BY name ASC";
$item_result = mysqli_query($conn, $item_query);
$items = [];
while ($row = mysqli_fetch_assoc($item_result)) {
    $items[] = $row;
}

// Initialize variables with default values
$selected_item_id = null;
$category_name = '';
$supplier_name = '';
$employee_name = '';
$cost_per_unit = ''; // Variable to store the cost

// Process item selection if parameter exists
if (isset($_GET['item_id'])) {
    $item_id = intval($_GET['item_id']);
    
    // Fetch item details
    $query = "SELECT c.category_name, s.supplier_name, 
                     CONCAT(e.first_name, ' ', e.last_name) AS employee_name,
                     i.cost AS cost_per_unit
              FROM tbl_item_list i
              INNER JOIN tbl_categories c ON i.category_id = c.category_id
              INNER JOIN tbl_suppliers s ON i.supplier_id = s.supplier_id
              INNER JOIN tbl_employee e ON i.employee_id = e.employee_id
              WHERE i.item_id = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $item_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $category_name, $supplier_name, $employee_name, $cost_per_unit);
        
        if (mysqli_stmt_fetch($stmt)) {
            $selected_item_id = $item_id;
        }
        mysqli_stmt_close($stmt);
    }
}


// Handle adding a new raw ingredient
if (isset($_POST['add_raw_ingredient'])) {
    // Sanitize inputs
    $item_id = intval($_POST['item_id']);
    $unit_of_measure = mysqli_real_escape_string($conn, $_POST['raw_unit_of_measure']);
    $stock_quantity = intval($_POST['raw_stock_quantity']);
    $reorder_level = intval($_POST['raw_reorder_level']);

    // Validate required fields
    if ($item_id <= 0 || empty($unit_of_measure) || $stock_quantity < 0 || $reorder_level < 0) {
        echo "<script>alert('Invalid input data'); window.location.href='index_admin.php?page=ingredients';</script>";
        exit;
    }

    // Check if item exists
    $check_item = "SELECT item_id FROM tbl_item_list WHERE item_id = ?";
    $stmt = mysqli_prepare($conn, $check_item);
    mysqli_stmt_bind_param($stmt, "i", $item_id);
    mysqli_stmt_execute($stmt);
    
    if (!mysqli_stmt_fetch($stmt)) {
        echo "<script>alert('Invalid item selected'); window.location.href='index_admin.php?page=ingredients';</script>";
        exit;
    }
    mysqli_stmt_close($stmt);

    // Insert into raw ingredients
    $insert_query = "INSERT INTO tbl_raw_ingredients (
        item_id, 
        raw_unit_of_measure, 
        raw_stock_quantity, 
        raw_reorder_level
    ) VALUES (?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $insert_query);
    mysqli_stmt_bind_param($stmt, "isii", 
        $item_id,
        $unit_of_measure,
        $stock_quantity,
        $reorder_level
    );

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
            alert('Ingredient added successfully!');
            window.location.href = 'index_admin.php?page=ingredients';
        </script>";
    } else {
        echo "<script>
            alert('Error: ".mysqli_error($conn)."');
            window.history.back();
        </script>";
    }
    mysqli_stmt_close($stmt);
}



// Handle editing an existing raw ingredient
if (isset($_POST['edit_raw_ingredient'])) {
    $raw_ingredient_id = intval($_POST['raw_ingredient_id']);
    $raw_name = mysqli_real_escape_string($conn, $_POST['raw_name']);
    $raw_description = mysqli_real_escape_string($conn, $_POST['raw_description']);
    $unit_of_measure = mysqli_real_escape_string($conn, $_POST['raw_unit_of_measure']);
    $stock_quantity = intval($_POST['raw_stock_quantity']);
    $stock_in = intval($_POST['raw_stock_in']);
    $stock_out = intval($_POST['raw_stock_out']);
    $cost_per_unit = floatval($_POST['raw_cost_per_unit']);
    $reorder_level = intval($_POST['raw_reorder_level']);
    $category_id = intval($_POST['category_id']);
    $employee_id = intval($_POST['employee_id']);
    $supplier_id = intval($_POST['supplier_id']);
    $item_id = intval($_POST['item_id']);
    
    $query_edit = "UPDATE tbl_raw_ingredients SET 
        raw_name = ?,
        raw_description = ?,
        raw_unit_of_measure = ?,
        raw_stock_quantity = ?,
        raw_stock_in = ?,
        raw_stock_out = ?,
        raw_cost_per_unit = ?,
        raw_reorder_level = ?,
        category_id = ?,
        employee_id = ?,
        supplier_id = ?,
        item_id = ?
        WHERE raw_ingredient_id = ?";
        
    $stmt = mysqli_prepare($conn, $query_edit);
    mysqli_stmt_bind_param(
        $stmt, 
        "sssiiidiiiiii",
        $raw_name,
        $raw_description,
        $unit_of_measure,
        $stock_quantity,
        $stock_in,
        $stock_out,
        $cost_per_unit,
        $reorder_level,
        $category_id,
        $employee_id,
        $supplier_id,
        $item_id,
        $raw_ingredient_id
    );
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Updated successfully'); window.location.href = 'index_admin.php?page=ingredients';</script>";
    } else {
        echo "<script>alert('Error updating raw ingredient');</script>";
    }
    mysqli_stmt_close($stmt);
}

// Handle deleting a raw ingredient
if (isset($_POST['delete_raw_ingredient'])) {
    $raw_ingredient_id = intval($_POST['delete_raw_ingredient']);
    $query_delete = "DELETE FROM tbl_raw_ingredients WHERE raw_ingredient_id = ?";
    $stmt = mysqli_prepare($conn, $query_delete);
    if ($stmt === false) {
        die("Error preparing statement: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "i", $raw_ingredient_id);
    $result = mysqli_stmt_execute($stmt);
    if ($result) {
        echo "<script>alert('Raw ingredient deleted successfully'); window.location.href = 'index_admin.php?page=ingredients';</script>";
    } else {
        echo "<script>alert('Error deleting raw ingredient');</script>";
    }
    mysqli_stmt_close($stmt);
    exit;
}











// Handle stock updates (in/out)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $ingredient_id = intval($_POST['ingredient_id']);
    $quantity = intval($_POST['quantity']);
    $action = $_POST['action']; // 'in' for Stock In, 'out' for Stock Out

    // Stock In: Add the quantity to raw_stock_quantity and raw_stock_in
    if ($action == 'in') {
        $query = "UPDATE tbl_raw_ingredients 
                  SET raw_stock_quantity = raw_stock_quantity + ?, 
                      raw_stock_in = raw_stock_in + ? 
                  WHERE raw_ingredient_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "iii", $quantity, $quantity, $ingredient_id);
            $execute_result = mysqli_stmt_execute($stmt);

            // Check if execution was successful
            if ($execute_result) {
                echo "<script>alert('Stock In updated successfully'); window.location.href = 'index_admin.php?page=ingredients';</script>";
            } else {
                echo "<script>alert('Error executing Stock In query');</script>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "<script>alert('Database error while preparing Stock In query');</script>";
        }
    } 
    // Stock Out: Subtract the quantity from raw_stock_quantity (ensure it's not negative) and add to raw_stock_out
    elseif ($action == 'out') {
        $query = "UPDATE tbl_raw_ingredients 
                  SET raw_stock_quantity = GREATEST(raw_stock_quantity - ?, 0), 
                      raw_stock_out = raw_stock_out + ? 
                  WHERE raw_ingredient_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "iii", $quantity, $quantity, $ingredient_id);
            $execute_result = mysqli_stmt_execute($stmt);

            // Check if execution was successful
            if ($execute_result) {
                echo "<script>alert('Stock Out updated successfully'); window.location.href = 'index_admin.php?page=ingredients';</script>";
            } else {
                echo "<script>alert('Error executing Stock Out query');</script>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "<script>alert('Database error while preparing Stock Out query');</script>";
        }
    } else {
        die("Invalid action");
    }
}
?>
