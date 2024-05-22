<?php
// Include the database connection file
require_once "databaseconnection1.php";

// Insert operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    // Sanitize input data
    $newscore = $_POST['newscore'];
    $newuser_id = $_POST['newuser_id'];
    $newlesson_id = $_POST['newlesson_id'];
    $newcompletion_date = $_POST['newcompletion_date'];
    $newcompletion_status = $_POST['newcompletion_status'];
    
    // Prepare and bind parameters for insertion
    $sql = "INSERT INTO progress (score, user_id, lesson_id, completion_date, completion_status) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssss", $newscore, $newuser_id, $newlesson_id, $newcompletion_date, $newcompletion_status);
    
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
    $progress_id = $_POST['progress_id'];
    $newscore = $_POST['newscore'];
    $newuser_id = $_POST['newuser_id'];
    $newlesson_id = $_POST['newlesson_id'];
    $newcompletion_date = $_POST['newcompletion_date'];
    $newcompletion_status = $_POST['newcompletion_status'];

    // Prepare and bind parameters for update
    $sql = "UPDATE progress SET score=?, user_id=?, lesson_id=?, completion_date=?, completion_status=? WHERE progress_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssssi", $newscore, $newuser_id, $newlesson_id, $newcompletion_date, $newcompletion_status, $progress_id);
    
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
    $progress_id = $_POST['progress_id'];

    // Prepare and bind parameter for deletion
    $sql = "DELETE FROM progress WHERE progress_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $progress_id);

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
    $progress_id = $_POST['progress_id'];
    
    // Prepare and bind parameter for selection
    $sql = "SELECT * FROM progress WHERE progress_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $progress_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display result
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "progress_id: " . $row["progress_id"] . "<br>";
        echo "score: " . $row["score"] . "<br>";
        echo "user_id: " . $row["user_id"] . "<br>";
        echo "lesson_id: " . $row["lesson_id"] . "<br>";
        echo "completion_date: " . $row["completion_date"] . "<br>";
        echo "completion_status: " . $row["completion_status"] . "<br>";
    } else {
        echo "No progress found with the provided ID.";
    }
}

// View operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['view'])) {
    // Prepare SQL query to retrieve all progresses
    $sql = "SELECT * FROM progress";
    $result = $connection->query($sql);

    // Display result
    if ($result->num_rows > 0) {
        echo "<h2>Progress Information</h2>";
        echo "<table border='1'>";
        echo "<tr><th>progress_id</th><th>score</th><th>user_id</th><th>Lesson_id</th><th>Completion Date</th><th>Completion Status</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["progress_id"] . "</td>";
            echo "<td>" . $row["score"] . "</td>";
            echo "<td>" . $row["user_id"] . "</td>";
            echo "<td>" . $row["lesson_id"] . "</td>";
            echo "<td>" . $row["completion_date"] . "</td>";
            echo "<td>" . $row["completion_status"] . "</td>";
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
