<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Posting - Job Portal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container job-posting-container">
        <h2>Post a New Job</h2>

        <?php
        include("../Server/connection.php");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = htmlspecialchars($_POST['title']);
            $salary = htmlspecialchars($_POST['salary']);
            $description = htmlspecialchars($_POST['Description']);
            $jobCategory = htmlspecialchars($_POST['job-category']);
            $jobType = htmlspecialchars($_POST['job-type']);
            $workLocation = htmlspecialchars($_POST['work-location']);

            $sql = "INSERT INTO jobs (title, salary, description, job_category, job_type, work_location) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $title, $salary, $description, $jobCategory, $jobType, $workLocation);

            if ($stmt->execute()) {
                echo "<p>Job posted successfully!</p>";
                echo "<p><strong>Title:</strong> $title</p>";
                echo "<p><strong>Salary:</strong> $salary</p>";
                echo "<p><strong>Description:</strong> $description</p>";
                echo "<p><strong>Category:</strong> $jobCategory</p>";
                echo "<p><strong>Type:</strong> $jobType</p>";
                echo "<p><strong>Location:</strong> $workLocation</p>";
            } else {
                echo "<p>Error: " . $stmt->error . "</p>";
            }

            $stmt->close();
            $conn->close();
        }
        ?>

        <form id="job-posting-form" action="job-posting.php" method="POST">
            <input type="text" name="title" placeholder="Job Title" required>
            <input type="text" name="salary" placeholder="Salary" required>
            <textarea placeholder="Job Details" name="Description" rows="4" required></textarea>

            <div class="job-category">
                <label for="job-category">Job Category:</label>
                <select id="job-category" name="job-category" required>
                    <option value="" disabled selected>Select Job Category</option>
                    <option value="software">Software</option>
                    <option value="marketing">Marketing</option>
                    <option value="finance">Finance</option>
                    <option value="healthcare">Healthcare</option>
                </select>
            </div>

            <div class="job-type">
                <h4>Job Type:</h4>
                <label><input type="radio" name="job-type" value="full-time" required> Full-Time</label>
                <label><input type="radio" name="job-type" value="part-time" required> Part-Time</label>
            </div>

            <div class="work-location">
                <h4>Work Location:</h4>
                <label><input type="radio" name="work-location" value="online" required> Online</label>
                <label><input type="radio" name="work-location" value="in-office" required> In-Office</label>
            </div>

            <button type="submit">Post Job</button>
        </form>
    </div>
</body>
</html>