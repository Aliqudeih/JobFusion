<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/services.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>JobFusion</title>

</head>

<body>

  <div class="header">
    <div class="container" id="container">
      <a href="./home0.php"><img class="logo" src="../imge/logo.jpg" alt="" /> </a>
      <a class="logotext" href="./home0.php">
        <h1 class="logotext">JobFusion</h1>
      </a>

      <form class="form-serch" action="./page4.php" method="GET">
        <input type="text" placeholder="  Serch anything you want">
        <button class="serch-button"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>



      <button class="back">Back</button>

      <div class="dropdown">
        <img src="../imge/User.jpg" alt="Profile Picture" />
        <div class="dropdown-content">
          <p style="padding: 10px; font-weight: bold">Mahmoud Kaabar</p>
          <p style="padding: 10px; color: gray">@mahmoudkaabar</p>
          <a href="#">🔔 Notifications <span style="color: blue">1</span></a>
          <a href="#">👤 View Profile</a>
          <a href="#" style="color: red">🚪 Log Out</a>
        </div>
      </div>


      <script>
        document.querySelector(".back").addEventListener("click", () => {
          window.history.back();
        });
      </script>






    </div>
  </div>


  <div class="ser">
    <img class="service-image" src="" alt="Service Image">
    <div class="ser-content">
      <h3 class="name">Our Premium Services</h3>
      <p class="dis">We provide a wide range of top-notch services tailored to meet your specific needs. Explore the possibilities with our expert team.</p>
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
    <p>2025 - <span>Group of Programmers</span> - All Rights Reserved</p>
  </div>
</body>
<script src="../Js/services.js"></script>

</html>