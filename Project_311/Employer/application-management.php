<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Management - Job Portal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container application-management-container">
        <h2>Manage Applications</h2>
        <p>View and manage your job applications here.</p>
        <table>
            <thead>
                <tr>
                    <th>Applicant Name</th>
                    <th>Job Title</th>
                    <th>Contact</th>
                    <th>Reject</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection
                include("../Server/connection.php");

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch data from the database
                $sql = "SELECT applicant_name, job_title FROM applications";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data for each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['applicant_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['job_title']) . "</td>";
                        echo '<td><button>Contact</button></td>';
                        echo '<td><button>Reject</button></td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No applications found</td></tr>";
                }

                // Close connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>


