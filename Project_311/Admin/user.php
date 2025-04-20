<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="../Admin/styles.css">
    <link rel="stylesheet" href="../Admin/user.css">
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li style="background-color: white"><a style="color: black;" href="../Admin/user.php">User Management</a>
            </li>
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
            <h1>User Management</h1>
        </div>
        <div class="content">
            <h2>Pending Registrations</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>


                <?php
                include "../Server/get_data.php";

                while ($row = $inactive_users->fetch_assoc()) {

                    echo "<tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['name'] . "</td>
                            <td>" . $row['email'] . "</td>
                            <td>" . $row['role'] . "</td>
                            <td>" . $row['status'] . "</td>



                    <td>
                    
                        <a href='../Server/actions.php?active_user_id=" . $row['id'] . "'><button  class='accept-btn'>Activate</button></a> 
                 
                        <a href='../Server/actions.php?dlt_id=" . $row['id'] . "'> <button  class='reject-btn'>Reject</button></a>
                        
                    </td>
                    </tr>";
                }
                ?>

            </table>
        </div>
    </div>

</body>

</html>