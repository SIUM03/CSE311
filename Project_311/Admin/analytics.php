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

    <?php
                    include "../Server/get_data.php";
                    $total = $conn->query("SELECT COUNT(*) as t FROM jobs ");

                    $total_job = $total->fetch_assoc()['t'];
                    $total_jobs = $conn->query("SELECT COUNT(*) as total FROM jobs WHERE status='pending'");

                    $total_jobs_count = $total_jobs->fetch_assoc()['total'];
                    $varified_jobs = $conn->query("SELECT COUNT(*) as varified FROM jobs WHERE status='varified'");
                    
                    $varified_jobs_count = $varified_jobs->fetch_assoc()['varified'];
                    $marketing= $conn->query('SELECT COUNT(*)FROM jobs WHERE category="Marketing" and status="varified" ');
                    $marketing_count = $marketing->fetch_assoc()['COUNT(*)'];
                    $healthcare= $conn->query('SELECT COUNT(*)FROM jobs WHERE category="Healthcare"  and status="varified" ');
                    $healthcare_count = $healthcare->fetch_assoc()['COUNT(*)'];
                    $software= $conn->query('SELECT COUNT(*)FROM jobs WHERE category="Software"  and status="varified" ');  
                    $software_count = $software->fetch_assoc()['COUNT(*)'];
                    $finance= $conn->query('SELECT COUNT(*)FROM jobs WHERE category="Finance"  and status="varified" ');
                    $finance_count = $finance->fetch_assoc()['COUNT(*)'];

                    $ad=$conn->query('SELECT COUNT(*)FROM advertisements ');
                    $ad_count = $ad->fetch_assoc()['COUNT(*)'];

                    $user=$conn->query('SELECT COUNT(*)FROM users ');
                    $user_count = $user->fetch_assoc()['COUNT(*)'];
                    ?>
    <div class="main-content">
        <div class="header">
            <h1>Analytics & Reports</h1>
        </div>
        <div class="content">
            <h2>Statistics</h2>
            
            <div class="stats-container">
            <div class="stat-box">
                    <h3>Total Job request</h3>
                    <p id="job-request"><?php echo $total_job; ?></p>
                </div>
                <div class="stat-box">
                    
                   
                    <h3>Total Pending Jobs</h3>
                    <p id="total-applied-jobs"><?php echo $total_jobs_count; ?></p>
                </div>
                <div class="stat-box">
                    <h3>Total Varified Jobs</h3>
                    <p id="job-requests"><?php echo $varified_jobs_count; ?></p>
                </div>
                <div class="stat-box">
                    <h3>Total Running Advertisement</h3>
                    <p id="job-requests"><?php echo $ad_count; ?></p>
                </div>
                <div class="stat-box">
                    <h3>Total user</h3>
                    <p id="job-requests"><?php echo $user_count; ?></p>
                </div>
                
            </div>

            <h2>Job Categories & Vacancies</h2>
            <table>
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Available Jobs</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody id="category-table">
                    <tr>
                        <td >Marketing</td>
                    <td ><?php echo $marketing_count; ?></td>
                 <td>   <a href="analytics.php?cat=marketing" class="button">View jobs </a></td>
                    </tr>
                    <tr>
                        <td >Healthcare</td>
                    <td ><?php echo $healthcare_count; ?></td>
                    <td>   <a href="analytics.php?cat=healthcare" class="button">View jobs </a></td>


                </tr>
                <tr>
                        <td >Software</td>
                    <td ><?php echo $software_count; ?></td>
                    <td>   <a href="analytics.php?cat=software" class="button">View jobs </a></td>

                </tr>
                <tr>
                        <td >Finance</td>
                    <td ><?php echo $finance_count; ?></td>
                    <td>   <a href="analytics.php?cat=finance" class="button">View jobs </a></td>

                </tr>
                </tbody>
            </table>

            <h2>Job Categories Overview</h2>
            <table>
                <thead>
                    <tr>
                        <th>Job ID</th>
                        <th>Title</th>
                        <th>Salary</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../Server/get_data.php";
                    $cat = '';
             if(isset($_GET["cat"]))
                    $cat= $_GET['cat'];
                    if($cat=='')
                        $cat="Marketing";
                   $sql6='SELECT * FROM jobs WHERE category="'.$cat.'" and status="varified"';
                    $cat_jobs = $conn->query($sql6);


                    while ($row = $cat_jobs->fetch_assoc()) {

                        echo "<tr>
                            <td>" . $row['job_id'] . "</td>
                            <td>" . $row['title'] . "</td>
                            <td>" . $row['salary'] . "</td>
                            <td>" . $row['description'] . "</td>
                            <td>" . $row['category'] . "</td>
                            <td>" . $row['location'] . "</td>

                    </tr>";
                    }
                    ?>




                </tbody>
            </table>

        </div>
    </div>

</body>
</html>
