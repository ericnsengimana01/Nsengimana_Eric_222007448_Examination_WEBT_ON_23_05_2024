<?php
// Include the database connection file
require_once "databaseconnection1.php";

// Insert operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    // Sanitize input data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $user_id = $_POST['user_id'];
    $organisation = $_POST['organisation'];
    $job_title = $_POST['job_title'];
    $registration_date = $_POST['registration_date'];
    
    // Prepare and bind parameters for insertion
    $sql = "INSERT INTO attendees (fname, lname, email, phone, user_id, organisation, job_title, registration_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssssss", $fname, $lname, $email, $phone, $user_id, $organisation, $job_title, $registration_date);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "Record added successfully.";
    } else {
        echo "Error adding record: " . $stmt->error;
    }
    $stmt->close();
}

// Update operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Sanitize input data
    $attendee_id = $_POST['attendee_id'];
    $newfname = $_POST['newfname'];
    $newlname = $_POST['newlname'];
    $newemail = $_POST['newemail'];
    $newphone = $_POST['newphone'];
    $newuser_id = $_POST['newuser_id'];
    $neworganisation = $_POST['neworganisation'];
    $newjob_title = $_POST['newjob_title'];
    $newregistration_date = $_POST['newregistration_date'];

    // Prepare and bind parameters for update
    $sql = "UPDATE attendees SET fname=?, lname=?, email=?, phone=?, user_id=?, organisation=?, job_title=?, registration_date=? WHERE attendee_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssssssi", $newfname, $newlname, $newemail, $newphone, $newuser_id, $neworganisation, $newjob_title, $newregistration_date, $attendee_id);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
}

// Delete operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Sanitize input data
    $attendee_id = $_POST['attendee_id'];

    // Prepare and bind parameter for deletion
    $sql = "DELETE FROM attendees WHERE attendee_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $attendee_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
    $stmt->close();
}

// Read operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['read'])) {
    // Sanitize input data
    $attendee_id = $_POST['attendee_id'];
    
    // Prepare and bind parameter for selection
    $sql = "SELECT * FROM attendees WHERE attendee_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $attendee_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display result
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "attendee_id: " . $row["attendee_id"] . "<br>";
        echo "fname: " . $row["fname"] . "<br>";
        echo "lname: " . $row["lname"] . "<br>";
        echo "email: " . $row["email"] . "<br>";
        echo "phone: " . $row["phone"] . "<br>";
        echo "user_id: " . $row["user_id"] . "<br>";
        echo "organisation: " . $row["organisation"] . "<br>";
        echo "job_title: " . $row["job_title"] . "<br>";
        echo "registration_date: " . $row["registration_date"] . "<br>";
    } else {
        echo "No user found with the provided ID.";
    }
    $stmt->close();
}

// View operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['view'])) {
    // Prepare SQL query to retrieve all attendees
    $sql = "SELECT * FROM attendees";
    $result = $connection->query($sql);

    // Display result
    if ($result->num_rows > 0) {
        echo "<h2>Attendees Information</h2>";
        echo "<table border='1'>";
        echo "<tr><th>attendee_id</th><th>fname</th><th>lname</th><th>email</th><th>phone</th><th>user_id</th><th>organisation</th><th>job_title</th><th>registration_date</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["attendee_id"] . "</td>";
            echo "<td>" . $row["fname"] . "</td>";
            echo "<td>" . $row["lname"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["phone"] . "</td>";
            echo "<td>" . $row["user_id"] . "</td>";
            echo "<td>" . $row["organisation"] . "</td>";
            echo "<td>" . $row["job_title"] . "</td>";
            echo "<td>" . $row["registration_date"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No records found";
    }
}

// Close connection
$connection->close();
?>
