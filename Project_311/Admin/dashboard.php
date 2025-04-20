<?php

$name = $_GET['name'];

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../Admin/styles.css">
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="../Admin/user.php">User Management</a></li>
            <li><a href="../Admin/jobs.php">Applied Jobs</a></li>
            <li><a href="../Admin/varified_jobs.php">Varified Jobs</a></li>
            <li><a href="../Admin/analytics.php">Analytics & Reports</a></li>
            <li><a href="../Admin/ads.php">Advertisement</a></li>
            <li><a href="../index.php">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Welcome, <?php echo $name ?> ! Manage the website from here.</h1>
        </div>
        <div class="content">
        <p style="text-align: center ;" >You can now varify and approve pending job request</p>
</br>
            <p style="text-align: center ;" >You can now active the inactive users</p>
        </div>
    </div>

</body>
</html>