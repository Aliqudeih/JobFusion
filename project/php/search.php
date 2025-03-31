
<?php

include("databasecont.php");




if (isset($_POST["query"]) && !empty(trim($_POST["query"]))) {
    $search = $conn->real_escape_string($_POST["query"]);

    $sql = "SELECT * FROM user_pages 
            WHERE LOWER(REPLACE(bio, ' ', '')) LIKE LOWER(REPLACE('%$search%', ' ', '')) 
            OR LOWER(REPLACE(title, ' ', '')) LIKE LOWER(REPLACE('%$search%', ' ', '')) 
            OR LOWER(REPLACE(skills, ' ', '')) LIKE LOWER(REPLACE('%$search%', ' ', ''))";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // استخراج الصورة من قاعدة البيانات
            $profileImage = $row["page_image"] ? 'data:image/jpeg;base64,' . base64_encode($row["page_image"]) : "../imge/profile7.jpg";

            echo '
            <div class="profile-card">
                <div class="card-inner">
                    <div class="card-front">
                        <div class="profile-header">
                            <img src="' . $profileImage . '" alt="Profile Picture" class="profile-img" />
                            <h2 class="name">' . htmlspecialchars($row["name"]) . '</h2>
                            <p class="title">' . htmlspecialchars($row["title"]) . '</p>
                        </div>
                        <div class="card-body">
                            <p class="bio">' . htmlspecialchars($row["bio"]) . '</p>
                        </div>
                    </div>
                    <div class="card-back">
                        <h3>More Details</h3>
                        <p><strong>Skills:</strong> ' . htmlspecialchars($row["skills"]) . '</p>
                        <p><strong>Email:</strong> ' . htmlspecialchars($row["email"]) . '</p>
                        <p><strong>Phone:</strong> ' . htmlspecialchars($row["phone"]) . '</p>
                        <p><strong>Location:</strong> ' . htmlspecialchars($row["location"]) . '</p>
                        <a href="./page' . $row["page_id"] . '.php" class="details-button">Go to Profile</a>
                    </div>
                </div>
            </div>';
        }
    } else {
        echo '<p>No results found.</p>';
    }
}

$conn->close();
?>
