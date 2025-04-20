<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $cover_letter = $_POST['cover_letter'];

    // Handle file upload
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
        $upload_dir = 'uploads/';
        $resume_name = basename($_FILES['resume']['name']);
        $upload_file = $upload_dir . $resume_name;
        
        if (move_uploaded_file($_FILES['resume']['tmp_name'], $upload_file)) {
            echo "<p>Application submitted successfully!</p>";
        } else {
            echo "<p>Error uploading resume.</p>";
        }
    } else {
        echo "<p>Please upload a valid resume.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hirely - Job Application</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <nav>
            <ul>
                <li><a href="index.php">Return to Hirely Dashboard</a></li>
            </ul>
        </nav>
        <h2>Job Application</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" placeholder="Enter your full name" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>

            <label for="resume">Upload Resume</label>
            <input type="file" id="resume" name="resume" required>

            <label for="cover_letter">Cover Letter</label>
            <textarea id="cover_letter" name="cover_letter" placeholder="Write your cover letter here" required></textarea>

            <button type="submit">Apply Now</button>
        </form>
    </div>
</body>
</html>
