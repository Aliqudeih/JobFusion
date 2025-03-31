<?php
// Start session
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

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

    // Fetch the profile picture for the logged-in user
    $stmt = $conn->prepare("SELECT profile_picture FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($image_data);
    $stmt->fetch();

    // Set the content-type header (JPEG in this case)
    header("Content-Type: image/jpeg");

    if ($image_data) {
        // Output the image data
        echo $image_data;
    } else {
        echo "No profile image found.";
    }

    // Close the connection
    $stmt->close();
    $conn->close();
} else {
    echo "User not logged in.";
}
