<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Saska Exchange Courses</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f4f4f4;
    }

    header {
      background-color: black;
      color: white;
      padding: 20px;
      text-align: center;
      font-size: 24px;
      font-weight: bold;
    }

    .container {
      padding: 20px;
      max-width: 600px;
      margin: auto;
    }

    .course {
      background: white;
      padding: 20px;
      border-radius: 12px;
      margin-bottom: 20px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .course h3 {
      margin-top: 0;
    }

    .btn {
      display: inline-block;
      margin-top: 15px;
      padding: 10px 18px;
      background: #007bff;
      color: white;
      text-decoration: none;
      border-radius: 6px;
    }

    .btn:hover {
      background: #0056b3;
    }

    .buy-info {
      margin-top: 15px;
      background: #e7f3ff;
      padding: 15px;
      border-radius: 8px;
      display: none;
    }

    .download {
      margin-top: 10px;
      display: inline-block;
      padding: 8px 14px;
      background: #28a745;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }

    .download:hover {
      background: #1e7e34;
    }

    .back-top {
      text-align: center;
      margin-top: 30px;
    }

    .back-btn {
      background: #dc3545;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 8px;
    }

    footer {
      background: white;
      padding: 25px 15px;
      text-align: center;
      border-top: 1px solid #ddd;
      margin-top: 40px;
    }

    footer p {
      margin: 5px 0;
    }

    footer .socials a {
      margin: 0 8px;
      text-decoration: none;
      font-size: 22px;
      color: #333;
    }
  </style>
</head>
<body>

<header>
  Saaska Exchange Courses
</header>

<div class="container">
  <div class="course">
    <h3>Cryptocurrency Course</h3>
    <p>Learn everything about crypto trading, wallets, and blockchain.</p>
    <a href="#" class="btn" onclick="showBuy('buy1')">Buy Now</a>
    <div id="buy1" class="buy-info">
      <p><strong>Pay via:</strong> EVC/e-Dahab +252615894200/+252625894200</p>
      <a href="crypto-course.pdf" class="download" download>Download Crypto Course</a>
    </div>
  </div>

  <div class="course">
    <h3>Forex Trading Course</h3>
    <p>Master forex basics, analysis, and trading strategies.</p>
    <a href="#" class="btn" onclick="showBuy('buy2')">Buy Now</a>
    <div id="buy2" class="buy-info">
      <p><strong>Pay via:</strong> EVC/e-Dahab +252615894200/+252625894200</p>
      <a href="forex-course.pdf" class="download" download>Download Forex Course</a>
    </div>
  </div>

  <div class="course">
    <h3>MetaTrader 5 Course</h3>
    <p>Trade with MetaTrader 5 - charts, indicators, and orders.</p>
    <a href="#" class="btn" onclick="showBuy('buy3')">Buy Now</a>
    <div id="buy3" class="buy-info">
      <p><strong>Pay via:</strong>EVC/e-Dahab +252615894200/+252625894200</p>
      <a href="https://wa.me/+252615894200">cilick MT5 Course</a>
    </div>
  </div>

  <div class="back-top">
    <a href="user_page.php" class="back-btn">Back</a>
  </div>
</div>

<footer>
  <p>&copy; 2025 Saska Exchange. All rights reserved.</p>
  <p>Terms | Privacy</p>
  <div class="socials">
    <a href="https://facebook.com"><img src="facebook.png" alt="Facebook" width="24"></a>
    <a href="https://twitter.com"><img src="x.png" alt="Twitter" width="24"></a>
    <a href="https://tiktok.com"><img src="tiktok.png" alt="TikTok" width="24"></a>
  </div>
</footer>

<script>
  function showBuy(id) {
    const allBoxes = document.querySelectorAll('.buy-info');
    allBoxes.forEach(box => box.style.display = 'none');
    document.getElementById(id).style.display = 'block';
  }
</script>

</body>
</html>