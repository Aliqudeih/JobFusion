<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Professional Dashboard</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <link rel="stylesheet" href="../css/page9.css" />
</head>

<body>
  <!-- Header -->
  <div class="header">
    <div class="container" id="container">
      <a href="./home0.php"><img class="logo" src="../imge/logo.jpg" alt="" />
      </a>
      <a class="logotext" href="./home0.php">
        <h1 class="logotext">JobFusion</h1>
      </a>

      <form class="form-serch" action="./page4.php" method="GET">
        <input type="text" placeholder="  Serch anything you want" />
        <button class="serch-button">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
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

  <!-- Dashboard -->
  <div class="dashboard">
    <!-- Profile Section -->
    <div class="profile-section">
      <!-- Edit and Save Buttons -->
      <!-- في قسم الأزرار -->
      <div class="button-container">
        <button class="edit-btn" onclick="toggleEditMode()">
          <i class="fas fa-edit"></i> Edit Profile
        </button>
        <button class="save-btn" onclick="saveChanges()">
          <i class="fas fa-save"></i> Save Changes
        </button>
        <button class="cancel-btn" onclick="cancelEditing()">
          <i class="fas fa-times"></i> Cancel
        </button>
      </div>
      <!-- Avatar Section -->
      <div class="avatar-container">
        <?php
        if (isset($_SESSION['user_id'])): ?>
          <img src="get_image.php" class="avatar" id="avatarPreview" />

          <div
            class="avatar-upload"
            onclick="document.getElementById('avatarUpload').click()">
            <i class="fas fa-camera"></i>
          </div>
          <input type="file" id="avatarUpload" hidden accept="image/*" />
      </div>

      <!-- Name and Title -->
      <h1 contenteditable="false" class="editable-field" id="name"><?php echo $_SESSION['username']; ?></h1>
      <h3 contenteditable="false" class="editable-field" id="title"> <?php echo $_SESSION["bio"] ?> </h3>

    <?php else: ?>
      exit;
    <?php endif; ?>



    <!-- Rating Section -->
    <div class="rating-section">
      <div class="rating-stars">
        <i class="fas fa-star" data-value="1"></i>
        <i class="fas fa-star" data-value="2"></i>
        <i class="fas fa-star" data-value="3"></i>
        <i class="fas fa-star" data-value="4"></i>
        <i class="fas fa-star" data-value="5"></i>
        <span class="rating-text">(4.9)</span>
      </div>
    </div>

    <!-- Skills Section -->
    <div class="skills-section">
      <h2><i class="fas fa-code"></i> Skills</h2>
      <div class="skills" id="skillsContainer">
        <span class="tag">HTML5</span>
        <span class="tag">CSS3</span>
        <span class="tag">JavaScript</span>
        <span class="tag">React</span>
      </div>
    </div>

    <!-- About Section -->
    <div class="about-section">
      <h2><i class="fas fa-user"></i> About</h2>
      <p contenteditable="false" class="editable-field" id="about">
        A professional web developer with over 5 years of experience in
        developing technical solutions...
      </p>
    </div>

    <!-- Experience Section -->
    <div class="experience-section">
      <h2><i class="fas fa-briefcase"></i> Experience</h2>
      <div class="experience-item">
        <h3 contenteditable="false" class="editable-field">
          Lead Developer - Taqamul Company
        </h3>
        <p contenteditable="false" class="editable-field">2020 - Present</p>
        <p contenteditable="false" class="editable-field">
          Leading a team of developers to build scalable web applications.
        </p>
      </div>
      <div class="experience-item">
        <h3 contenteditable="false" class="editable-field">
          Web Developer - Solutions Company
        </h3>
        <p contenteditable="false" class="editable-field">2018 - 2020</p>
        <p contenteditable="false" class="editable-field">
          Developed and maintained client websites, ensuring high
          performance and responsiveness.
        </p>
      </div>
    </div>

    <!-- Contact Information -->
    <div class="contact-info">
      <p class="loemail">
        <i class="fas fa-envelope"></i>
        <span id="email">ali@example.com</span>
      </p>
      <p class="lophon">
        <i class="fas fa-phone"></i>
        <span id="phone">+213 123 456 789</span>
      </p>

    </div>
    </div>

    <!-- Messaging Section -->
    <div class="messaging-section">
      <h2><i class="fas fa-comments"></i> Client Messages</h2>
      <div class="client-list" id="clientList">
        <div class="client-item" onclick="openChat('Sarah')">Sarah</div>
        <div class="client-item" onclick="openChat('Mike')">Mike</div>
      </div>

      <div class="chat-window" id="chatWindow">
        <div class="chat-messages" id="chatMessages">
          <!-- Messages will appear here -->
        </div>
        <input
          type="text"
          class="message-input"
          id="messageInput"
          placeholder="Type your message..." />
      </div>
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

  <!-- Footer -->
  <div class="footer">
    <a href="./home0.php"><img class="footer-logo" src="../imge/logo.jpg" alt="" /></a>
    2024 - <span>Group of Programmers</span> - All Right Reserved by
  </div>

  <script>
    // تعديل الدوال في الـ JavaScript
    let isEditMode = false;
    const originalValues = {};

    function toggleEditMode() {
      isEditMode = !isEditMode;
      const fields = document.querySelectorAll(".editable-field");

      document.querySelector(".edit-btn").style.display = isEditMode ?
        "none" :
        "block";
      document.querySelector(".save-btn").style.display = isEditMode ?
        "block" :
        "none";
      document.querySelector(".cancel-btn").style.display = isEditMode ?
        "block" :
        "none";

      fields.forEach((field) => {
        field.contentEditable = isEditMode;
        field.classList.toggle("edit-mode", isEditMode);

        if (isEditMode) {
          originalValues[field.id] = field.innerText;
        }
      });
    }

    function saveChanges() {
      alert("Changes saved successfully!");
      toggleEditMode();
    }

    function cancelEditing() {
      const fields = document.querySelectorAll(".editable-field");
      fields.forEach((field) => {
        field.innerText = originalValues[field.id];
      });
      toggleEditMode();
    }

    // بقية الكود كما هو...

    // Avatar Upload
    document
      .getElementById("avatarUpload")
      .addEventListener("change", function(e) {
        const reader = new FileReader();
        const preview = document.getElementById("avatarPreview");
        reader.onload = function() {
          preview.src = reader.result;
        };
        reader.readAsDataURL(e.target.files[0]);
      });

    // Messaging System
    let currentChat = null;

    function openChat(clientName) {
      currentChat = clientName;
      document.getElementById("chatWindow").style.display = "block";
      document.getElementById("chatMessages").innerHTML = `
                <div class="message">Hello, how can I help you?</div>
            `;
    }

    document
      .getElementById("messageInput")
      .addEventListener("keypress", function(e) {
        if (e.key === "Enter" && currentChat) {
          const message = this.value;
          if (message) {
            const chatMessages = document.getElementById("chatMessages");
            chatMessages.innerHTML += `
                        <div class="message">You: ${message}</div>
                    `;
            this.value = "";
            chatMessages.scrollTop = chatMessages.scrollHeight;
          }
        }
      });
  </script>
</body>

</html>