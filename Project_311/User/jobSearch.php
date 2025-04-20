<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle form submission
$jobs = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job_title = $_POST['job_title'];
    $location = $_POST['location'];
    $category = $_POST['category'];
    $salary = $_POST['salary'];
    
    // Dummy job listings (Replace with database query)
    $jobs = [
        ["title" => "Software Engineer", "location" => "New York", "category" => "IT & Software", "salary" => "$70,000"],
        ["title" => "Marketing Manager", "location" => "Los Angeles", "category" => "Marketing", "salary" => "$60,000"],
        ["title" => "Accountant", "location" => "Chicago", "category" => "Finance", "salary" => "$55,000"],
        ["title" => "Nurse", "location" => "Houston", "category" => "Healthcare", "salary" => "$50,000"]
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hirely - Job Search</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <nav>
            <ul>
                <li><a href="index.php"> Return to Hirely Dashboard</a></li>
            </ul>
        </nav>
        <h2>Job Search</h2>
        <form action="" method="post">
            <label for="job_title">Job Title</label>
            <input type="text" id="job_title" name="job_title" placeholder="Enter job title">

            <label for="location">Location</label>
            <input type="text" id="location" name="location" placeholder="Enter location">

            <label for="category">Category</label>
            <select id="category" name="category">
                <option value="">Select Category</option>
                <option value="it">IT & Software</option>
                <option value="marketing">Marketing</option>
                <option value="finance">Finance</option>
                <option value="healthcare">Healthcare</option>
            </select>

            <label for="salary">Salary Range</label>
            <input type="text" id="salary" name="salary" placeholder="Enter salary range">

            <button type="submit">Search Jobs</button>
        </form>
        
        <?php if (!empty($jobs)): ?>
            <h3>Job Results:</h3>
            <ul>
                <?php foreach ($jobs as $job): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($job["title"]); ?></strong><br>
                        Location: <?php echo htmlspecialchars($job["location"]); ?><br>
                        Category: <?php echo htmlspecialchars($job["category"]); ?><br>
                        Salary: <?php echo htmlspecialchars($job["salary"]); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>
</html>
