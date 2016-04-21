<?php
$servername = "dbhost-mysql.cs.missouri.edu";
$username = "mmhkwc";
$password = "RgS8HC6L";
$dbase = "stockstalk";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>