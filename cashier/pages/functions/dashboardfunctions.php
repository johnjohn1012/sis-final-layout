<?php
require('./includes/connection.php'); // Ensure this file contains your DB connection setup

// Fetch total transactions
$transactions_query = $conn->query("SELECT COUNT(*) AS total FROM transactions");
$transactions = $transactions_query->fetch(PDO::FETCH_ASSOC)['total'];

// Fetch total sales
$sales_query = $conn->query("SELECT SUM(amount) AS total FROM sales");
$sales = $sales_query->fetch(PDO::FETCH_ASSOC)['total'];

// Fetch pending orders
$pending_orders_query = $conn->query("SELECT COUNT(*) AS total FROM orders WHERE status = 'pending'");
$pending_orders = $pending_orders_query->fetch(PDO::FETCH_ASSOC)['total'];
?>