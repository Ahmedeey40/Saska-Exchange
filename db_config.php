<?php
$servername = "localhost";
$username = "root";
$password = ""; // Haddii aad leedahay password geli halkan
$dbname = "money_exchange";

// Connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>