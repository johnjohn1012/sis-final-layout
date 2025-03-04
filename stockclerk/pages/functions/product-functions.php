<?php
// Include database connection
include('connection.php');

// Fetch products from the database
$query = "SELECT p.product_name, p.product_selling_price, p.product_image, p.product_quantity, p.product_restock_qty,
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


// Handle product addition
if (isset($_POST['add_product'])) {
    // Initialize variables
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $selling_price = number_format((float)$_POST['product_selling_price'], 2, '.', '');
    $product_quantity = intval($_POST['product_quantity']);
    $product_restock_qty = intval($_POST['product_restock_qty']);
    $category_id = intval($_POST['category_id']);
    $employee_id = intval($_POST['employee_id']);
    $upload_error = '';
    $product_image = null;

    // Handle file upload
    if ($_FILES['product_image']['error'] == UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_type = $_FILES['product_image']['type'];
        
        if (in_array($file_type, $allowed_types)) {
            $upload_dir = 'uploads/products/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            
            $file_ext = pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION);
            $unique_name = uniqid('product_', true) . '.' . $file_ext;
            $target_path = $upload_dir . $unique_name;
            
            if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target_path)) {
                $product_image = $unique_name;
            } else {
                $upload_error = 'Failed to move uploaded file';
            }
        } else {
            $upload_error = 'Invalid file type. Only JPG, PNG, and GIF are allowed';
        }
    }

    // Validate inputs
    $errors = [];
    if (empty($product_name)) $errors[] = 'Product name is required';
    if ($selling_price <= 0) $errors[] = 'Invalid selling price';
    if ($category_id <= 0) $errors[] = 'Invalid category';
    if ($employee_id <= 0) $errors[] = 'Invalid employee';
    if (!empty($upload_error)) $errors[] = $upload_error;

    if (!empty($errors)) {
        $error_message = implode('<br>', $errors);
        echo "<script>alert('Error: $error_message'); window.location.href = 'index_admin.php?page=products';</script>";
        exit;
    }

    // Prepare SQL statement
    $query_add = "INSERT INTO tbl_products (
                    product_name, 
                    product_selling_price, 
                    product_image, 
                    product_quantity, 
                    product_restock_qty, 
                    category_id, 
                    employee_id
                ) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $query_add);
    if ($stmt) {
        mysqli_stmt_bind_param(
            $stmt, 
            'sdsiiii',
            $product_name,
            $selling_price,
            $product_image,
            $product_quantity,
            $product_restock_qty,
            $category_id,
            $employee_id
        );

        if (mysqli_stmt_execute($stmt)) {
            $message = 'Product added successfully';
        } else {
            $message = 'Error adding product: ' . mysqli_error($conn);
        }
        
        mysqli_stmt_close($stmt);
    } else {
        $message = 'Database error: ' . mysqli_error($conn);
    }

        echo "<script>alert('$message'); window.location.href = 'index_admin.php?page=products';</script>";
        exit;
    }
    // Edit product
if (isset($_POST['edit_product'])) {
    $product_id = intval($_POST['product_id']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $selling_price = number_format((float)$_POST['product_selling_price'], 2, '.', '');
    $product_quantity = intval($_POST['product_quantity']);
    $product_restock_qty = intval($_POST['product_restock_qty']);
    $category_id = intval($_POST['category_id']);
    $employee_id = intval($_POST['employee_id']);
    $upload_error = '';
    $product_image = null;

    // Get current image path
    $current_image = '';
    $get_image_query = "SELECT product_image FROM tbl_products WHERE product_id = ?";
    $stmt = mysqli_prepare($conn, $get_image_query);
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $current_image);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Handle file upload if new image is provided
    if (!empty($_FILES['product_image']['name'])) {
        if ($_FILES['product_image']['error'] == UPLOAD_ERR_OK) {
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            $file_type = $_FILES['product_image']['type'];
            
            if (in_array($file_type, $allowed_types)) {
                $upload_dir = 'uploads/products/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
                
                $file_ext = pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION);
                $unique_name = uniqid('product_', true) . '.' . $file_ext;
                $target_path = $upload_dir . $unique_name;
                
                if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target_path)) {
                    // Delete old image if it exists
                    if (!empty($current_image)) {
                        $old_image_path = $upload_dir . $current_image;
                        if (file_exists($old_image_path)) {
                            unlink($old_image_path);
                        }
                    }
                    $product_image = $unique_name;
                } else {
                    $upload_error = 'Failed to move uploaded file';
                }
            } else {
                $upload_error = 'Invalid file type. Only JPG, PNG, and GIF are allowed';
            }
        } else {
            $upload_error = 'File upload error: ' . $_FILES['product_image']['error'];
        }
    } else {
        // Keep existing image if no new upload
        $product_image = $current_image;
    }

    // Validate inputs
    $errors = [];
    if (empty($product_name)) $errors[] = 'Product name is required';
    if ($selling_price <= 0) $errors[] = 'Invalid selling price';
    if ($category_id <= 0) $errors[] = 'Invalid category';
    if ($employee_id <= 0) $errors[] = 'Invalid employee';
    if (!empty($upload_error)) $errors[] = $upload_error;

    if (!empty($errors)) {
        $error_message = implode('<br>', $errors);
        echo "<script>alert('Error: $error_message'); window.location.href = 'index_admin.php?page=product';</script>";
        exit;
    }

    // Prepare SQL statement
    $query_edit = "UPDATE tbl_products SET 
                    product_name = ?, 
                    product_selling_price = ?, 
                    product_image = ?, 
                    product_quantity = ?, 
                    product_restock_qty = ?, 
                    category_id = ?, 
                    employee_id = ?
                WHERE product_id = ?";
    
    $stmt = mysqli_prepare($conn, $query_edit);
    if ($stmt) {
        mysqli_stmt_bind_param(
            $stmt, 
            'sdsiiiii',
            $product_name,
            $selling_price,
            $product_image,
            $product_quantity,
            $product_restock_qty,
            $category_id,
            $employee_id,
            $product_id
        );

        if (mysqli_stmt_execute($stmt)) {
            $message = 'Product updated successfully';
        } else {
            $message = 'Error updating product: ' . mysqli_error($conn);
        }
        
        mysqli_stmt_close($stmt);
    } else {
        $message = 'Database error: ' . mysqli_error($conn);
    }

    echo "<script>alert('$message'); window.location.href = 'index_admin.php?page=products';</script>";
    exit;
}


        // Handle deletion
        if (isset($_POST['delete'])) {
            $product_id = intval($_POST['delete']);

            if ($product_id <= 0) {
                echo "<script>alert('Invalid product ID'); window.location.href = 'index_admin.php?page=products';</script>";
                exit;
            }

            $query_delete = "DELETE FROM tbl_products WHERE product_id = ?";
            $stmt = mysqli_prepare($conn, $query_delete);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "i", $product_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                echo "<script>alert('Product deleted successfully'); window.location.href = 'index_admin.php?page=products';</script>";
            } else {
                echo "<script>alert('Failed to delete product'); window.location.href = 'index_admin.php?page=products';</script>";
            }
            exit;
        }
    ?>
