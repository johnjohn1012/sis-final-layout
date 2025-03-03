<?php
// Include database connection
include('connection.php');

// Fetch suppliers from the database
$query = "SELECT * FROM tbl_suppliers ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

// Add supplier
if(isset($_POST['add_supplier'])){
    $supplier_name = $_POST['supplier_name'];
    $contact_person = $_POST['contact_person'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $query_add = "INSERT INTO tbl_suppliers (supplier_name, contact_person, address, phone, email) VALUES ('$supplier_name', '$contact_person', '$address', '$phone', '$email')";
    mysqli_query($conn, $query_add);
    echo "<script>alert('Recorded successfully'); window.location.href = 'index_admin.php?page=suppliers';</script>";
    exit;  // Stop the execution after redirection
}

// Edit supplier
if(isset($_POST['edit_supplier'])){
    $supplier_id = $_POST['supplier_id'];
    $supplier_name = $_POST['supplier_name'];
    $contact_person = $_POST['contact_person'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $query_edit = "UPDATE tbl_suppliers SET supplier_name = '$supplier_name', contact_person = '$contact_person', address = '$address', phone = '$phone', email = '$email' WHERE supplier_id = $supplier_id";
    mysqli_query($conn, $query_edit);
    echo "<script>alert('Updated successfully'); window.location.href = 'index_admin.php?page=suppliers';</script>";
    exit;  // Stop the execution after redirection
}

// Handle deletion
if (isset($_POST['delete'])) {
    $supplier_id = $_POST['delete'];
    $query_delete = "DELETE FROM tbl_suppliers WHERE supplier_id = $supplier_id";
    mysqli_query($conn, $query_delete);
    echo "<script>alert('Deleted successfully'); window.location.href = 'index_admin.php?page=suppliers';</script>";
    exit; // Stop further script execution after redirection
}
?>
