<?php
$servername = "127.0.0.1";
$username = "root";
$password = ""; //Put your mysql password here if you have one 
$dbname = "StudentDB";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully!";
}
?>
