<?php
// Include the database connection file
require_once "databaseconnection1.php";

// Insert operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    // Sanitize input data
    $workshop_name = $_POST['workshop_name'];
    $description = $_POST['description'];
    $instructor_id = $_POST['instructor_id'];
    $location = $_POST['location'];
    $instruction = $_POST['instruction'];
    $registration_deadline = $_POST['registration_deadline'];
    $caurse_id = $_POST['caurse_id'];

    
    // Prepare and bind parameters for insertion
    $sql = "INSERT INTO workshops (workshop_name, description, instructor_id, location, instruction, registration_deadline, caurse_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssssss", $workshop_name, $description, $instructor_id, $location, $instruction, $registration_deadline, $caurse_id);
    
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
  
    $newworkshop_name = $_POST['newworkshop_name'];
    $newdescription = $_POST['newdescription'];
    $newinstructor_id = $_POST['newinstructor_id'];
    $newlocation = $_POST['newlocation'];
    $newinstruction = $_POST['newinstruction'];
    $newregistration_deadline = $_POST['newregistration_deadline'];
    $newcaurse_id = $_POST['newcaurse_id'];
   

    // Prepare and bind parameters for update
    $sql = "UPDATE workshops SET workshop_name=?, description=?, instructor_id=?, location=?, instruction=?, registration_deadline=?, caurse_id=? WHERE workshop_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssssssi", $newworkshop_name, $newdescription, $newinstructor_id, $newlocation, $newinstruction, $newregistration_deadline, $newcaurse_id, $workshop_id);
    
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
    $workshop_id = $_POST['workshop_id'];

    // Prepare and bind parameter for deletion
    $sql = "DELETE FROM workshops WHERE workshop_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $workshop_id);

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
    $workshop_id = $_POST['workshop_id'];
    
    // Prepare and bind parameter for selection
    $sql = "SELECT * FROM workshops WHERE workshop_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $workshop_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display result
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "workshop_id: " . $row["workshop_id"] . "<br>";
        echo "workshop_name: " . $row["workshop_name"] . "<br>";
        echo "description: " . $row["description"] . "<br>";
        echo "instructor_id: " . $row["instructor_id"] . "<br>";
        echo "location: " . $row["location"] . "<br>";
        echo "instruction: " . $row["instruction"] . "<br>";
        echo "registration_deadline: " . $row["registration_deadline"] . "<br>";
        echo "caurse_id: " . $row["caurse_id"] . "<br>";
      
    } else {
        echo "No user found with the provided ID.";
    }
    $stmt->close();
}

// View operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['view'])) {
    // Prepare SQL query to retrieve all workshops
    $sql = "SELECT * FROM workshops";
    $result = $connection->query($sql);

    // Display result
    if ($result->num_rows > 0) {
        echo "<h2>workshops Information</h2>";
        echo "<table border='1'>";
        echo "<tr><th>workshop_id</th><th>workshop_name</th><th>description</th><th>instructor_id</th><th>location</th><th>instruction</th><th>registration_deadline</th><th>caurse_id</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["workshop_id"] . "</td>";
            echo "<td>" . $row["workshop_name"] . "</td>";
            echo "<td>" . $row["description"] . "</td>";
            echo "<td>" . $row["instructor_id"] . "</td>";
            echo "<td>" . $row["location"] . "</td>";
            echo "<td>" . $row["instruction"] . "</td>";
            echo "<td>" . $row["registration_deadline"] . "</td>";
            echo "<td>" . $row["caurse_id"] . "</td>";
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
