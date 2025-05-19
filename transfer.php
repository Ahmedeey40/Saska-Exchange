<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}
$is_admin = $_SESSION['email'] === 'admin@gmail.com'; // CHANGE to your real admin email
?>

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>User Transfer Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f2f2f2;
      padding: 20px;
    }
    .form-box {
      background: white;
      padding: 20px;
      border-radius: 12px;
      max-width: 400px;
      margin: auto;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .form-box h2 {
      text-align: center;
      color: #333;
    }
    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }
    input, select {
      width: 100%;
      padding: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
      margin-top: 5px;
    }
    .swap-icon {
      font-size: 24px;
      color: #5a3dfe;
      cursor: pointer;
      margin: 10px auto;
      text-align: center;
      display: block;
    }
    .summary {
      margin-top: 20px;
      font-size: 14px;
      color: #333;
    }
    .btn {
      background: #5a3dfe;
      color: white;
      border: none;
      padding: 10px;
      width: 100%;
      border-radius: 6px;
      margin-top: 15px;
      font-weight: bold;
    }
    .back-btn {
      background: #aaa;
      margin-top: 10px;
    }
  </style>
</head>
<body>

<div class="form-box">
  <h2>Send Money</h2>

  <label>From</label>
  <select id="from" onchange="handleFromChange()">
    <option value="USDT">USDT</option>
    <option value="EVC-PLUSE">EVC-PLUSE</option>
    <option value="E-DAHAB">E-DAHAB</option>
  </select>

  <span class="swap-icon" onclick="swapAccounts()">⇅</span>

  <label>To</label>
  <select id="to" onchange="preventSameAccounts()">
    <option value="EVC-PLUSE">EVC-PLUSE</option>
    <option value="E-DAHAB">E-DAHAB</option>
    <option value="USDT">USDT</option>
  </select>

  <label>Amount ($)</label>
  <input type="number" id="amount" value="500" oninput="calculate()" min="0" />

  <div id="network-wrapper" style="display:none;">
    <label>USDT Network</label>
    <select id="network" onchange="calculate()">
      <option value="">-- Select Network --</option>
      <option value="TRC20">TRC20</option>
      <option value="BEP20">BEP20</option>
    </select>
    <label>Your Wallet Address</label>
    <input type="text" id="wallet" placeholder="Enter your wallet address" />
  </div>

  <div id="number-wrapper" style="display:none;">
    <label>Your Phone Number</label>
    <input type="text" id="number" placeholder="25261xxxxxx or 25262xxxxxx" />
  </div>

  <div class="summary">
    <p>Service Fee (1.1%): <span id="fee">$0.00</span></p>
    <p>Total Amount After Fee: <span id="total">$0.00</span></p>
  </div>

  <button class="btn" onclick="confirmPay()">Confirm and Pay</button>
  <a href="user_page.php"><button class="btn back-btn">Back</button></a>

  <div id="confirmation" style="margin-top: 20px; color: green; font-weight: bold;"></div>
</div>

<script>
  const evcPrefix = "25261";
  const edahabPrefix = "25262";

  function calculate() {
    let amount = parseFloat(document.getElementById("amount").value) || 0;
    let fee = (1.1 / 100) * amount;
    let total = amount - fee;
    document.getElementById("fee").innerText = "$" + fee.toFixed(2);
    document.getElementById("total").innerText = "$" + total.toFixed(2);
  }

  function swapAccounts() {
    const fromSelect = document.getElementById("from");
    const toSelect = document.getElementById("to");

    const temp = fromSelect.value;
    fromSelect.value = toSelect.value;
    toSelect.value = temp;

    handleFromChange();
    preventSameAccounts();
  }

  function preventSameAccounts() {
    const from = document.getElementById("from").value;
    const to = document.getElementById("to").value;

    if (from === to) {
      alert("From and To accounts cannot be the same.");
      document.getElementById("to").selectedIndex = 0;
    }
  }

  function handleFromChange() {
    const from = document.getElementById("from").value;
    const networkWrapper = document.getElementById("network-wrapper");
    const numberWrapper = document.getElementById("number-wrapper");

    // Reset fields
    document.getElementById("wallet").value = "";
    document.getElementById("number").value = "";

    if (from === "USDT") {
      networkWrapper.style.display = "block";
      numberWrapper.style.display = "none";
    } else if (from === "EVC-PLUSE" || from === "E-DAHAB") {
      networkWrapper.style.display = "none";
      numberWrapper.style.display = "block";
    } else {
      networkWrapper.style.display = "none";
      numberWrapper.style.display = "none";
    }

    preventSameAccounts();
  }

  function confirmPay() {
    const from = document.getElementById("from").value;
    const to = document.getElementById("to").value;
    const amount = parseFloat(document.getElementById("amount").value);
    const network = document.getElementById("network").value;
    const wallet = document.getElementById("wallet").value.trim();
    const number = document.getElementById("number").value.trim();

    if (from === to) {
      alert("From and To must be different.");
      return;
    }

    if (amount <= 0) {
      alert("Enter a valid amount.");
      return;
    }

    let fee = (1.1 / 100) * amount;
    let total = amount - fee;
    let message = `Amount: $${amount.toFixed(2)}\nFee: $${fee.toFixed(2)}\nTotal: $${total.toFixed(2)}\n`;

    if (from === "USDT") {
      if (!network || !wallet) {
        alert("Select network and enter wallet address.");
        return;
      }
      message += `Send USDT via ${network} to wallet: ${wallet}`;
    } else if (from === "EVC-PLUSE") {
      if (!number.startsWith(evcPrefix)) {
        alert("EVC number must start with 25261.");
        return;
      }
      message += `Send to EVC-PLUSE Number: +${number}`;
    } else if (from === "E-DAHAB") {
      if (!number.startsWith(edahabPrefix)) {
        alert("E-DAHAB number must start with 25262.");
        return;
      }
      message += `Send to E-DAHAB Number: +${number}`;
    }

    document.getElementById("confirmation").innerText = message;
    alert("Payment Confirmed:\n\n" + message);
  }

  // Initialize on page load
  handleFromChange();
  calculate();



  function confirmPay() {
  const from = document.getElementById("from").value;
  const to = document.getElementById("to").value;
  const amount = parseFloat(document.getElementById("amount").value);
  const network = document.getElementById("network").value;
  const wallet = document.getElementById("wallet").value.trim();
  const number = document.getElementById("number").value.trim();

  if (from === to) {
    alert("From and To must be different.");
    return;
  }

  if (amount <= 0) {
    alert("Enter a valid amount.");
    return;
  }

  let fee = (1.1 / 100) * amount;
  let total = amount - fee;

  let message = `✅ ORDER SUMMARY\n\n`;
  message += `🔁 From: ${from}\n➡️ To: ${to}\n💵 Amount: $${amount.toFixed(2)}\n💸 Fee (1.1%): $${fee.toFixed(2)}\n📥 Total After Fee: $${total.toFixed(2)}\n`;

  if (from === "USDT") {
    if (!network) {
      alert("Please select a USDT network.");
      return;
    }

    let destinationWallet = "";
    if (network === "TRC20") {
      destinationWallet = "TA8dzue5R4oWPiZcPZ25dDsFvk3NBcBryg";
    } else if (network === "BEP20") {
      destinationWallet = "0x7e4c90f63dca2e05f8d619293cb52855ef98fc09";
    } else {
      alert("Invalid network selection.");
      return;
    }

    if (!wallet) {
      alert("Enter your wallet address.");
      return;
    }

    message += `🔗 Send USDT via ${network} to:\n${destinationWallet}\n📤 Your Wallet: ${wallet}`;
  }

  else if (from === "EVC-PLUSE") {
    if (!number.startsWith("25261")) {
      alert("EVC number must start with 25261.");
      return;
    }

    message += `📱 Send to: +252615894200 (EVC-PLUSE)\n📤 Your Number: +${number}`;
  }

  else if (from === "E-DAHAB") {
    if (!number.startsWith("25262")) {
      alert("E-DAHAB number must start with 25262.");
      return;
    }

    message += `📱 Send to: +252625894200 (E-DAHAB)\n📤 Your Number: +${number}`;
  }

  // Show confirmation on screen and alert
  document.getElementById("confirmation").innerText = message.replace(/\n/g, "\n");
  alert(message);
}
function confirmPay() {
  const from = document.getElementById("from").value;
  const to = document.getElementById("to").value;
  const amount = parseFloat(document.getElementById("amount").value);
  const network = document.getElementById("network").value;
  const wallet = document.getElementById("wallet").value.trim();
  const number = document.getElementById("number").value.trim();

  if (from === to) {
    alert("From and To must be different.");
    return;
  }

  if (amount <= 0) {
    alert("Enter a valid amount.");
    return;
  }

  let fee = (1.1 / 100) * amount;
  let total = amount - fee;

  let message = `✅ ORDER SUMMARY\n\n`;
  message += `🔁 From: ${from}\n➡️ To: ${to}\n💵 Amount: $${amount.toFixed(2)}\n💸 Fee (1.1%): $${fee.toFixed(2)}\n📥 Total After Fee: $${total.toFixed(2)}\n`;

  let destination = "";

  if (from === "USDT") {
    if (!network) {
      alert("Please select a USDT network.");
      return;
    }
    if (!wallet) {
      alert("Enter your wallet address.");
      return;
    }

    if (network === "TRC20") {
      destination = "TA8dzue5R4oWPiZcPZ25dDsFvk3NBcBryg";
    } else if (network === "BEP20") {
      destination = "0x7e4c90f63dca2e05f8d619293cb52855ef98fc09";
    }

    message += `🔗 Send to: ${destination}\n📤 Your Wallet: ${wallet}`;
  }

  else if (from === "EVC-PLUSE") {
    if (!number.startsWith("25261")) {
      alert("EVC number must start with 25261.");
      return;
    }
    destination = "+252615894200";
    message += `📱 Send to: ${destination}\n📤 Your Number: +${number}`;
  }

  else if (from === "E-DAHAB") {
    if (!number.startsWith("25262")) {
      alert("E-DAHAB number must start with 25262.");
      return;
    }
    destination = "+252625894200";
    message += `📱 Send to: ${destination}\n📤 Your Number: +${number}`;
  }

  document.getElementById("confirmation").innerText = message;

  alert(message);

  <?php if ($is_admin): ?>
    document.getElementById("admin-form").style.display = "block";
    document.getElementById("admin-destination").value = destination;
  <?php endif; ?>
}
function finalizeTransfer() {
  const newDestination = document.getElementById("admin-destination").value.trim();
  if (!newDestination) {
    alert("Enter the final destination address or number.");
    return;
  }

  alert("✅ Transfer sent to: " + newDestination);
  // Halkan waxaad ku dari kartaa AJAX request ama redirection si lacagta loo diro
}

</script>

</body>
</html>
