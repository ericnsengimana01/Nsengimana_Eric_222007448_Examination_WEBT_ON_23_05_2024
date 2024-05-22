<?php
// Include the database connection file
require_once "databaseconnection1.php";

// Insert operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    // Sanitize input data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];
    $expertise = $_POST['expertise'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    
    // Prepare and bind parameters for insertion
    $sql = "INSERT INTO instructors (fname, lname, email, bio, expertise, username, password, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssssss", $fname, $lname, $email, $bio, $expertise, $username, $password, $phone);
    
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
    $newid = $_POST['id'];
    $newfname = $_POST['newfname'];
    $newlname = $_POST['newlname'];
    $newemail = $_POST['newemail'];
    $newbio = $_POST['newbio'];
    $newexpertise = $_POST['newexpertise'];
    $newusername = $_POST['newusername'];
    $newpassword = $_POST['newpassword'];
    $newphone = $_POST['newphone'];

    // Prepare and bind parameters for update
    $sql = "UPDATE instructors SET fname=?, lname=?, email=?, bio=?, expertise=?, username=?, password=?, phone=? WHERE id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssssssi", $newfname, $newlname, $newemail, $newbio, $newexpertise, $newusername, $newupassword, $newphone, $newid);
    
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
    $id = $_POST['id'];

    // Prepare and bind parameter for deletion
    $sql = "DELETE FROM instructors WHERE id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

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
    $id = $_POST['id'];
    
    // Prepare and bind parameter for selection
    $sql = "SELECT * FROM instructors WHERE id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display result
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "id: " . $row["id"] . "<br>";
        echo "fname: " . $row["fname"] . "<br>";
        echo "lname: " . $row["lname"] . "<br>";
        echo "email: " . $row["email"] . "<br>";
        echo "bio: " . $row["bio"] . "<br>";
        echo "expertise: " . $row["expertise"] . "<br>";
        echo "username: " . $row["username"] . "<br>";
        echo "password: " . $row["password"] . "<br>";
        echo "phone: " . $row["phone"] . "<br>";
    } else {
        echo "No user found with the provided ID.";
    }
}

// View operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['view'])) {
    // Prepare SQL query to retrieve all instructorss
    $sql = "SELECT * FROM instructors";
    $result = $connection->query($sql);

    // Display result
    if ($result->num_rows > 0) {
        echo "<h2>instructors Information</h2>";
        echo "<table border='1'>";
        echo "<tr><th>id</th><th>fname</th><th>lname</th><th>email</th><th>bio</th><th>expertise</th><th>username</th><th>password</th><th>phone</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["fname"] . "</td>";
            echo "<td>" . $row["lname"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["bio"] . "</td>";
            echo "<td>" . $row["expertise"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["password"] . "</td>";
            echo "<td>" . $row["phone"] . "</td>";
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
