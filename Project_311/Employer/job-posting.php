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
        <form id="job-posting-form" action="submit-job.php" method="POST">
            <input type="text" name ="title" placeholder="Job Title" required>
            <input type="text" name ="salary" placeholder="Salary" required>
            <textarea placeholder="Job Details" name="Description" rows="4" required></textarea>

            <div class="job-category">
                <label for="job-category">Job Category:</label>
                <select id="job-category" required>
                    <option value="" disabled selected>Select Job Category</option>
                    <option value="software">Software</option>
                    <option value="marketing">Marketing</option>
                    <option value="finance">Finance</option>
                    <option value="healthcare">Healthcare</option>
                </select>
            </div>

            <div class="job-type">
                <h4>Job Type:</h4>
                <label><input type="radio" name="job-type" value="full-time"> Full-Time</label>
                <label><input type="radio" name="job-type" value="part-time"> Part-Time</label>
            </div>

            <div class="work-location">
                <h4>Work Location:</h4>
                <label><input type="radio" name="work-location" value="online"> Online</label>
                <label><input type="radio" name="work-location" value="in-office"> In-Office</label>
            </div>


            <button type="submit">Post Job</button>
        </form>
    </div>

    <script>
        document.getElementById('job-posting-form').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Job posted successfully!');
            this.reset(); // Reset abar
        });
    </script>
</body>
</html>