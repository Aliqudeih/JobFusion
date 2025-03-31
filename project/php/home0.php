 <h1>kbjsbjf,,</h1>
 
 
 <?php
    session_start();

    // Database connection
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "jobfusion";

    $conn = new mysqli($host, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle login
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
        $email = trim($_POST["email"]);  // Change from username to email
        $password = trim($_POST["password"]);

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
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
                header("Location: home0.php");
                exit();
            } else {
                $_SESSION['notification'] = "Invalid password.";
                $_SESSION['notification_type'] = "error";
            }
        } else {
            $_SESSION['notification'] = "No user found with that email.";
            $_SESSION['notification_type'] = "error";
        }
        header("Location: home0.php");
        exit();
    }

    // Handle registration
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create-account"])) {
        $email = trim($_POST["create-email"]);
        $password = trim($_POST["create-password"]);
        $confirm_password = trim($_POST["create-confirm-password"]);

        if ($password !== $confirm_password) {
            $_SESSION['notification'] = "Passwords do not match.";
            $_SESSION['notification_type'] = "error";
            header("Location: home0.php");
            exit();
        }

        // Check if email exists
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['notification'] = "Email already exists!";
            $_SESSION['notification_type'] = "error";
            header("Location: home0.php");
            exit();
        }

        // Insert new user
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $password_hash);

        if ($stmt->execute()) {
            $_SESSION['notification'] = "Registration successful! Please log in.";
            $_SESSION['notification_type'] = "success";
        } else {
            $_SESSION['notification'] = "Error: " . $conn->error;
            $_SESSION['notification_type'] = "error";
        }

        header("Location: home0.php");
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
     <link rel="stylesheet" href="../css/home.css" />
     <link
         rel="stylesheet"
         href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
     <script src="https://accounts.google.com/gsi/client" async defer></script>

 </head>

 <body>
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
                             <a href="logout.php" style="color: red">🚪 Log Out</a>

                         </div>
                     </div>
                 <?php else: ?>
                     <div class="login">
                         <button id="login-button">
                             <i class="fas fa-sign-in-alt"></i> Login
                         </button>
                     </div>
                 <?php endif; ?>
             </div>
             <div class="links">
                 <span class="icon">
                     <span></span>
                     <span></span>
                     <span></span>
                 </span>
                 <ul>
                     <li><a href="#services">Services</a></li>
                     <li><a href="#portfolio">Portfolio</a></li>
                     <li><a href="#about">About</a></li>
                     <li><a href="#contact">Contact</a></li>
                 </ul>
             </div>


         </div>






     </div>
     </div>

     <!-- Login Form -->
     <div class="popup-overlay" id="popup-overlay">
         <div class="popup">
             <button class="close-btn" id="close-popup">&times;</button>
             <h1>Login</h1>
             <form id="login-form" action="" method="POST">
                 <label for="email">Email</label>
                 <input type="email" id="email" name="email" placeholder="Enter your email" required />

                 <label for="password">Password</label>
                 <input type="password" id="password" name="password" placeholder="Enter your password" required />

                 <button class="login-btn" type="submit" name="login">Login</button>
             </form>

             <a href="#" id="forgot-password">Forgot Password?</a>
             <a href="#" id="create-account" class="create-account">Create an Account</a>
             <div id="g_id_onload"
                 data-client_id="238113643899-su9pt6ia846pge9itlv5gn16778nbj0a.apps.googleusercontent.com"
                 data-callback="handleCredentialResponse"
                 data-auto_prompt="false">
             </div>

             <div class="g_id_signin"
                 data-type="standard"
                 data-size="large"
                 data-theme="outline"
                 data-text="sign_in_with"
                 data-shape="rectangular">
             </div>

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

     <script src="https://accounts.google.com/gsi/client" async defer></script>

     <div class="landing">
         <img class="cover" src="../imge/bac.jpeg" alt="">

     </div>

     <div class="features">
         <div class="container">
             <div class="feat">
                 <i class="fas fa-magic fa-3x"></i>
                 <h3>
                     A comprehensive platform for everything you need in your daily life
                 </h3>
                 <p>
                     The project seeks to be a comprehensive market for daily services,
                     where individuals and companies can easily find solutions to their
                     daily problems and fixes. The idea aims to provide all the services
                     that the customer may need in one place, which enhances the
                     efficiency and effectiveness of the interaction between the customer
                     and the service provider.
                 </p>
             </div>
             <div class="feat">
                 <i class="far fa-gem fa-3x"></i>
                 <h3>Facilitating access to quality and reliable services</h3>
                 <p>
                     The platform provides a simple interface that enables customers to
                     search for the repair services they need, and view previous ratings
                     and reviews of service providers. This method ensures that customers
                     choose the best based on the experiences of others, which enhances
                     the transparency and quality of the services provided.
                 </p>
             </div>
             <div class="feat">
                 <i class="fas fa-globe-asia fa-3x"></i>
                 <h3>Renting a dedicated advertising space</h3>
                 <p>
                     The platform offers a unique opportunity for business owners and
                     individuals to rent a special space to display their services within
                     the site. This space can be customized to highlight the available
                     services in a professional and attractive manner, allowing small
                     business owners the opportunity to expand their customer base.
                 </p>
             </div>
         </div>
     </div>

     <div class="services" id="services">
         <div class="container">
             <h2 class="special-heading">Services</h2>
             <p>Don't be busy, be productive</p>
             <div class="services-content">
                 <div class="col">
                     <div
                         style="padding-right: 60px; width: 2px; height: 2px; right: 60px">
                         <img src="../imge/imge1.jpg" right="50" width="50" height="30" />
                     </div>
                     <div class="srv">
                         <i class=""></i>
                         <a sre=""></a>
                         <div class="text">
                             <h3>
                                 <a
                                     href="/php/services.php?service=electronic"
                                     style="text-decoration: none; color: black">Electronic Device Repair Services</a>
                             </h3>
                             <p>
                                 Repairing all types of electronic devices, such as phones,
                                 computers, televisions, and tablets, while providing
                                 innovative technical solutions to fix faults and improve
                                 performance.
                             </p>
                         </div>
                     </div>
                     <div
                         style="padding-right: 60px; width: 2px; height: 2px; right: 60px">
                         <img src="../imge/imge2.jpg" right="50" width="50" height="30" />
                     </div>
                     <div class="srv">
                         <i class=""></i>
                         <div class="text">
                             <h3>
                                 <a
                                     href="./services.php?service=maintenance"
                                     style="text-decoration: none; color: black">Home Maintenance Services</a>
                             </h3>
                             <p>
                                 We offer a full range of home maintenance services, including
                                 plumbing, air conditioning, electricity, and home painting, to
                                 ensure that all your home needs are covered.
                             </p>
                         </div>
                     </div>
                 </div>
                 <div class="col">
                     <div
                         style="padding-right: 60px; width: 2px; height: 2px; right: 60px">
                         <img src="../imge/imge3.jpg" right="50" width="50" height="30" />
                     </div>
                     <div class="srv">
                         <i class=""></i>
                         <div class="text">
                             <h3>
                                 <a
                                     href="./services.php?service=mechanical"
                                     style="text-decoration: none; color: black">Mechanical Services</a>
                             </h3>
                             <p>
                                 Our mechanical services include car and motorcycle
                                 maintenance, in addition to providing fast and reliable
                                 repairs of mechanical faults with the latest equipment.
                             </p>
                         </div>
                     </div>
                     <div
                         style="padding-right: 60px; width: 2px; height: 2px; right: 60px">
                         <img src="../imge/imge4.jpg" right="50" width="50" height="30" />
                     </div>
                     <div class="srv">
                         <i class=""></i>
                         <div class="text">
                             <h3>
                                 <a
                                     href="./services.php?service=real"
                                     style="text-decoration: none; color: black">Real Estate Services</a>
                             </h3>
                             <p>
                                 Our real estate services include buying, selling, and renting
                                 properties, in addition to providing real estate consultations
                                 to meet the needs of customers with the best available
                                 options.
                             </p>
                         </div>
                     </div>
                 </div>
                 <div class="col">
                     <div class="image image-column">
                         <img src="../imge/b1.png" alt="" />
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <div class="portfolio" id="portfolio">
         <div class="container">
             <h2 class="special-heading">Portfolio</h2>
             <p>If you do it right, it will last forever.</p>
             <div class="portfolio-content">
                 <div class="card" data-id="1">
                     <img src="../imge/protfolio.jpg" alt="" />
                     <div class="info">
                         <h3>Project Overview</h3>
                         <p>
                             A web platform dedicated to connecting skilled graduates with
                             clients in need of repair and maintenance services, providing an
                             opportunity to build careers without the need for startup
                             capital.
                         </p>
                     </div>
                 </div>
                 <div class="card" data-id="2">
                     <img src="../imge/protfolio-2.jpg" alt="" />
                     <div class="info">
                         <h3>The Problem</h3>
                         <p>
                             Many graduates possess valuable skills in trades like electrical
                             work, plumbing, and mechanics but lack the resources to start
                             their own businesses, limiting their job opportunities.
                         </p>
                     </div>
                 </div>
                 <div class="card" data-id="3">
                     <img src="../imge/protfolio-3.jpg" alt="" />
                     <div class="info">
                         <h3>The Solution</h3>
                         <p>
                             This platform enables graduates to offer their services directly
                             to clients, building a reputation and income without needing to
                             invest in a full-fledged business. Additionally, service
                             providers can rent space on the platform to promote their skills
                             and services.
                         </p>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <div class="about" id="about">
         <div class="container">
             <h2 class="special-heading">About</h2>
             <p>Unlocking Potential, Creating Opportunity</p>
             <div class="about-content">
                 <div class="image">
                     <img src="../imge/about.jpg" alt="" />
                 </div>
                 <div class="text">
                     <p>
                         Our mission is to empower skilled graduates by providing them with
                         abundant job opportunities, free from the high costs of starting a
                         business. Our platform is a launchpad for talent—a place where
                         skills shine, connections grow, and careers begin.
                     </p>
                     <hr />
                     <p>
                         With an easy-to-use interface, clients find the services they
                         need, and professionals showcase their expertise effortlessly.
                         Together, let's build a future where talent meets opportunity.
                     </p>
                 </div>
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
     <div class="footer">
         <div class="footer-content">
             <div class="footer-text">
                 <img class="footer-logo" src="../imge/logo.jpg" alt="Logo" />
                 <div>2024 -<span>Group of Programmers</span>- All Right Reserved</div>
             </div>
         </div>
     </div>



     <script src="../Js/script.js"></script>
 </body>

 </html>