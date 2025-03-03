<?php
// Include database connection
include('connection.php');


// Fetch categories from the database
$query = "SELECT * FROM tbl_categories ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

// Add category
if(isset($_POST['add_category'])){
    $category_name = $_POST['category_name'];
    $category_description = $_POST['category_description'];

    $query_add = "INSERT INTO tbl_categories (category_name, category_description) VALUES ('$category_name', '$category_description')";
    mysqli_query($conn, $query_add);
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        Swal.fire({
            title: 'Success!',
            text: 'Recorded successfully',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'index_admin.php?page=category';
        });
    </script>";
    
    exit;  // Stop the execution after redirection
}

// Edit category
if(isset($_POST['edit_category'])){
    $category_id = $_POST['category_id'];
    $category_name = $_POST['category_name'];
    $category_description = $_POST['category_description'];

    $query_edit = "UPDATE tbl_categories SET category_name = '$category_name', category_description = '$category_description' WHERE category_id = $category_id";
    mysqli_query($conn, $query_edit);
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        Swal.fire({
            title: 'Updated!',
            text: 'Updated successfully',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'index_admin.php?page=category';
        });
    </script>";
    
    exit;  // Stop the execution after redirection
}

// Handle deletion
if (isset($_POST['delete'])) {
    $category_id = $_POST['delete'];
    $query_delete = "DELETE FROM tbl_categories WHERE category_id = $category_id";
    mysqli_query($conn, $query_delete);
    echo "<script>alert('Deleted successfully'); window.location.href = 'index_admin.php?page=category';</script>";
    exit; // Stop further script execution after redirection
}
?>
