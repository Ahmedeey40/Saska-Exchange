<?php
// exchange.php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sender = $_POST['sender'];
    $receiver = $_POST['receiver'];
    $amount = $_POST['amount'];
    $from_currency = $_POST['from_currency'];
    $to_currency = $_POST['to_currency'];
    $received_amount = $_POST['received_amount'];

    // Prepare and execute insert query
    $stmt = $conn->prepare("INSERT INTO exchanges (sender, receiver, amount, from_currency, to_currency, received_amount) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $sender, $receiver, $amount, $from_currency, $to_currency, $received_amount);

    if ($stmt->execute()) {
        echo "<h3>Exchange recorded successfully!</h3>";
    } else {
        echo "<h3>Error: " . $stmt->error . "</h3>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<h3>Invalid Request</h3>";
}
?>