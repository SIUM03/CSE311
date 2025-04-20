<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <link rel="stylesheet" href="../Admin/jobs.css">
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="../Admin/user.php">User Management</a></li>
            <li><a href="../Admin/jobs.php">Applied Jobs</a></li>
            <li style="background-color: aliceblue;"><a style="color: black;" href="../Admin/varified_jobs.php">Varified
                    Jobs</a></li>
            <li><a href="../Admin/analytics.php">Analytics & Reports</a></li>
            <li><a href="../Admin/ads.php">Advertisement</a></li>
            <li><a href="../index.php">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Job Listings</h1>
        </div>
        <div class="content">
            <h2>Pending Job Approvals</h2>
            <table>
                <thead>
                    <tr>
                        <th>Job ID</th>
                        <th>Title</th>
                        <th>Salary</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../Server/get_data.php";

                    while ($row = $varified_jobs->fetch_assoc()) {
                        echo "<tr>
                            <td>" . $row['job_id'] . "</td>
                            <td>" . $row['title'] . "</td>
                            <td>" . $row['salary'] . "</td>
                            <td>" . $row['description'] . "</td>
                            <td>" . $row['location'] . "</td>


                    <td>
                        <a href='../Server/actions.php?delete_varified_job_id=" . $row['job_id'] . "'> <button  class='reject-btn'>Delete Job</button></a>
                    </td>
                    </tr>";
                    } ?>




                </tbody>
            </table>
        </div>
    </div>

</body>

</html>