<?php
// Include the database connection file
require_once "databaseconnection1.php";

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO assessment(score, completion_status, user_id) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $score, $completion_status, $user_id);
    
    // Set parameters and execute the statement
    $score = $_POST['score'];
    $completion_status = $_POST['completion_status'];
    $user_id = $_POST['user_id'];
  
    
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
