<?php
// Connection details
$host = "localhost";
$user = "admin";
$pass = "222007448";
$database = "virtual_conflict_resolution_training_platform";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>