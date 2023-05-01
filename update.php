<?php
$email = $_POST['email'];
$available = $_POST['available'];

// connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// update query
$sql = "UPDATE tb SET available='$available' WHERE email='$email'";
if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

// close connection
mysqli_close($conn);
?>



