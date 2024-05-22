<?php
// Include the database connection file
require_once "databaseconnection1.php";

// Insert operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    // Prepare and bind parameters
    $stmt = $connection->prepare("INSERT INTO workshops (workshop_name, description, instructor_id, location, instruction, registration_deadline, caurse_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $workshop_name, $description, $instructor_id, $location, $instruction, $registration_deadline, $caurse_id);
    
    // Set parameters and execute
    $workshop_name = $_POST['workshop_name'];
    $description = $_POST['description'];
    $instructor_id = $_POST['instructor_id'];
    $location = $_POST['location'];
    $instruction = $_POST['instruction'];
    $registration_deadline = $_POST['registration_deadline'];
    $caurse_id = $_POST['caurse_id'];

    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Close connection
$connection->close();
?>
