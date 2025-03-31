<?php
session_start();
require "db.php";

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user page data
$stmt = $conn->prepare("SELECT page_id, name, title, profession, bio, skills, email, phone, location, state, page_image FROM user_pages WHERE user_id = ?");
$stmt->execute([$user_id]);
$user_page = $stmt->fetch(PDO::FETCH_ASSOC);

// Store page_id in session if needed
if ($user_page) {
  $_SESSION['page_id'] = $user_page['page_id'];
}

$page_id = $_SESSION['page_id'] ?? null; // Use null if not set


// Convert skills text to an array
$skills = explode(',', $user_page['skills']);


// Fetch work experience
$jobs_stmt = $conn->prepare("SELECT job_title, company_name, start_date, end_date FROM jobs WHERE user_id = ?");
$jobs_stmt->execute([$user_id]);
$jobs = $jobs_stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch average rating
$rating_stmt = $conn->prepare("SELECT AVG(rating_value) AS avg_rating FROM ratings WHERE rated_user_id = ?");
$rating_stmt->execute([$user_id]);
$rating = $rating_stmt->fetch(PDO::FETCH_ASSOC)['avg_rating'] ?? 0;
// Fetch user skills from the database
$skill_query = "SELECT skill FROM skills WHERE user_id = ?";
$skill_stmt = $conn->prepare($skill_query);
$skill_stmt->execute([$user_id]);
$skills = $skill_stmt->fetchAll(PDO::FETCH_COLUMN);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>JobFusion</title>
  <link rel="shortcut icon" href="../imge/logo.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="../css/page3.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
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
          exit();
        <?php endif; ?>
      </div>



      <script>
        document.querySelector(".back").addEventListener("click", () => {
          window.history.back();
        });
      </script>






    </div>
  </div>


  <div class="profile-detail-container">
    <main class="profile-container">
      <div class="profile-card">
        <div class="profile-header">
          <img class="profile-img" src="get_user_page_image.php?page_id=<?php echo $page_id; ?>" alt="Profile Picture" />

          <div class="profile-info">
            <h1 class="profile-title"><?php echo htmlspecialchars($user_page['title']); ?></h1>
            <p class="profile-name"><?php echo htmlspecialchars($user_page['name']); ?></p>

            <div class="rating-stars">
              <?php for ($i = 1; $i <= 5; $i++): ?>
                <i class="fas fa-star <?php echo ($i <= $rating) ? '' : 'far'; ?>"></i>
              <?php endfor; ?>
              <span class="rating-text">(<?php echo number_format($rating, 1); ?>)</span>
            </div>
          </div>
        </div>

        <div class="profile-content">
          <section class="about-section">
            <h2>About the <?php echo htmlspecialchars($user_page['profession']); ?></h2>
            <h5 class="bio-text"><?php echo htmlspecialchars($user_page['bio']); ?></h5>
          </section>

          <div class="details-grid">
            <section class="skills-section">
              <h3><i class="fas fa-code"></i> Technical Skills</h3>
              <div class="skills-tags">
                <?php if (!empty($skills)): ?>
                  <?php foreach ($skills as $skill): ?>
                    <span><?= htmlspecialchars(trim($skill)) ?></span>
                  <?php endforeach; ?>
                <?php else: ?>
                  <p>No skills added yet.</p>
                <?php endif; ?>
              </div>
            </section>

            <section class="contact-section">
              <h3 style="color: #10cab7;"><i class="fas fa-envelope"></i> Contact Information</h3>
              <div class="contact-info">
                <p><i class="fas fa-phone"></i> <?php echo htmlspecialchars($user_page['phone']); ?></p>
                <p style="color: blue;"><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($user_page['email']); ?></p>
              </div>
            </section>
          </div>
        </div>
    </main>
  </div>


  <div class="chat-icon" id="chatIcon">
    <i class="fas fa-comment-dots"></i>
  </div>

  <!-- Chat Box -->
  <div class="chat-box" id="chatBox">
    <div class="chat-header">
      <h4>Chat with Ali</h4>
      <button class="close-btn" id="closeChat">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="chat-body" id="chatBody">
      <!-- Messages will appear here -->
    </div>
    <div class="chat-footer">
      <input
        type="text"
        id="chatInput"
        placeholder="Type a message..."
        onkeypress="handleChatInput(event)" />
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
    <a href="./home0.php"><img class="footer-logo" src="../imge/logo.jpg" alt="" /></a>
    2024 -<span>Group of Programmers</span>- All Right Reserved by
  </div>

  <script>
    const chatIcon = document.getElementById("chatIcon");
    const chatBox = document.getElementById("chatBox");
    const chatBody = document.getElementById("chatBody");
    const chatInput = document.getElementById("chatInput");
    const closeChat = document.getElementById("closeChat");

    chatIcon.addEventListener("click", () => {
      chatBox.classList.toggle("active");
    });

    closeChat.addEventListener("click", () => {
      chatBox.classList.remove("active");
    });

    function handleChatInput(event) {
      if (event.key === "Enter" && chatInput.value.trim() !== "") {
        const message = document.createElement("p");
        message.textContent = chatInput.value;
        chatBody.appendChild(message);
        chatInput.value = "";
        chatBody.scrollTop = chatBody.scrollHeight;
      }
    }
  </script>




</body>

</html>