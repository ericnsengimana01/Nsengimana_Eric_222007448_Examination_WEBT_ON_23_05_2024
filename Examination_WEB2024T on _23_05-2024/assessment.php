<?php
// Include the database connection file
require_once "databaseconnection1.php";

// Insert operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    // Sanitize input data
    $score = $_POST['score'];
    $completion_status_status = $_POST['completion_status'];
    $user_id = $_POST['user_id'];
    
    // Prepare and bind parameters for insertion
    $sql = "INSERT INTO assessment (score, completion_status, user_id) VALUES (?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sss", $score, $completion_status, $user_id);
    
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
    $newassessment_id = $_POST['newassessment_id'];
    $newscore = $_POST['newscore'];
    $newcompletion_status = $_POST['newcompletion_status'];
    $newuser_id = $_POST['newuser_id'];

    // Prepare and bind parameters for update
    $sql = "UPDATE assessment SET score=?, completion_status=?, user_id=? WHERE assessment_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssi", $newscore, $newcompletion_status, $newuser_id, $newassessment_id);
    
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
    $newassessment_id = $_POST['newassessment_id'];

    // Prepare and bind parameter for deletion
    $sql = "DELETE FROM assessment WHERE assessment_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $newassessment_id);

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
    $newassessment_id = $_POST['newassessment_id'];
    
    // Prepare and bind parameter for selection
    $sql = "SELECT * FROM assessment WHERE assessment_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $newassessment_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display result
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "assessment_id: " . $row["assessment_id"] . "<br>";
        echo "score: " . $row["score"] . "<br>";
        echo "completion_status: " . $row["completion_status"] . "<br>";
        echo "user_id: " . $row["user_id"] . "<br>";
    } else {
        echo "No assessment found with the provided ID.";
    }
}

// View operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['view'])) {
    // Prepare SQL query to retrieve all assessments
    $sql = "SELECT * FROM assessment";
    $result = $connection->query($sql);

    // Display result
    if ($result->num_rows > 0) {
        echo "<h2>Assessment Information</h2>";
        echo "<table border='1'>";
        echo "<th>assessment_id</th><th>Score</th><th>completion_status</th><th>User_id</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["assessment_id"] . "</td>";
            echo "<td>" . $row["score"] . "</td>";
            echo "<td>" . $row["completion_status"] . "</td>";
            echo "<td>" . $row["user_id"] . "</td>";
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
