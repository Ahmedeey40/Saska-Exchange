<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['transfer'] = [
        'from' => $_POST['from'],
        'to' => $_POST['to'],
        'amount' => $_POST['amount'],
        'fee' => $_POST['fee'],
        'total' => $_POST['total'],
        'network' => $_POST['network'] ?? '',
        'wallet' => $_POST['wallet'] ?? '',
        'number' => $_POST['number'] ?? '',
    ];
    header("Location: admin_confirm.php");
    exit();
}
?>
