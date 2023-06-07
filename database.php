<?php
$servername = "localhost"; 
$username = "root";
$password = ""; 
$database = "db_tijani_tatu_150397";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else{
echo "Connected successfully";
}


?>

