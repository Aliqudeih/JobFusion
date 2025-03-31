<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include your database connection
include('db_connection.php'); // Make sure to change this if your DB connection is in another file

// Get the page_id from the query string
$page_id = isset($_GET['page_id']) ? (int)$_GET['page_id'] : 0;

// Ensure a valid page_id is provided
if ($page_id > 0) {
    // Prepare and execute query to fetch the image for the given page_id
    $stmt = $conn->prepare("SELECT page_image FROM user_pages WHERE page_id = ?");
    $stmt->execute([$page_id]);
    $user_page = $stmt->fetch(PDO::FETCH_ASSOC);

    // If image data is found
    if ($user_page && $user_page['page_image']) {
        // Set headers to indicate that the content is an image
        header('Content-Type: image/jpeg'); // Change this if you use other image types (e.g., PNG, GIF)

        // Output the image data directly to the browser
        echo $user_page['page_image'];
    } else {
        // If no image found, show a default image or 404
        header("HTTP/1.0 404 Not Found");
        echo "Image not found";
    }
} else {
    // If page_id is invalid or not provided
    header("HTTP/1.0 400 Bad Request");
    echo "Invalid page ID";
}
