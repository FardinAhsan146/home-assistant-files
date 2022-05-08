<?php
$servername = "homeassistant.local";
$username = "homeassistant";
$password = "admin123";
$db="homeassistant";
$conn = mysqli_connect($servername, $username, $password, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>