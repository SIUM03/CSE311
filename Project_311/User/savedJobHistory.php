<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Dummy data for saved and applied jobs (Replace with database queries)
$saved_jobs = [
    ["title" => "Web Developer", "company" => "Tech Solutions"],
    ["title" => "Data Analyst", "company" => "DataCorp"]
];

$applied_jobs = [
    ["title" => "Software Engineer", "company" => "InnoTech", "status" => "Under Review"],
    ["title" => "Marketing Specialist", "company" => "AdWorld", "status" => "Rejected"]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hirely - Saved Jobs & Applied History</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Saved Jobs</h2>
        <ul id="saved-jobs-list">
            <?php if (!empty($saved_jobs)): ?>
                <?php foreach ($saved_jobs as $job): ?>
                    <li><?php echo htmlspecialchars($job['title']) . " at " . htmlspecialchars($job['company']); ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No saved jobs yet.</li>
            <?php endif; ?>
        </ul>

        <h2>Applied Job History</h2>
        <ul id="applied-jobs-list">
            <?php if (!empty($applied_jobs)): ?>
                <?php foreach ($applied_jobs as $job): ?>
                    <li><?php echo htmlspecialchars($job['title']) . " at " . htmlspecialchars($job['company']) . " - Status: " . htmlspecialchars($job['status']); ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No applied jobs yet.</li>
            <?php endif; ?>
        </ul>
        
        <nav>
            <ul>
                <li><a href="index.php"> Return to Hirely Dashboard</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>