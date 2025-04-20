<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advertisement Management</title>
    <link rel="stylesheet" href="../Admin/ads.css">
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
            <li style="background-color: white;"><a style="color: black;" href="../Admin/ads.php">Advertisement</a></li>
            <li><a href="../index.html">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Advertisement Management</h1>
        </div>

        <div class="content">
            <h2>Add New Advertisement</h2>
            <form action="ads_action.php" method="POST" enctype="multipart/form-data">
                <label for="ad_image">Upload Ad Image link:</label>
                <input type="text" name="title" required>
                <label for="ad_description">Advertisement Description:</label>
                <textarea name="description" rows="3" required></textarea>
                <button type="submit" name="upload_ad">Upload Ad</button>
            </form>

            <h2>Existing Advertisements</h2>
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../Server/get_data.php";

                    while ($row = $ads->fetch_assoc()) {
                        echo "<tr>
                        <td><img src= " . $row['ad_image'] . "  style='width: 20%; height: auto;'></td>
                        <td>" . $row['description'] . "</td>
                       <td>
                        <a href='../Server/actions.php?ad_id=" . $row['id'] . "'> <button  class='reject-btn'>Delete</button></a>
                    </td>
                    </tr>";
                    }
                    ?>



                </tbody>
            </table>
        </div>
    </div>

</body>

</html>