<?php
// Database connection settings
$host = "localhost";    // default XAMPP host
$user = "root";         // default XAMPP user
$pass = "";             // leave blank kung walang password sa phpMyAdmin
$dbname = "db_enrollment"; // name ng database mo

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>