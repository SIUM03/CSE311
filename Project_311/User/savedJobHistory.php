<?php
session_start(); // Start the session

if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = "Please log in to view your saved jobs and application history.";
    header("Location: ../login.php"); // Adjust path to your login page
    exit;
}
$user_id = $_SESSION['user_id']; // Get logged-in user's ID

// --- Initialize Variables ---
$saved_jobs = [];      // Array to hold saved job data
$applied_jobs = [];    // Array to hold applied job data
$message = '';         // For displaying general messages/errors

// --- Fetch Data from Database ---
try {
   
     $message = "<div class='message warning'>Displaying placeholder saved/applied jobs for user ID {$user_id}. Database connection needed.</div>";
      if ($user_id == 1) { // Simulate data for user ID 1 for testing
          $saved_jobs = [
              ['job_id' => 1, 'job_title' => 'Saved Job: Senior PHP Dev', 'company_name' => 'Code Solutions', 'location' => 'Remote', 'saved_date' => date('Y-m-d H:i:s', strtotime('-1 day'))],
              ['job_id' => 3, 'job_title' => 'Saved Job: Project Manager', 'company_name' => 'ManageIt', 'location' => 'London', 'saved_date' => date('Y-m-d H:i:s', strtotime('-5 days'))],
          ];
          $applied_jobs = [
              ['job_id' => 2, 'job_title' => 'Applied: Data Analyst', 'company_name' => 'Data Insights', 'location' => 'San Francisco', 'application_date' => date('Y-m-d H:i:s', strtotime('-2 days')), 'status' => 'Submitted'],
              ['job_id' => 4, 'job_title' => 'Applied: UI/UX Designer', 'company_name' => 'Pixel Perfect', 'location' => 'Remote', 'application_date' => date('Y-m-d H:i:s', strtotime('-1 week')), 'status' => 'Viewed'],
          ];
      } else {
           $message .= "<div class='message info'>No saved or applied jobs found (Placeholder for user ID {$user_id}).</div>";
      }
     // --- End Placeholder Section ---


} catch (PDOException $e) {
    $message = "<div class='message error'>Database error: Failed to load job history.</div>";
    // Log detailed error: error_log("PDO Exception loading job history for user $user_id: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hirely - Saved Jobs & Applied History</title>
    <link rel="stylesheet" href="styles.css">
     <style>
        /* Basic styling for messages */
        .message { padding: 10px 15px; margin-bottom: 15px; border-radius: 5px; border: 1px solid transparent; text-align: center; }
        .message.error { background-color: #f8d7da; color: #721c24; border-color: #f5c6cb; }
        .message.warning { background-color: #fff3cd; color: #856404; border-color: #ffeeba; }
        .message.info { background-color: #d1ecf1; color: #0c5460; border-color: #bee5eb; }

        /* Styling for the lists */
        .job-history-list {
            list-style-type: none;
            padding: 0;
            margin-top: 10px;
        }
        .job-history-list li {
            background: #f9f9f9;
            margin-bottom: 10px;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #eee;
            line-height: 1.5;
        }
         .job-history-list li strong {
             display: block;
             font-size: 1.1em;
             color: #0056b3;
             margin-bottom: 5px;
         }
         .job-history-list li span {
             display: block;
             font-size: 0.9em;
             color: #555;
             margin-bottom: 3px;
         }
         .job-history-list li .date-status {
             font-size: 0.85em;
             color: #777;
             margin-top: 8px;
         }
          .job-history-list li a.details-link {
              font-size: 0.9em;
              margin-left: 10px;
              color: #007bff;
              text-decoration: none;
          }
           .job-history-list li a.details-link:hover {
               text-decoration: underline;
           }

    </style>
</head>
<body>
    <div class="container">

        <?php echo $message; // Display messages/errors here ?>

        <h2>Saved Jobs</h2>
        <ul id="saved-jobs-list" class="job-history-list">
            <?php if (empty($saved_jobs)): ?>
                <li>No saved jobs yet.</li>
            <?php else: ?>
                <?php foreach ($saved_jobs as $job): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($job['job_title']); ?></strong>
                        <span>Company: <?php echo htmlspecialchars($job['company_name'] ?? 'N/A'); ?></span>
                        <span>Location: <?php echo htmlspecialchars($job['location'] ?? 'N/A'); ?></span>
                        <span class="date-status">Saved on: <?php echo htmlspecialchars(date('M j, Y', strtotime($job['saved_date'] ?? ''))); ?></span>
                        {/* Optional: Link to view job details */}
                        <a href="jobDetails.php?job_id=<?php echo htmlspecialchars($job['job_id']); ?>" class="details-link">View Details</a>
                        {/* Optional: Add an 'Unsave' button/link here (requires more PHP/JS) */}
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>

        <h2>Applied Job History</h2>
        <ul id="applied-jobs-list" class="job-history-list">
             <?php if (empty($applied_jobs)): ?>
                <li>No applied jobs yet.</li>
            <?php else: ?>
                <?php foreach ($applied_jobs as $application): ?>
                    <li>
                         <strong><?php echo htmlspecialchars($application['job_title']); ?></strong>
                         <span>Company: <?php echo htmlspecialchars($application['company_name'] ?? 'N/A'); ?></span>
                         <span>Location: <?php echo htmlspecialchars($application['location'] ?? 'N/A'); ?></span>
                         <span class="date-status">
                             Applied on: <?php echo htmlspecialchars(date('M j, Y', strtotime($application['application_date'] ?? ''))); ?>
                             <?php if (!empty($application['status'])): ?>
                                 | Status: <?php echo htmlspecialchars($application['status']); ?>
                             <?php endif; ?>
                         </span>
                         {/* Optional: Link to view job details */}
                         <a href="jobDetails.php?job_id=<?php echo htmlspecialchars($application['job_id']); ?>" class="details-link">View Details</a>
                         {/* Optional: Add a 'Withdraw Application' button/link here (requires more PHP/JS) */}
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>

        <nav>
            <ul>
                <li><a href="index.php"> Return to Hirely Dashboard</a></li>
            </ul>
        </nav>
    </div>

</body>
</html>