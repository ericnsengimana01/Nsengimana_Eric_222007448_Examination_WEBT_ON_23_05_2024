<?php
// Include the database connection file
require_once "databaseconnection1.php";

// Insert operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    // Sanitize input data
    $title = $_POST['title'];
    $lesson_id = $_POST['lesson_id'];
    $duration = $_POST['duration'];
    $user_id = $_POST['user_id'];
    
    // Prepare and bind parameters for insertion
    $sql = "INSERT INTO lesson (title, lesson_id, duration, user_id) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssss", $title, $lesson_id, $duration, $user_id);
    
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
    $lesson_id = $_POST['lesson_id'];
    $newtitle = $_POST['newtitle'];
    $newcaurse_id = $_POST['newcaurse_id'];
    $newduration = $_POST['newduration'];
    $newuser_id = $_POST['newuser_id'];
   
  
    // Prepare and bind parameters for update
    $sql = "UPDATE lesson SET title=?, caurse_id=?, duration=?, user_id=? WHERE lesson_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssi", $newtitle, $newcaurse_id, $newduration, $newuser_id, $lesson_id);
    
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
    $lesson_id = $_POST['lesson_id'];

    // Prepare and bind parameter for deletion
    $sql = "DELETE FROM lesson WHERE lesson_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $lesson_id);

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
    $lesson_id = $_POST['lesson_id'];
    
    // Prepare and bind parameter for selection
    $sql = "SELECT * FROM lesson WHERE lesson_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $lesson_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display result
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "lesson_id: " . $row["lesson_id"] . "<br>";
        echo "title: " . $row["title"] . "<br>";
        echo "caurse_id: " . $row["caurse_id"] . "<br>";
        echo "duration: " . $row["duration"] . "<br>";
        echo "user_id: " . $row["user_id"] . "<br>";
    
      
       
    } else {
        echo "No lesson found with the provided ID.";
    }
}

// View operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['view'])) {
    // Prepare SQL query to retrieve all lesson
    $sql = "SELECT * FROM lesson";
    $result = $connection->query($sql);

    // Display result
    if ($result->num_rows > 0) {
        echo "<h2>Lesson Information</h2>";
        echo "<table border='1'>";
        echo "<tr><th>lesson_id</th><th>title</th><th>caurse_id</th><th>duration</th><th>user_id</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["lesson_id"] . "</td>";
            echo "<td>" . $row["title"] . "</td>";
            echo "<td>" . $row["caurse_id"] . "</td>";
            echo "<td>" . $row["duration"] . "</td>";
            echo "<td>" . $row["user_id"] . "</td>";
            
           
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No records found";
    }
}
?>
