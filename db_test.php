<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$conn = new mysqli('10.0.2.13', 'root', '', 'portfolio');

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}
echo "✅ Connected successfully!";
?>

