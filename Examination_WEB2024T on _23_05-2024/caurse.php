<?php
// Include the database connection file
require_once "databaseconnection1.php";

// Insert operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    // Sanitize input data
    $caurse_name = $_POST['caurse_name'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $category = $_POST['category'];
     $instructor_id = $_POST['instructor_id'];
    $workshop_id = $_POST['workshop_id'];
   
    
    // Prepare and bind parameters for insertion
    $sql = "INSERT INTO caurse (caurse_name, description, duration, category, instructor_id, workshop_id ) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssss", $caurse_name, $description, $duration, $category,  $instructor_id, $workshop_id);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "Record added successfully.";
    } else {
        echo "Error adding record: " . $stmt->error;
    }
}

// Update operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Sanitize input data
    $caurse_id = $_POST['caurse_id'];
    $newcaurse_name = $_POST['newcaurse_name'];
    $newdescription = $_POST['newdescription'];
    $newduration = $_POST['newduration'];
    $newcategory = $_POST['newcategory'];
    $newinstructor_id = $_POST['newinstructor_id'];
    $newworkshop_id = $_POST['newworkshop_id'];
  
    // Prepare and bind parameters for update
    $sql = "UPDATE caurse SET caurse_name=?, description=?, duration=?, category=?,  instructor_id=?, workshop_id=? WHERE caurse_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssssi", $newcaurse_name, $newdescription, $newduration, $newcategory, $newinstructor_id, $newworkshop_id, $caurse_id);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

// Delete operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Sanitize input data
    $caurse_id = $_POST['caurse_id'];

    // Prepare and bind parameter for deletion
    $sql = "DELETE FROM caurse WHERE caurse_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $caurse_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}

// Read operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['read'])) {
    // Sanitize input data
    $caurse_id = $_POST['caurse_id'];
    
    // Prepare and bind parameter for selection
    $sql = "SELECT * FROM caurse WHERE caurse_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $caurse_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display result
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "caurse_id: " . $row["caurse_id"] . "<br>";
        echo "caurse_name: " . $row["caurse_name"] . "<br>";
        echo "description: " . $row["description"] . "<br>";
        echo "duration: " . $row["duration"] . "<br>";
        echo "category: " . $row["category"] . "<br>";
        echo "instructor_id: " . $row["instructor_id"] . "<br>";
        echo "workshop_id: " . $row["workshop_id"] . "<br>";
      
       
    } else {
        echo "No caurse found with the provided ID.";
    }
}

// View operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['view'])) {
    // Prepare SQL query to retrieve all caurse
    $sql = "SELECT * FROM caurse";
    $result = $connection->query($sql);

    // Display result
    if ($result->num_rows > 0) {
        echo "<h2>Conflict Resolution caurses Information</h2>";
        echo "<table border='1'>";
        echo "<tr><th>caurse_id</th><th>caurse_name</th><th>description</th><th>duration</th><th>category</th><th>instructor_id</th><th>workshop_id</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["caurse_id"] . "</td>";
            echo "<td>" . $row["caurse_name"] . "</td>";
            echo "<td>" . $row["description"] . "</td>";
            echo "<td>" . $row["duration"] . "</td>";
            echo "<td>" . $row["category"] . "</td>";
            echo "<td>" . $row["instructor_id"] . "</td>";
            echo "<td>" . $row["workshop_id"] . "</td>";
          
           
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No records found";
    }
}

