<?php
// Include the database connection file
require_once "databaseconnection1.php";
//Nsengimana Eric 222007448Admin Registration Form -->

$uname = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT *FROM users WHERE email='$uname' AND password='$password'";
$result =$connection->query($sql);
if ($result->num_rows >0) {
  // echo "successfully loggedin!";
  header("Location: home.html");
      exit();
} else {
    echo "email and password is valid: " . $sql . "<br>" . $connection->error;
}

$connection->close();
?>