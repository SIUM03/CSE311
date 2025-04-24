<?php
session_start(); // Start the session (optional here, but good practice if rest of site uses it)


$search_title = '';
$search_location = '';
$search_category = '';
$search_salary = ''; // Keep as string based on input field type
$search_results = []; // Array to hold job results
$message = '';      // For displaying messages like "No results found"


if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET)) {

    // --- Input Sanitization and Retrieval ---
    $search_title = isset($_GET['job_title']) ? trim(htmlspecialchars($_GET['job_title'])) : '';
    $search_location = isset($_GET['location']) ? trim(htmlspecialchars($_GET['location'])) : '';
    $search_category = isset($_GET['category']) ? trim(htmlspecialchars($_GET['category'])) : '';
    $search_salary = isset($_GET['salary']) ? trim(htmlspecialchars($_GET['salary'])) : ''; // Basic sanitization

    
    try {
       
        $sql = "SELECT job_id, job_title, company_name, location, category, salary_range, description
                FROM jobs
                WHERE status = 'active'"; // Example: Only show active jobs

        $params = []; 
        if (!empty($search_title)) {
            $sql .= " AND job_title LIKE :title";
            $params[':title'] = '%' . $search_title . '%'; // Use LIKE for partial match
        }
        if (!empty($search_location)) {
            $sql .= " AND location LIKE :location";
            $params[':location'] = '%' . $search_location . '%';
        }
        if (!empty($search_category)) {
            $sql .= " AND category = :category";
            $params[':category'] = $search_category; // Exact match for category
        }
        if (!empty($search_salary)) {
            
            $sql .= " AND salary_range LIKE :salary";
            $params[':salary'] = '%' . $search_salary . '%';
        }

        $sql .= " ORDER BY posting_date DESC"; // Show newest jobs first (assuming a posting_date column)
       
        $message = "<div class='message warning'>Search results are placeholders. Database connection needed.</div>";
        if ($search_title || $search_location || $search_category || $search_salary) {
           // Simulate some results if search terms were entered
           $search_results = [
               ['job_id' => 1, 'job_title' => 'Placeholder Web Developer (' . $search_title . ')', 'company_name' => 'Fake Inc.', 'location' => 'Remote', 'category' => 'it', 'salary_range' => '$60k - $80k', 'description' => 'Develop fake websites using latest tech.'],
               ['job_id' => 2, 'job_title' => 'Placeholder Marketing Assistant', 'company_name' => 'Ad Co.', 'location' => ($search_location ?: 'New York'), 'category' => 'marketing', 'salary_range' => '$50k', 'description' => 'Assist with placeholder campaigns and analysis.']
           ];
           if (!empty($search_category) && $search_category !== 'it' && $search_category !== 'marketing') {
              $search_results = []; // Simulate no results if category doesn't match placeholders
           }
        }
        if (empty($search_results) && !empty($_GET)) {
             $message .= "<div class='message info'>No jobs found matching your criteria (Placeholder).</div>";
        }
        // --- End Placeholder Section ---


    } catch (PDOException $e) {
        $message = "<div class='message error'>Database error: " . htmlspecialchars($e->getMessage()) . "</div>"; // Show specific error only if needed/safe
        // Log detailed error: error_log("PDO Exception in jobSearch.php: " . $e->getMessage());
    }

} // End of GET request processing

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hirely - Job Search</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Basic styling for messages */
        .message { padding: 10px 15px; margin-bottom: 15px; border-radius: 5px; border: 1px solid transparent; text-align: center; }
        .message.info { background-color: #d1ecf1; color: #0c5460; border-color: #bee5eb; }
        .message.error { background-color: #f8d7da; color: #721c24; border-color: #f5c6cb; }
        .message.warning { background-color: #fff3cd; color: #856404; border-color: #ffeeba; }

        /* Basic styling for search results */
        .search-results { margin-top: 30px; border-top: 1px solid #eee; padding-top: 20px; }
        .job-listing {
            background-color: #f9f9f9;
            border: 1px solid #e0e0e0;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        .job-listing h3 { margin-top: 0; margin-bottom: 5px; color: #0056b3; }
        .job-listing p { margin-bottom: 8px; line-height: 1.4; color: #333; }
        .job-listing strong { color: #555; }
        .job-listing .apply-button {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.9em;
            transition: background-color 0.2s ease;
        }
        .job-listing .apply-button:hover { background-color: #218838; }
        .job-description-short {
             max-height: 60px; /* Limit description height */
             overflow: hidden;
             text-overflow: ellipsis;
        }

    </style>
</head>
<body>
    <div class="container">
        <nav>
            <ul>
                <li><a href="index.php"> Return to Hirely Dashboard</a></li>
            </ul>
        </nav>
        <h2>Job Search</h2>

      
        <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="job_title">Job Title</label>
            <input type="text" id="job_title" name="job_title" placeholder="Enter job title" value="<?php echo $search_title; ?>">

            <label for="location">Location</label>
            <input type="text" id="location" name="location" placeholder="Enter location" value="<?php echo $search_location; ?>">

            <label for="category">Category</label>
            <select id="category" name="category">
                {/* Add 'selected' attribute based on current search value */}
                <option value="" <?php echo empty($search_category) ? 'selected' : ''; ?>>Select Category</option>
                <option value="it" <?php echo ($search_category === 'it') ? 'selected' : ''; ?>>IT & Software</option>
                <option value="marketing" <?php echo ($search_category === 'marketing') ? 'selected' : ''; ?>>Marketing</option>
                <option value="finance" <?php echo ($search_category === 'finance') ? 'selected' : ''; ?>>Finance</option>
                <option value="healthcare" <?php echo ($search_category === 'healthcare') ? 'selected' : ''; ?>>Healthcare</option>
            </select>

            <label for="salary">Salary Range</label>
            <input type="text" id="salary" name="salary" placeholder="Enter salary keyword (e.g., $50k, negotiable)" value="<?php echo $search_salary; ?>">

            <button type="submit">Search Jobs</button>
        </form>

        <div class="search-results">
            <h2>Search Results</h2>
            <?php echo $message; // Display messages (like "No results") ?>

            <?php if (!empty($search_results)): ?>
                <?php foreach ($search_results as $job): ?>
                    <div class="job-listing">
                        <h3><?php echo htmlspecialchars($job['job_title']); ?></h3>
                        <p><strong>Company:</strong> <?php echo htmlspecialchars($job['company_name'] ?? 'N/A'); ?></p> {/* Use null coalescing for optional fields */}
                        <p><strong>Location:</strong> <?php echo htmlspecialchars($job['location']); ?></p>
                        <p><strong>Category:</strong> <?php echo htmlspecialchars(ucfirst($job['category'])); ?></p> {/* Capitalize first letter */}
                        <p><strong>Salary:</strong> <?php echo htmlspecialchars($job['salary_range'] ?? 'Not Specified'); ?></p>
                        <p class="job-description-short"><strong>Description:</strong> <?php echo htmlspecialchars($job['description'] ?? 'No description provided.'); ?></p>
                        <a href="jobApplication.php?job_id=<?php echo htmlspecialchars($job['job_id']); ?>" class="apply-button">Apply Now</a>
                         {/* <a href="jobDetails.php?job_id=<?php echo htmlspecialchars($job['job_id']); ?>" class="details-button">View Details</a> */}
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>
</body>
</html>