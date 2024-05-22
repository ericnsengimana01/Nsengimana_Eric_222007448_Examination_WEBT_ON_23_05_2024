<?php
// Include the database connection file
require_once "databaseconnection1.php";

// Insert operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    // Sanitize input data
   
    $newissued_date = $_POST['newissued_date'];
    $newinstructor_id = $_POST['newinstructor_id'];
    $newis_verified = $_POST['newis_verified'];
    $newcompletion_caurse = $_POST['newcompletion_caurse'];
    
    // Prepare and bind parameters for insertion
    $sql = "INSERT INTO certificate (user_id, issued_date, instructor_id, is_verified, completion_caurse) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssss", $newuser_id, $newissued_date, $newinstructor_id, $newis_verified, $newcompletion_caurse);
    
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
    $newcert_id = $_POST['newcert_id'];
    $newuser_id = $_POST['newuser_id'];
    $newissued_date = $_POST['newissued_date'];
    $newinstructor_id = $_POST['newinstructor_id'];
    $newis_verified = $_POST['newis_verified'];
    $newcompletion_caurse = $_POST['newcompletion_caurse'];

    // Prepare and bind parameters for update
    $sql = "UPDATE certificate SET user_id=?, issued_date=?, instructor_id=?, is_verified=?, completion_caurse=? WHERE cert_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssssi", $newuser_id, $newissued_date, $newinstructor_id, $newis_verified, $newcompletion_caurse, $newcert_id);
    
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
    $cert_id = $_POST['cert_id'];

    // Prepare and bind parameter for deletion
    $sql = "DELETE FROM certificate WHERE cert_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $cert_id);

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
    $cert_id = $_POST['cert_id'];
    
    // Prepare and bind parameter for selection
    $sql = "SELECT * FROM certificate WHERE cert_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $cert_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display result
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "cert_id: " . $row["cert_id"] . "<br>";
        echo "user_id: " . $row["user_id"] . "<br>";
        echo "issued_date: " . $row["issued_date"] . "<br>";
        echo "instructor_id: " . $row["instructor_id"] . "<br>";
        echo "is_verified: " . $row["is_verified"] . "<br>";
        echo "completion_caurse: " . $row["completion_caurse"] . "<br>";
    } else {
        echo "No certificate found with the provided ID.";
    }
}

// View operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['view'])) {
    // Prepare SQL query to retrieve all certificatees
    $sql = "SELECT * FROM certificate";
    $result = $connection->query($sql);

    // Display result
    if ($result->num_rows > 0) {
        echo "<h2>certificate Information</h2>";
        echo "<table border='1'>";
        echo "<tr><th>cert_id</th><th>user_id</th><th>issued_date</th><th>instructor_id</th><th>Completion Date</th><th>Completion Status</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["cert_id"] . "</td>";
            echo "<td>" . $row["user_id"] . "</td>";
            echo "<td>" . $row["issued_date"] . "</td>";
            echo "<td>" . $row["instructor_id"] . "</td>";
            echo "<td>" . $row["is_verified"] . "</td>";
            echo "<td>" . $row["completion_caurse"] . "</td>";
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
