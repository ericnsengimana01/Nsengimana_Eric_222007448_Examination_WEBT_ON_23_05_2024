<?php
// Include the database connection file
require_once "databaseconnection1.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO users(fname, lname, email, password, district, sector, village, role) VALUES (?, ?, ?, ?, ?,?,?,?)");
     $stmt->bind_param("ssssssss", $fname, $lname, $email, $password, $district, $sector, $village, $role);
    
    // Set parameters and execute
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $district = $_POST['district'];
    $sector = $_POST['sector'];
    $village = $_POST['village'];
    $role = $_POST['role'];
    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>
