<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "code_louisville";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Delete logic
$sql = "DELETE FROM todo WHERE id='".$_GET['id']."' ";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
