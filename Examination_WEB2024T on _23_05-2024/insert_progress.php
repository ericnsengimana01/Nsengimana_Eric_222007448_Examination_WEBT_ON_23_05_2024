<?php
// Include the database connection file
require_once "databaseconnection1.php";

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO progress (user_id, score, lesson_id, completion_date, completion_status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $user_id, $score, $lesson_id, $completion_date, $completion_status);
    
    // Set parameters and execute the statement
    $user_id = $_POST['user_id'];
    $score = $_POST['score'];
    $lesson_id = $_POST['lesson_id'];
    $completion_date = $_POST['completion_date'];
     $completion_status = $_POST['completion_status'];
    

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
