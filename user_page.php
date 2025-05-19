<?php
session_start();

if (!isset($_SESSION['email'])) {

header("Location: index.php");
exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Page</title>
    <link rel="stylesheet" href="style.css">
<style>

</style>
</head>

<body>
    <div class="box">
        <h1>Welcome, <span><?= $_SESSION['name'];?></span></h1>
        <p>This is an <span>user</span>page</p>
       
    </div>
 
</body>
<main>
    <nav class="navbar">
    <div class="hamburger" onclick="toggleMenu()">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
    <ul class="menu" id="menu">
      <li><a href="transfer.php">TEANSFER</a></li>
      <li><a href="course.php">COURSES-BUY</a></li>
       <li><a href="Ads.php">ADS</a></li>
         <li><a href="aboute.php">ABOUTE-US</a></li>
      <li> <button onclick="window.location.href='logout.php'">Logout</button>
    </ul>
  </nav>

  
  <script>
    function toggleMenu() {
      const menu = document.getElementById('menu');
      menu.classList.toggle('show');
    }
  </script>
</main>
</html>