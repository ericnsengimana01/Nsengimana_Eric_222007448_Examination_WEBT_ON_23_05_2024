<?php
// Include the database connection file
require_once "databaseconnection1.php";

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO certificate (user_id, issued_date, instructor_id, is_verified, completion_caurse) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $user_id, $issued_date, $instructor_id, $is_verified, $completion_caurse);
    
    // Set parameters and execute the statement
    $user_id = $_POST['user_id'];
    $issued_date = $_POST['issued_date'];
    $instructor_id = $_POST['instructor_id'];
    $is_verified = $_POST['is_verified'];
     $completion_caurse = $_POST['completion_caurse'];
    

    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$connection->close();
?>
