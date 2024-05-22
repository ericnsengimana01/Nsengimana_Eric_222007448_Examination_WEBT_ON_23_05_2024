<?php
// Include the database connection file
require_once "databaseconnection1.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO instructors (fname, lname, email, bio, expertise, username, password, phone) VALUES (?, ?, ?, ?, ?,?,?,?)");
     $stmt->bind_param("ssssssss", $fname, $lname, $email, $bio, $expertise, $username, $password, $phone);
    
    // Set parameters and execute
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];
    $expertise = $_POST['expertise'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>
