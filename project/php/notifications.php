<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JobFusion</title>
  <link rel="shortcut icon" href="../imge/logo.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="../css/notifications.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
  <div class="header">
    <div class="container" id="container">
      <a href="./home0.php"><img class="logo" src="/imge/logo.jpg" alt="" /> </a>
      <a class="logotext" href="./home0.php">
        <h1 class="logotext">JobFusion</h1>
      </a>

      <form class="form-serch" action="./page4.php" method="GET">
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

  <div class="notifications">
    <div class="container">
      <h2 class="special-heading">Your Notifications</h2>
      <ul class="notification-list">
        <li>
          <i class="fa-solid fa-bell"></i>
          <span>You have a new message from John Doe.</span>
          <span class="time">2 hours ago</span>
        </li>
        <li>
          <i class="fa-solid fa-bell"></i>
          <span>Your service request has been approved!</span>
          <span class="time">5 hours ago</span>
        </li>
        <li>
          <i class="fa-solid fa-bell"></i>
          <span>A new user followed your profile.</span>
          <span class="time">1 day ago</span>
        </li>
        <li>
          <i class="fa-solid fa-bell"></i>
          <span>Your subscription will expire soon. Renew now!</span>
          <span class="time">3 days ago</span>
        </li>
      </ul>
    </div>
  </div>

  <div class="contact" id="contact">
    <div class="container">
      <h2 class="special-heading">Contact</h2>
      <p>We are born to create</p>
      <div class="info">
        <p class="label">Feel free to drop us a line at:</p>
        <a href="mailto:leonagency@mail.com?subject=Contact" class="link">Palestine-Group@gmail.com</a>
        <div class="social">

          <div class="icon-social">
            <a href=""><i class="fa-brands fa-facebook fa-2x" style="color: #0e4c7b;"></i></a>
            <a href=""><i class="fa-brands fa-instagram fa-2x" style="color: #c4173a;"></i></a>
            <a href=""><i class="fa-brands fa-telegram fa-2x" style="color: #74C0FC;"></i></a>


          </div>


        </div>
      </div>
    </div>
  </div>

  <div class="footer">
    <a href="./home0.php"><img class="footer-logo" src="../imge/logo.jpg" alt=""></a>
    <p>2024 - <span>Group of Programmers</span> - All Rights Reserved</p>
  </div>
</body>

</html>