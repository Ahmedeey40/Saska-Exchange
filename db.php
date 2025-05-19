<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exchange_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Hubi xiriirka
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>