<form action="process_exchange.php" method="POST">
  <label>From Currency:</label>
  <input type="text" name="from_currency" required><br>

  <label>To Currency:</label>
  <input type="text" name="to_currency" required><br>

  <label>Network:</label>
  <input type="text" name="network"><br>

  <label>Wallet Address:</label>
  <input type="text" name="wallet"><br>

  <label>Amount:</label>
  <input type="number" step="0.01" name="amount" required><br>

  <label>Note:</label>
  <textarea name="note"></textarea><br>

  <button type="submit">Submit Exchange</button>
</form>