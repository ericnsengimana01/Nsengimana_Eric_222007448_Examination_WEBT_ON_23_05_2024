<?php
// Include the database connection file
require_once "databaseconnection1.php";

// Handling POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $fname  = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $district = $_POST['district'];
    $sector = $_POST['sector'];
    $village = $_POST['village'];
    $role = $_POST['role'];
    // Preparing SQL query
    $sql = "INSERT INTO users (fname, lname, email, password, District, sector, village, role) 
    VALUES ('$fname','$lname','$email','$password','$district','$sector','$village','$role')"; // Added a closing single quote here

    // Executing SQL query
    if ($connection->query($sql) === TRUE) {
        echo "New record created successfully";
        header("Location: index.html"); // Redirect to home page after successful login
    } else {
        // Displaying error message if query execution fails
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// Closing database connection
$connection->close();
?>
