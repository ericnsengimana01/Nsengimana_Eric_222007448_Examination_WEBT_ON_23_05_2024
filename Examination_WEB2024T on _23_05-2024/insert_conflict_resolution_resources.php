<?php
// Include the database connection file
require_once "databaseconnection1.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO conflict_resolution_resources (resource_name, type, ratings, aploaded_by_instructor_id, uploaded_date, language) VALUES (?, ?, ?, ?, ?,?)");
     $stmt->bind_param("ssssss", $resource_name, $type, $ratings, $aploaded_by_instructor_id, $uploaded_date, $language);
    
    // Set parameters and execute
    $resource_name = $_POST['resource_name'];
    $type = $_POST['type'];
    $ratings = $_POST['ratings'];
    $aploaded_by_instructor_id = $_POST['aploaded_by_instructor_id'];
    $uploaded_date = $_POST['uploaded_date'];
    $language = $_POST['language'];
    
    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>
