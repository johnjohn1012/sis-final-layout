<?php
include('connection.php');

// Function to fetch all raw ingredients
function getRawIngredients() {
    global $conn;
    $query = "SELECT * FROM raw_ingredients";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Function to add a new raw ingredient
function addRawIngredient($name, $description, $unit, $stock, $cost, $reorder, $supplier_id, $category_id, $employee_id) {
    global $conn;
    $query = "INSERT INTO raw_ingredients (name, description, unit_of_measure, stock_quantity, cost_per_unit, reorder_level, supplier_id, category_id, employee_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssidiiii", $name, $description, $unit, $stock, $cost, $reorder, $supplier_id, $category_id, $employee_id);
    return mysqli_stmt_execute($stmt);
}

// Function to get a single raw ingredient by ID
function getRawIngredientById($id) {
    global $conn;
    $query = "SELECT * FROM raw_ingredients WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

// Function to update a raw ingredient
function updateRawIngredient($id, $name, $description, $unit, $stock, $cost, $reorder, $supplier_id, $category_id, $employee_id) {
    global $conn;
    $query = "UPDATE raw_ingredients SET name=?, description=?, unit_of_measure=?, stock_quantity=?, cost_per_unit=?, reorder_level=?, supplier_id=?, category_id=?, employee_id=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssidiiiii", $name, $description, $unit, $stock, $cost, $reorder, $supplier_id, $category_id, $employee_id, $id);
    return mysqli_stmt_execute($stmt);
}

// Function to delete a raw ingredient
function deleteRawIngredient($id) {
    global $conn;
    $query = "DELETE FROM raw_ingredients WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
}
?>
