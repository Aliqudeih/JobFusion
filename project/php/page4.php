<?php
session_start();

include("databasecont.php");
// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
  $username = trim($_POST["username"]);
  $password = trim($_POST["password"]);

  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");

  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
    if (password_verify($password, $row["password"])) {
      $_SESSION["user_id"] = $row["user_id"];
      $_SESSION["username"] = $row["username"];
      $_SESSION["email"] = $row["email"];
      $_SESSION["bio"] = $row["bio"];


      $_SESSION['notification'] = "Login successful!";
      $_SESSION['notification_type'] = "success";
      header("Location: page4.php");
      exit();
    } else {
      $_SESSION['notification'] = "Invalid password.";
      $_SESSION['notification_type'] = "error";
    }
  } else {
    $_SESSION['notification'] = "No user found with that username.";
    $_SESSION['notification_type'] = "error";
  }
  header("Location: page4.php");
  exit();
}

// Handle registration
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create-account"])) {
  $username = trim($_POST["create-username"]);
  $email = trim($_POST["create-email"]);
  $password = trim($_POST["create-password"]);
  $confirm_password = trim($_POST["create-confirm-password"]);

  if ($password !== $confirm_password) {
    $_SESSION['notification'] = "Passwords do not match.";
    $_SESSION['notification_type'] = "error";
    header("Location: page4.php");
    exit();
  }

  // Check if email exists
  $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ? OR username = ?");
  $stmt->bind_param("ss", $email, $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $_SESSION['notification'] = "Username or Email already exists!";
    $_SESSION['notification_type'] = "error";
    header("Location: page4.php");
    exit();
  }

  // Insert new user
  $password_hash = password_hash($password, PASSWORD_BCRYPT);
  $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $username, $email, $password_hash);

  if ($stmt->execute()) {
    $_SESSION['notification'] = "Registration successful! Please log in.";
    $_SESSION['notification_type'] = "success";
  } else {
    $_SESSION['notification'] = "Error: " . $conn->error;
    $_SESSION['notification_type'] = "error";
  }

  header("Location: page4.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>JobFusion</title>
  <link rel="shortcut icon" href="../imge/logo.jpg" type="image/x-icon" />

  <link rel="stylesheet" href="../css/page4.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
  <div class="header">
    <div class="container" id="container">
      <a href="./home0.php"><img class="logo" src="../imge/logo.jpg" alt="" />
      </a>
      <a class="logotext" href="./home0.php">
        <h1 class="logotext">JobFusion</h1>
      </a>

      <form class="form-serch" action="./page4.php" method="POST" onsubmit="return validateSearch()">
                <input type="text" name="query" id="search-input" placeholder="Search anything you want"/>
                <span id="error-message" style="color: red; font-size: 12px; position: absolute; bottom: -18px; left: 0;"></span>
                <button type="submit" name="serch-button" class="serch-button">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>

            <script>
                function validateSearch() {
                    let input = document.getElementById("search-input").value.trim();
                    let errorMsg = document.getElementById("error-message");

                    if (input === "") {
                        errorMsg.textContent = "Please enter a search term.";
                        return false; // منع إرسال النموذج إذا كان فارغًا
                    } else {
                        errorMsg.textContent = "";
                        return true; // السماح بالإرسال
                    }
                }
                
          $(document).ready(function () {
            $("#search-input").on("keyup", function () {
                let query = $(this).val().trim();

                console.log("Query being sent:", query); // عرض القيم المرسلة في Console

                if (query.length > 0) {
                    $.ajax({
                        type: "POST", // طلب POST
                        url: "search.php", // التأكد أن اسم الملف صحيح
                        data: { query: query },
                        success: function (data) {
                            console.log("Response from server:", data); // التحقق من الرد
                            $(".card-container").html(data);
                        },
                        error: function (xhr, status, error) {
                            console.error("AJAX Error:", error);
                        }
                    });
                } else {
                    $(".card-container").html("");
                }
            });
        });


            </script>

      




      <?php if (isset($_SESSION['notification'])): ?>
        <script>
          document.addEventListener("DOMContentLoaded", function() {
            showNotification("<?php echo $_SESSION['notification']; ?>", "<?php echo $_SESSION['notification_type']; ?>");
          });
        </script>
        <?php unset($_SESSION['notification']); ?>
        <?php unset($_SESSION['notification_type']); ?>
      <?php endif; ?>

      <div class="navbar">
        <!-- Display Login or User Dropdown -->
        <?php if (isset($_SESSION['user_id'])): ?>
          <!-- User Dropdown if logged in -->
          <div class="dropdown" id="user-dropdown">
            <img src="get_image.php" alt="Profile Picture" />
            <div class="dropdown-content">
              <p style="padding: 10px; font-weight: bold"><?php echo $_SESSION['username']; ?></p>
              <p style="padding: 10px; color: gray">@<?php echo strtolower($_SESSION['email']); ?></p>
              <a href="notifications.php">🔔 Notifications <span style="color: blue">1</span></a>
              <a href="javascript:void(0);" onclick="openSettings()">👤 View Profile</a>
              <a href="logout1.php" style="color: red">🚪 Log Out</a>

            </div>
          </div>
        <?php else: ?>
          <div class="login">
            <button id="login-button" style="width: 100px;">
              <i class="fas fa-sign-in-alt"></i> Login
            </button>
          </div>
        <?php endif; ?>
      </div>

    </div>

  </div>


  <!-- Login Form -->
  <div class="popup-overlay" id="popup-overlay">
    <div class="popup">
      <button class="close-btn" id="close-popup">&times;</button>
      <h1>Login</h1>
      <form id="login-form" action="" method="POST">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required />

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required />

        <button class="login-btn" type="submit" name="login">Login</button>
      </form>
      <a href="#" id="forgot-password">Forgot Password?</a>
      <a href="#" id="create-account" class="create-account">Create an Account</a>

      <button id="google-login" class="google-login-btn">
        Login with Google
      </button>
    </div>
  </div>



  <!-- Registration Form -->
  <div class="create" id="create-account-overlay" style="display: none">


    <div class="popup">
      <button class="close-btn" id="close-create-popup">&times;</button>
      <h1>Create an Account</h1>

      <form id="create-account-form" action="" method="POST">
        <label for="create-username">Username</label>
        <input type="text" id="create-username" name="create-username" placeholder="Choose a username" required />

        <label for="create-email">Email Address</label>
        <input type="email" id="create-email" name="create-email" placeholder="Enter your email" required />

        <label for="create-password">Password</label>
        <input type="password" id="create-password" name="create-password" placeholder="Create a password" required />

        <label for="create-confirm-password">Confirm Password</label>
        <input type="password" id="create-confirm-password" name="create-confirm-password" placeholder="Confirm your password" required />

        <button class="login-btn" type="submit" name="create-account">Create Account</button>
      </form>

      <a href="#" id="back-to-login-from-create" class="create-account">Back to Login</a>
    </div>
  </div>

  </div>

  <script src="https://accounts.google.com/gsi/client" async defer></script>

  <div class="landing">
    <div class="sidebar">
      <div class="info-cus">
        <img src="get_image.php" alt="../imge/profile1.jpg" />

      </div>

      <div>
        <div class="list-pro">
          <ul>
            <li>
              <a href="./home0.php" title="Home"> <i class="fa-solid fa-house fa-2x"></i> </a>
            </li>

            <li>
              <i class="fa-solid fa-bell fa-shake fa-2x" title="Notifications" onclick="showNotifications()"> <span class="Nn">1</span> </i>
            </li>

            <li> <i class="fa-solid fa-phone fa-shake fa-2x" title="Contact Us" onclick="openContactForm()"></i>
            </li>

            <li>
              <i
                class="fa-solid fa-gear fa-spin fa-spin-reverse fa-2x"
                title="Settings"
                onclick="openSettings()"></i>
            </li>

            <li>
              <i
                class="fa-solid fa-right-from-bracket fa-2x"
                title="Logout"
                onclick="logoutUser()"></i>
            </li>

            <li>
              <a href="./home0.php" title="Home">
                <img src="../imge/logo.jpg" alt="Logo" />
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        const sidebar = document.querySelector(".sidebar");
        const sidebarItems = sidebar.querySelectorAll("li, i, a"); // Select sidebar items

        let isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;

        // If the user is not logged in, disable interaction and show a login prompt
        if (!isLoggedIn) {
          // Prevent interaction with sidebar items
          sidebarItems.forEach(function(item) {
            item.style.pointerEvents = "none"; // Disable clicks
            item.style.opacity = "0.5"; // Dim the items
          });


        }

        // Handle interaction if logged in
        if (isLoggedIn) {
          sidebar.addEventListener("click", function(event) {
            const target = event.target;

            if (target.closest("i")) {
              // Add your specific action here for the icons
              if (target.closest("i").classList.contains("fa-bell")) {
                showNotifications();
              } else if (target.closest("i").classList.contains("fa-phone")) {
                openContactForm();
              } else if (target.closest("i").classList.contains("fa-gear")) {
                openSettings();
              } else if (target.closest("i").classList.contains("fa-right-from-bracket")) {
                logoutUser();
              }
            }
          });
        }
      });
    </script>

    <div class="settings-view" id="settingsView" style="display: none">
      <h1 class="settings-heading">Settings</h1>

      <!-- قسم المعلومات الشخصية -->
      <div class="profile-info">
        <div class="info-header">
          <div style="position: relative; display: inline-block">
            <h2>Profile</h2>
            <img
              src="../imge/User.jpg"
              class="settings-profile-img"
              id="profilePicture" />
            <button
              onclick="changeProfilePicture()"
              class="change-picture-btn">
              <i class="fas fa-camera"></i>
            </button>
          </div>
        </div>

        <div class="info-details">
          <p>
            <strong>Name:</strong>
            <span id="settingsName">John Doe</span>
            <input
              type="text"
              id="editName"
              class="edit-input"
              style="display: none" />
          </p>
          <p>
            <strong>Email:</strong>
            <span id="settingsEmail">john@example.com</span>
            <!-- جعل الإيميل غير قابل للتعديل -->
            <input
              type="email"
              id="editEmail"
              class="edit-input"
              style="display: none"
              disabled />
          </p>
          <p>
            <strong>Phone:</strong>
            <span id="settingsPhone">+1234567890</span>
            <input
              type="tel"
              id="editPhone"
              class="edit-input"
              style="display: none" />
          </p>




          <div class="password-container">
            <strong>Password:</strong>
            <div class="change-password" onclick="showChangePasswordOverlay()">
              Change <i class="fas fa-edit"></i>
            </div>
          </div>

          <!-- نموذج تغيير كلمة المرور كـ overlay -->
          <div id="changePasswordOverlay">
            <div class="overlay-content">
              <h3>Change Password</h3>

              <button class="close" onclick="hideChangePasswordOverlay()">&times;</button>
              <form onsubmit="saveNewPassword(event)">

                <input type="password" id="oldPassword" placeholder="Old Password" required />
                <input type="password" id="newPassword" placeholder="New Password" required />
                <input type="password" id="confirmNewPassword" placeholder="Confirm New Password" required />
                <button type="submit">Save</button>
                <button type="button" onclick="hideChangePasswordOverlay()">Cancel</button>
              </form>
            </div>
          </div>

          <button id="editInfoBtn" onclick="toggleEditMode()">
            Edit Information
          </button>
          <button id="saveInfoBtn" onclick="saveInfo()" style="display: none">
            Save
          </button>
        </div>
      </div>

      <!-- قسم صفحات المستخدم -->
      <div class="user-pages">
        <h2>My Pages</h2>

        <div id="pagesList">
          <div class="page-item">
            <img class="Img" src="../imge/User.jpg" alt="Page 1" />
            <span>My Business Page</span>
            <div class="buttonsED">
              <button class="E" onclick="editPage('page1')">Show</button>
              <button class="D" onclick="deletePage('page1')">Delete</button>
            </div>
          </div>

          <div class="page-item">
            <img class="Img" src="../imge/User.jpg" alt="Page 1" />
            <span>My Business Page</span>
            <div class="buttonsED">
              <button class="E" onclick="editPage('page1')">Show</button>
              <button class="D" onclick="deletePage('page1')">Delete</button>
            </div>
          </div>

          <div class="page-item">
            <img class="Img" src="../imge/User.jpg" alt="Page 1" />
            <span>My Business Page</span>
            <div class="buttonsED">
              <button class="E" onclick="editPage('page1')">Show</button>
              <button class="D" onclick="deletePage('page1')">Delete</button>
            </div>
          </div>
        </div>

        <button class="back-btn" onclick="closeSettings()">
          <i class="fas fa-arrow-left"></i> Back to Main
        </button>
      </div>
    </div>

    <div class="card-container">



      <div class="profile-card">
        <div class="card-inner">
          <div class="card-front">
            <div class="profile-header">
              <img
                src="../imge/profile7.jpg"
                alt="Profile Picture"
                class="profile-img" />
              <h2 class="name">Ali</h2>
              <p class="title">Software Engineer</p>
            </div>
            <div class="card-body">
              <p class="bio">
                I'm a software engineer specializing in backend development. I
                build scalable applications using Python and Django.
              </p>
            </div>
          </div>
          <div class="card-back">
            <h3>More Details</h3>
            <p>
              Visit my profile page to learn more about my projects and
              achievements.
            </p>
            <a href="./page3.php" class="details-button">Go to Profile</a>
          </div>
        </div>
      </div>

   
    </div>

    <a href="./page8.php">
      <button class="create-project-btn">+ Create My Page</button>
    </a>
  </div>

  <div class="contact">
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
  <div class="footer">
    <a href="./home0.php">
      <img class="footer-logo" src="../imge/logo.jpg" alt="" /></a>
    2024 -<span>Group of Programmers</span>- All Right Reserved by
  </div>
  <script src="../Js/page4.js"></script>
 


</body>

</html>