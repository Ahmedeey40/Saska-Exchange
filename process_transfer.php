<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

// Halkan waxaad ku qori kartaa DB ama diiwaan gelin
echo "<h2>Transfer Sent Successfully!</h2>";
echo "<pre>";
print_r($_POST);
echo "</pre>";
