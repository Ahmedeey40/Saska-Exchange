
<?php
$token = $_GET['token'];
?>

<form action="update_password.php" method="POST">
    <input type="hidden" name="token" value="<?php echo $token; ?>">
    <label>New Password:</label>
    <input type="password" name="new_password" required>
    <button type="submit" name="reset_now">Reset Password</button>
</form>