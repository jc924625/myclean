<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "myclean_db"; // make sure database name matches

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
