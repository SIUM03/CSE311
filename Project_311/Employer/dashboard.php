
<?php
session_start();

include("../Server/connection.php");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Job Portal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container dashboard-container">
        <h2>Employer Dashboard</h2>
        <p>Welcome to your dashboard! Here you can manage your job postings and applications.</p>
        <nav>
            <a href="job-posting.php" class="nav-button">Post a Job</a>
            <a href="application-management.php" class="nav-button">Manage Applications</a>
            <a href="premium-job-listings.php" class="nav-button">Premium Listings</a>
            <a href="company-achievement-feed.php" class="nav-button">Company Achievements</a>
            <a href="../index.php" class="nav-button">Logout</a>
        </nav>
    </div>
</body>
</html>