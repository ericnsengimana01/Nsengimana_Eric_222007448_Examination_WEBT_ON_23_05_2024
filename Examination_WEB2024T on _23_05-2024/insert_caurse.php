<?php
// Include the database connection file
require_once "databaseconnection1.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO caurse (caurse_name, description, duration, category, instructor_id, workshop_id) VALUES (?, ?, ?, ?, ?,?)");
     $stmt->bind_param("ssssss", $caurse_name, $description, $duration, $category, $instructor_id, $workshop_id);
    
    // Set parameters and execute
    $caurse_name = $_POST['caurse_name'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $category = $_POST['category'];
    $instructor_id = $_POST['instructor_id'];
    $workshop_id = $_POST['workshop_id'];
    
    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>
