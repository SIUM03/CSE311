<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics & Reports</title>
    <link rel="stylesheet" href="../Admin/analytics.css">
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>

            <li><a href="../Admin/user.php">User Management</a></li>
            <li><a href="../Admin/jobs.php">Applied Jobs</a></li>
            <li><a href="../Admin/varified_jobs.php">Varified Jobs</a></li>
            <li style="background-color: white;"><a style="color: black;" href="../Admin/analytics.php">Analytics & Reports</a></li>
            <li><a href="../Admin/ads.php">Advertisement</a></li>
            <li><a href="../index.php">Logout</a></li>
        </ul>
    </div>


    <div class="main-content">
        <div class="header">
            <h1>Analytics & Reports</h1>
        </div>
        <div class="content">
            <h2>Job Statistics</h2>
            
            <div class="stats-container">
                <div class="stat-box">
                    <h3>Total Available Jobs</h3>
                    <p id="total-jobs">Loading...</p>
                </div>
                <div class="stat-box">
                    <h3>Total Job Requests</h3>
                    <p id="job-requests">Loading...</p>
                </div>
            </div>

            <h2>Job Categories & Vacancies</h2>
            <table>
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Available Jobs</th>
                    </tr>
                </thead>
                <tbody id="category-table">
                    <tr><td colspan="2">Loading...</td></tr>
                </tbody>
            </table>

            <h2>Job Categories Overview</h2>

        </div>
    </div>

</body>
</html>
