<?php
include 'connection.php';

// Validate and sanitize input parameters
$page = isset($_GET['p']) && ctype_digit($_GET['p']) ? (int)$_GET['p'] : 1;
$limit = isset($_GET['limit']) && ctype_digit($_GET['limit']) ? (int)$_GET['limit'] : 5;
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Ensure minimum values
$page = max($page, 1);
$limit = max($limit, 5);
$offset = ($page - 1) * $limit;

// Prepare SQL query with parameterized statements
$query = "SELECT * FROM tbl_categories 
          WHERE category_name LIKE CONCAT('%', ?, '%') 
          ORDER BY created_at ASC 
          LIMIT ? OFFSET ?";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "sii", $search, $limit, $offset);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Count total categories
$countQuery = "SELECT COUNT(*) AS total FROM tbl_categories 
              WHERE category_name LIKE CONCAT('%', ?, '%')";
$stmtCount = mysqli_prepare($conn, $countQuery);
mysqli_stmt_bind_param($stmtCount, "s", $search);
mysqli_stmt_execute($stmtCount);
$countResult = mysqli_stmt_get_result($stmtCount);
$totalCategories = mysqli_fetch_assoc($countResult)['total'];
$totalPages = max(ceil($totalCategories / $limit), 1);
?>



