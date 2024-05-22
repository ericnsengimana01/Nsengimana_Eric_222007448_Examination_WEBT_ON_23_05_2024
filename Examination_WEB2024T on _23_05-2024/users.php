<?php
// Include the database connection file
require_once "databaseconnection1.php";

// Insert operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    // Sanitize input data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $district = $_POST['district'];
    $sector = $_POST['sector'];
    $village = $_POST['village'];
    $role = $_POST['role'];
    
    // Prepare and bind parameters for insertion
    $sql = "INSERT INTO users (fname, lname, email, password, district, sector, village, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssssss", $fname, $lname, $email, $password, $district, $sector, $village, $role);
    
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
    $user_id = $_POST['user_id'];
    $newfname = $_POST['newfname'];
    $newlname = $_POST['newlname'];
    $newemail = $_POST['newemail'];
    $newpassword = $_POST['newpassword'];
    $newdistrict = $_POST['newdistrict'];
    $newsector = $_POST['newsector'];
    $newvillage = $_POST['newvillage'];
    $newrole = $_POST['newrole'];

    // Prepare and bind parameters for update
    $sql = "UPDATE users SET fname=?, lname=?, email=?, password=?, district=?, sector=?, village=?, role=? WHERE user_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssssssi", $newfname, $newlname, $newemail, $newpassword, $newdistrict, $newsector, $newvillage, $newrole, $user_id);
    
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
    $user_id = $_POST['user_id'];

    // Prepare and bind parameter for deletion
    $sql = "DELETE FROM users WHERE user_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $user_id);

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
    $user_id = $_POST['user_id'];
    
    // Prepare and bind parameter for selection
    $sql = "SELECT * FROM users WHERE user_id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display result
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "user_id: " . $row["user_id"] . "<br>";
        echo "fname: " . $row["fname"] . "<br>";
        echo "lname: " . $row["lname"] . "<br>";
        echo "email: " . $row["email"] . "<br>";
        echo "password: " . $row["password"] . "<br>";
        echo "district: " . $row["district"] . "<br>";
        echo "sector: " . $row["sector"] . "<br>";
        echo "village: " . $row["village"] . "<br>";
        echo "role: " . $row["role"] . "<br>";
    } else {
        echo "No user found with the provided ID.";
    }
    $stmt->close();
}

// View operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['view'])) {
    // Prepare SQL query to retrieve all users
    $sql = "SELECT * FROM users";
    $result = $connection->query($sql);

    // Display result
    if ($result->num_rows > 0) {
        echo "<h2>users Information</h2>";
        echo "<table border='1'>";
        echo "<tr><th>user_id</th><th>fname</th><th>lname</th><th>email</th><th>password</th><th>district</th><th>sector</th><th>village</th><th>role</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["user_id"] . "</td>";
            echo "<td>" . $row["fname"] . "</td>";
            echo "<td>" . $row["lname"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["password"] . "</td>";
            echo "<td>" . $row["district"] . "</td>";
            echo "<td>" . $row["sector"] . "</td>";
            echo "<td>" . $row["village"] . "</td>";
            echo "<td>" . $row["role"] . "</td>";
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
