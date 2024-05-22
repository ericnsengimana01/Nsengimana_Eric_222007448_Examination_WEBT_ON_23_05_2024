<?php
// Include the database connection file
require_once "databaseconnection1.php";

// Insert operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    // Sanitize input data
    $resource_name = $_POST['resource_name'];
    $type = $_POST['type'];
    $ratings = $_POST['ratings'];
    $aploaded_by_instructor_id = $_POST['aploaded_by_instructor_id'];
    $uploaded_date = $_POST['uploaded_date'];
    $language = $_POST['language'];
    
    // Prepare and bind parameters for insertion
    $sql = "INSERT INTO conflict_resolution_resources (resource_name, type, ratings, aploaded_by_instructor_id, uploaded_date, language) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssss", $resource_name, $type, $ratings, $aploaded_by_instructor_id, $uploaded_date, $language);
    
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
    $resource_id = $_POST['resource_id'];
    $newresource_name = $_POST['newresource_name'];
    $newtype = $_POST['newtype'];
    $newratings = $_POST['newratings'];
    $newaploaded_by_instructor_id = $_POST['newaploaded_by_instructor_id'];
    $newuploaded_date = $_POST['newuploaded_date'];
    $newlanguage = $_POST['newlanguage'];

    // Prepare and bind parameters for update
    $sql = "UPDATE conflict_resolution_resources SET resource_name=?, type=?, ratings=?, aploaded_by_instructor_id=?, uploaded_date=?, language=? WHERE resource_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssssi", $newresource_name, $newtype, $newratings, $newaploaded_by_instructor_id, $newuploaded_date, $newlanguage, $resource_id);
    
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
    $resource_id = $_POST['resource_id'];

    // Prepare and bind parameter for deletion
    $sql = "DELETE FROM conflict_resolution_resources WHERE resource_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $resource_id);

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
    $resource_id = $_POST['resource_id'];
    
    // Prepare and bind parameter for selection
    $sql = "SELECT * FROM conflict_resolution_resources WHERE resource_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $resource_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display result
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "resource_id: " . $row["resource_id"] . "<br>";
        echo "resource_name: " . $row["resource_name"] . "<br>";
        echo "type: " . $row["type"] . "<br>";
        echo "ratings: " . $row["ratings"] . "<br>";
        echo "aploaded_by_instructor_id: " . $row["aploaded_by_instructor_id"] . "<br>";
        echo "uploaded_date: " . $row["uploaded_date"] . "<br>";
        echo "language: " . $row["language"] . "<br>";
       
    } else {
        echo "No resource found with the provided ID.";
    }
}

// View operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['view'])) {
    // Prepare SQL query to retrieve all conflict_resolution_resources
    $sql = "SELECT * FROM conflict_resolution_resources";
    $result = $connection->query($sql);

    // Display result
    if ($result->num_rows > 0) {
        echo "<h2>Conflict Resolution Resources Information</h2>";
        echo "<table border='1'>";
        echo "<tr><th>resource_id</th><th>resource_name</th><th>type</th><th>ratings</th><th>aploaded_by_instructor_id</th><th>uploaded_date</th><th>language</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["resource_id"] . "</td>";
            echo "<td>" . $row["resource_name"] . "</td>";
            echo "<td>" . $row["type"] . "</td>";
            echo "<td>" . $row["ratings"] . "</td>";
            echo "<td>" . $row["aploaded_by_instructor_id"] . "</td>";
            echo "<td>" . $row["uploaded_date"] . "</td>";
            echo "<td>" . $row["language"] . "</td>";
           
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
