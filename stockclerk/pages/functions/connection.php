<?php
// Database connection settings
$servername = "localhost"; // Host name or IP address of your MySQL server
$username = "root"; // Database username
$password = ""; // Database password
$dbname = "chronological_database_sis"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
