<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JobFusion</title>
  <link rel="stylesheet" href="../css/contact.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>


  <div class="header">
    <div class="container" id="container">
      <a href="#contanier"><img class="logo" src="../imge/logo.jpg" alt="" /> </a>
      <a class="logotext" href="/php/home0.php">
        <h1 class="logotext">JobFusion</h1>
      </a>

      <form class="form-serch" action="/php/page4.php" method="GET">
        <input type="text" placeholder="  Serch anything you want">
        <button class="serch-button"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>



      <button class="back">Back</button>
      <div class="navbar">
        <!-- Display Login or User Dropdown -->
        <?php

        session_start();

        if (isset($_SESSION['user_id'])): ?>
          <!-- User Dropdown if logged in -->

          <div class="dropdown" id="user-dropdown">
            <img src="get_image.php" alt="Profile Picture" />
            <div class="dropdown-content">
              <p style="padding: 10px; font-weight: bold"><?php echo $_SESSION['username']; ?></p>
              <p style="padding: 10px; color: gray">@<?php echo strtolower($_SESSION['email']); ?></p>
              <a href="notifications.php">🔔 Notifications <span style="color: blue">1</span></a>
              <a href="javascript:void(0);" onclick="openSettings()">👤 View Profile</a>
              <a href="logout.php" style="color: red">🚪 Log Out</a>

            </div>
          </div>
        <?php else: ?>
          exit;
        <?php endif; ?>
      </div>



      <script>
        document.querySelector(".back").addEventListener("click", () => {
          window.history.back();
        });
      </script>






    </div>
  </div>







  <div class="contact">
    <div class="container">
      <h2 class="special-heading">Get in Touch</h2>
      <form class="contact-form" action="/submit_contact" method="post">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Your Name" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Your Email" required>

        <label for="message">Message</label>
        <textarea id="message" name="message" rows="6" placeholder="Your Message Or problem" required></textarea>

        <button type="submit" class="btn">Send Message</button>
      </form>

      <div class="social">
        <h3>Follow Us</h3>
        <div class="icon-social">
          <a href="#"><i class="fa-brands fa-facebook fa-2x" style="color: #0e4c7b;"></i></a>
          <a href="#"><i class="fa-brands fa-instagram fa-2x" style="color: #c4173a;"></i></a>
          <a href="#"><i class="fa-brands fa-telegram fa-2x" style="color: #74C0FC;"></i></a>
        </div>
      </div>
    </div>
  </div>

  <div class="footer">
    <a href="/php/home0.php"><img class="footer-logo" src="../imge/logo.jpg" alt=""></a>
    <p>2025 - <span>Group of Programmers</span> - All Rights Reserved</p>
  </div>
</body>


</html>