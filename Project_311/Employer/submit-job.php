<?php

include ("../Server/connection.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form values safely
    $title = htmlspecialchars($_POST["title"]);
    $salary = htmlspecialchars($_POST["salary"]);
    $description = htmlspecialchars($_POST["description"]);
    $category = htmlspecialchars($_POST["category"]);
    $jobType = isset($_POST["job-type"]) ? htmlspecialchars($_POST["job-type"]) : "Not specified";
    $location = isset($_POST["work-location"]) ? htmlspecialchars($_POST["work-location"]) : "Not specified";

    

    echo "<h2>Job Posted Successfully!</h2>";
    echo "<p><strong>Title:</strong> $title</p>";
    echo "<p><strong>Salary:</strong> $salary</p>";
    echo "<p><strong>Description:</strong> $description</p>";
    echo "<p><strong>Category:</strong> $category</p>";
    echo "<p><strong>Job Type:</strong> $jobType</p>";
    echo "<p><strong>Work Location:</strong> $location</p>";
} else {
    // Redirect back if not submitted properly
    header("Location: dashboard.html"); // Change to your actual job posting page
    exit();
}
?>
