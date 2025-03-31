<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>JobFusion</title>
  <link rel="stylesheet" href="../css/page8.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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




  <div class="create-page-form" id="createPageView">
    <div class="profile-section">
      <form id="pageForm">
        <div class="form-details">
          <p>
            <label for="name"><strong>Name:</strong></label>
            <input
              type="text"
              id="name"
              name="name"
              placeholder="Enter your name"
              class="form-input"
              required />
          </p>

          <p>
            <label for="title"><strong>Title:</strong></label>
            <input
              type="text"
              id="title"
              name="title"
              placeholder="Enter your title"
              class="form-input"
              required />
          </p>

          <p>
            <label for="bio"><strong>Bio:</strong></label>
            <textarea
              id="bio"
              name="bio"
              placeholder="Write a short bio about yourself"
              class="form-textarea"
              required></textarea>
          </p>

          <p>
            <label for="skills"><strong>Skills:</strong></label>
            <textarea
              id="skills"
              name="skills"
              placeholder="Enter your skills separated by commas"
              class="form-textarea"
              required></textarea>
          </p>

          <p>
            <label for="email"><strong>Email:</strong></label>
            <input
              type="email"
              id="email"
              name="email"
              placeholder="Enter your email"
              class="form-input"
              required />
          </p>

          <p>
            <label for="phone"><strong>Phone:</strong></label>
            <input
              type="tel"
              id="phone"
              name="phone"
              placeholder="Enter your phone number"
              class="form-input"
              required />
          </p>

          <p>
            <label for="location"><strong>Location:</strong></label>
            <input
              type="text"
              id="location"
              name="location"
              placeholder="Enter your location"
              class="form-input"
              required />
          </p>

          <!-- ولايات الجزائر -->
          <p>
            <label for="state"><strong>State:</strong></label>
            <select id="state" name="state" class="form-input" required>
              <option value="">Select your state</option>
              <option value="01">01 - Adrar</option>
              <option value="02">02 - Chlef</option>
              <option value="03">03 - Laghouat</option>
              <option value="04">04 - Oum El Bouaghi</option>
              <option value="05">05 - Batna</option>
              <option value="06">06 - Béjaïa</option>
              <option value="07">07 - Biskra</option>
              <option value="08">08 - Béchar</option>
              <option value="09">09 - Blida</option>
              <option value="10">10 - Bouira</option>
              <option value="11">11 - Tamanrasset</option>
              <option value="12">12 - Tébessa</option>
              <option value="13">13 - Tlemcen</option>
              <option value="14">14 - Tiaret</option>
              <option value="15">15 - Tizi Ouzou</option>
              <option value="16">16 - Algiers</option>
              <option value="17">17 - Djelfa</option>
              <option value="18">18 - Jijel</option>
              <option value="19">19 - Sétif</option>
              <option value="20">20 - Saïda</option>
              <option value="21">21 - Skikda</option>
              <option value="22">22 - Sidi Bel Abbès</option>
              <option value="23">23 - Annaba</option>
              <option value="24">24 - Guelma</option>
              <option value="25">25 - Constantine</option>
              <option value="26">26 - Médéa</option>
              <option value="27">27 - Mostaganem</option>
              <option value="28">28 - M'Sila</option>
              <option value="29">29 - Mascara</option>
              <option value="30">30 - Ouargla</option>
              <option value="31">31 - Oran</option>
              <option value="32">32 - El Bayadh</option>
              <option value="33">33 - Illizi</option>
              <option value="34">34 - Bordj Bou Arréridj</option>
              <option value="35">35 - Boumerdès</option>
              <option value="36">36 - El Tarf</option>
              <option value="37">37 - Tindouf</option>
              <option value="38">38 - Tissemsilt</option>
              <option value="39">39 - El Oued</option>
              <option value="40">40 - Khenchela</option>
              <option value="41">41 - Souk Ahras</option>
              <option value="42">42 - Tipaza</option>
              <option value="43">43 - Mila</option>
              <option value="44">44 - Aïn Defla</option>
              <option value="45">45 - Naâma</option>
              <option value="46">46 - Aïn Témouchent</option>
              <option value="47">47 - Ghardaïa</option>
              <option value="48">48 - Relizane</option>
              <option value="49">49 - El M'Ghair</option>
              <option value="50">50 - El Menia</option>
              <option value="51">51 - Ouled Djellal</option>
              <option value="52">52 - Bordj Baji Mokhtar</option>
              <option value="53">53 - Béni Abbès</option>
              <option value="54">54 - Timimoun</option>
              <option value="55">55 - Touggourt</option>
              <option value="56">56 - Djanet</option>
              <option value="57">57 - In Salah</option>
              <option value="58">58 - In Guezzam</option>
            </select>
          </p>

          <p>
            <label for="image"><strong>Profile Image:</strong></label>
            <input
              type="file"
              id="image"
              name="image"
              class="form-file"
              accept="image/*"
              onchange="previewProfileImage(event)"
              required />
          </p>

          <!-- صورة بطاقة الهوية -->
          <p>
            <label for="id-card"><strong>ID Card Image:</strong></label>
            <input
              type="file"
              id="id-card"
              name="id-card"
              class="form-file"
              accept="image/*"
              required />
          </p>

          <p>
            <label for="files"><strong>Upload Additional Files (e.g., CV, Portfolio):</strong></label>
            <input
              type="file"
              id="files"
              name="files"
              multiple
              class="form-file"
              accept=".pdf,.doc,.docx,.jpg,.png" />
          </p>

          <p>
            <label for="Certificate"><strong>Certificate:</strong></label>
            <input
              type="file"
              id="Certificate"
              name="Certificate"
              multiple
              class="form-file"
              accept=".pdf,.doc,.docx,.jpg,.png" />
          </p>

          <div class="form-buttons">
            <button
              type="submit"
              class="form-submit-btn"
              onclick="redirectToCreatePage()">
              <i class="fas fa-check"></i> Submit
            </button>

            <button
              type="button"
              class="form-cancel-btn"
              onclick="redirectToCreatePage()">
              <i class="fas fa-arrow-left"></i> Cancel
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>


  <div class="contact" id="contact">
    <div class="container2">
      <h2 class="special-heading">Contact</h2>
      <p>We are born to create</p>
      <div class="info">
        <p class="label">Feel free to drop us a line at:</p>
        <a href="mailto:leonagency@mail.com?subject=Contact" class="link">Palestine-Group@gmail.com</a>
        <div class="social">
          <div class="icon-social">
            <a href=""><i
                class="fa-brands fa-facebook fa-2x"
                style="color: #0e4c7b"></i></a>
            <a href=""><i
                class="fa-brands fa-instagram fa-2x"
                style="color: #c4173a"></i></a>
            <a href=""><i
                class="fa-brands fa-telegram fa-2x"
                style="color: #74c0fc"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="footer">
    <a href="./home0.php"><img class="footer-logo" src="../imge/logo.jpg" alt="" /></a>
    <p>2024 - <span>Group of Programmers</span> - All Rights Reserved</p>
  </div>

  <script src="../Js/page8.js"></script>
</body>

</html>