<?php
//config file 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mediawan";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>