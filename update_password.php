

<?php
require_once "config.php";

if (isset($_POST['reset_now'])) {
    $token = $_POST['token'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $check = $conn->query("SELECT * FROM users WHERE reset_token='$token'");
    if ($check->num_rows > 0) {
        $conn->query("UPDATE users SET password='$new_password', reset_token=NULL WHERE reset_token='$token'");
        echo "Password updated. You can now login.";
    } else {
        echo "Invalid token.";
    }
}
?>