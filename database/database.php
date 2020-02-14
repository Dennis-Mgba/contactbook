<?php
$DB_CONNECTION = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "";
$DB_DATABASE = "contactbook";

// Create connection
$conn = new mysqli($DB_CONNECTION, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Database connected successfully";

?>
