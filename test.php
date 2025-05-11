<?php
$servername = "10.0.2.13";
$username = "root";
$password = ""; // Replace with the root password if required
$dbname = "portfolio";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
