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
    $skills = $_POST['skills'];
    $experience = $_POST['experience'];
    $education = $_POST['education'];

    // Generate Resume as a simple HTML preview (Can be extended to PDF generation)
    echo "<div class='resume-preview'>";
    echo "<h2>Resume</h2>";
    echo "<p><strong>Name:</strong> $full_name</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Phone:</strong> $phone</p>";
    echo "<h3>Skills</h3><p>$skills</p>";
    echo "<h3>Experience</h3><p>$experience</p>";
    echo "<h3>Education</h3><p>$education</p>";
    echo "</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hirely - Resume Maker</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <nav>
            <ul>
                <li><a href="index.php">Return to Hirely Dashboard</a></li>
            </ul>
        </nav>
        <h2>Resume Builder</h2>
        <form action="" method="post">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" placeholder="Enter your full name" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>

            <label for="skills">Skills</label>
            <textarea id="skills" name="skills" placeholder="List your skills" required></textarea>

            <label for="experience">Experience</label>
            <textarea id="experience" name="experience" placeholder="Describe your work experience" required></textarea>

            <label for="education">Education</label>
            <textarea id="education" name="education" placeholder="Enter your education details" required></textarea>

            <button type="submit">Generate Resume</button>
        </form>
    </div>
</body>
</html>
