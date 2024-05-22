<?php
// Include the database connection file
require_once "databaseconnection1.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO attendees (fname, lname, email, phone, user_id, organisation, job_title, registration_date) VALUES (?, ?, ?, ?, ?,?,?,?)");
     $stmt->bind_param("ssssssss", $fname, $lname, $email, $phone, $user_id, $organisation, $job_title, $registration_date);
    
    // Set parameters and execute
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $user_id = $_POST['user_id'];
    $organisation = $_POST['organisation'];
    $job_title = $_POST['job_title'];
    $registration_date = $_POST['registration_date'];
    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>
