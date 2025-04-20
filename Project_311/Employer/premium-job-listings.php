<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Job Listings - Job Portal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container premium-job-listings-container">
        <h2>Premium Job Listings</h2>
        <p>Select which job posts you want to feature.</p>

        <h3>Existing Job Listings</h3>
        <form method="POST" action="feature-job.php">
            <table>
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Company</th>
                        <th>Salary</th>
                        <th>Feature Duration</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                   include("../Server/connection.php");
                    
                    // Fetch job listings from the database
                    $sql = "SELECT id, job_title, company, salary FROM jobs";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $jobId = $row['id'];
                            $jobTitle = htmlspecialchars($row['job_title']);
                            $company = htmlspecialchars($row['company']);
                            $salary = htmlspecialchars($row['salary']);
                            echo "<tr>
                                <td>$jobTitle</td>
                                <td>$company</td>
                                <td>\$$salary</td>
                                <td>
                                    <select name='duration[$jobId]'>
                                        <option value='1_week'>\$50 (1 Week)</option>
                                        <option value='2_weeks'>\$90 (2 Weeks)</option>
                                        <option value='1_month'>\$150 (1 Month)</option>
                                        <option value='3_months'>\$400 (3 Months)</option>
                                    </select>
                                </td>
                                <td>
                                    <button type='submit' name='feature' value='$jobId'>Feature</button>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No job listings found.</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['feature'])) {
        $jobId = $_POST['feature'];
        $duration = $_POST['duration'][$jobId] ?? null;

        if ($duration) {
        include("../Server/connection.php");

        $durationMapping = [
            '1_week' => 7,
            '2_weeks' => 14,
            '1_month' => 30,
            '3_months' => 90
        ];

        $days = $durationMapping[$duration] ?? 0;

        if ($days > 0) {
            $startDate = date('Y-m-d');
            $endDate = date('Y-m-d', strtotime("+$days days"));

            $stmt = $conn->prepare("INSERT INTO premium_listings (job_id, start_date, end_date) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $jobId, $startDate, $endDate);

            if ($stmt->execute()) {
            echo "<script>alert('The job has been successfully featured.');</script>";
            } else {
            echo "<script>alert('Failed to feature the job. Please try again.');</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Invalid duration selected.');</script>";
        }

        $conn->close();
            echo "<script>alert('The job with ID \"$jobId\" has been featured for $duration.');</script>";
        } else {
            echo "<script>alert('Please select a duration to feature this job.');</script>";
        }
    }
    ?>
</body>
</html>


