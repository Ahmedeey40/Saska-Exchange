<?php
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['transfer'])) {
    header("Location: index.php");
    exit();
}

$data = $_SESSION['transfer'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Confirm Transfer (Admin)</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f2f2f2; padding: 20px; }
    .form-box {
      background: white; padding: 20px; border-radius: 12px; max-width: 500px;
      margin: auto; box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .form-box h2 { text-align: center; }
    label { display: block; margin-top: 10px; font-weight: bold; }
    input, select { width: 100%; padding: 10px; border-radius: 6px; margin-top: 5px; }
    .btn { background: #5a3dfe; color: white; border: none; padding: 10px; width: 100%; margin-top: 15px; }
  </style>
</head>
<body>

<div class="form-box">
  <h2>Admin Transfer Confirmation</h2>

  <form method="post" action="process_transfer.php">
    <label>From</label>
    <input type="text" name="from" value="<?= htmlspecialchars($data['from']) ?>" readonly />

    <label>To</label>
    <select name="to">
      <option value="EVC-PLUSE" <?= $data['to'] == 'EVC-PLUSE' ? 'selected' : '' ?>>EVC-PLUSE</option>
      <option value="E-DAHAB" <?= $data['to'] == 'E-DAHAB' ? 'selected' : '' ?>>E-DAHAB</option>
      <option value="USDT" <?= $data['to'] == 'USDT' ? 'selected' : '' ?>>USDT</option>
    </select>

    <label>Amount</label>
    <input type="number" name="amount" value="<?= htmlspecialchars($data['amount']) ?>" readonly />

    <label>Fee</label>
    <input type="text" name="fee" value="<?= htmlspecialchars($data['fee']) ?>" readonly />

    <label>Total After Fee</label>
    <input type="text" name="total" value="<?= htmlspecialchars($data['total']) ?>" readonly />

    <?php if ($data['from'] === "USDT"): ?>
      <label>Network</label>
      <input type="text" name="network" value="<?= htmlspecialchars($data['network']) ?>" readonly />

      <label>Wallet Address</label>
      <input type="text" name="wallet" value="<?= htmlspecialchars($data['wallet']) ?>" />
    <?php else: ?>
      <label>Phone Number</label>
      <input type="text" name="number" value="<?= htmlspecialchars($data['number']) ?>" />
    <?php endif; ?>

    <button type="submit" class="btn">Send Now</button>
  </form>
</div>

</body>
</html>
