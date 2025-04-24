<?php



// --- Initialize Variables ---
$full_name = '';
$email = '';
$phone = '';
$skills = '';
$experience = '';
$education = '';
$message = ''; // For displaying success/error messages

// --- Message Handling (Display Session Messages) ---
if (isset($_SESSION['message'])) {
    $message = "<div class='message " . ($_SESSION['message_type'] ?? 'success') . "'>" . htmlspecialchars($_SESSION['message']) . "</div>";
    unset($_SESSION['message']); // Clear the message after displaying
    unset($_SESSION['message_type']);
}

// --- Form Processing (Save Data) ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- Input Sanitization and Retrieval ---
    $full_name = isset($_POST['full_name']) ? trim(htmlspecialchars($_POST['full_name'])) : '';
    $email = isset($_POST['email']) ? trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)) : '';
    $phone = isset($_POST['phone']) ? trim(htmlspecialchars($_POST['phone'])) : ''; // Add more specific validation if needed
    $skills = isset($_POST['skills']) ? trim(htmlspecialchars($_POST['skills'])) : '';
    $experience = isset($_POST['experience']) ? trim(htmlspecialchars($_POST['experience'])) : '';
    $education = isset($_POST['education']) ? trim(htmlspecialchars($_POST['education'])) : '';

    // Basic Validation
    $errors = [];
    if (empty($full_name)) $errors[] = "Full Name is required.";
    if (empty($email)) $errors[] = "Email is required.";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format.";
    if (empty($phone)) $errors[] = "Phone Number is required.";
    // Add checks for skills, experience, education if strictly required

    if (empty($errors)) {
        try {
            $_SESSION['message'] = "Resume data submitted for user ID {$user_id} (DB Placeholder)!";
            $_SESSION['message_type'] = 'success';
            
            header("Location: resume.php");
            exit;

        } catch (PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage(); // Avoid showing detailed errors to users in production
            
        }
    }

    // If there were errors, create an error message
    if (!empty($errors)) {
        $message = "<div class='message error'><ul>";
        foreach ($errors as $error) {
            $message .= "<li>" . htmlspecialchars($error) . "</li>";
        }
        $message .= "</ul></div>";
        // Keep form data sticky by not clearing variables
    }

} else {
    // --- Load Existing Data on GET request ---
    try {
        
         if ($user_id == 1) { // Simulate data for a specific user ID for testing
             $full_name = 'Test User One';
             $email = 'test1@example.com';
             $phone = '111-222-3333';
             $skills = 'PHP, HTML, CSS, JavaScript (Loaded Placeholder)';
             $experience = 'Web Developer at FakeCorp (Loaded Placeholder)';
             $education = 'BSc Computer Science, Uni Placeholder (Loaded Placeholder)';
             $message = "<div class='message warning'>Displaying placeholder resume data for user ID {$user_id}. Database connection needed.</div>";
         } else {
            $message = "<div class='message info'>Fill out the form to create your resume (No data loaded - Placeholder).</div>";
         }
         // --- End Placeholder Section ---


    } catch (PDOException $e) {
        $message = "<div class='message error'>Database error loading resume: " . htmlspecialchars($e->getMessage()) . "</div>";
         // Log detailed error: error_log("PDO Exception loading resume for user $user_id: " . $e->getMessage());
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hirely - Resume Maker</title>
    <link rel="stylesheet" href="styles.css">
     <style>
        /* Basic styling for messages */
        .message { padding: 10px 15px; margin-bottom: 15px; border-radius: 5px; border: 1px solid transparent; text-align: left; }
        .message ul { margin: 0; padding-left: 20px; }
        .message.success { background-color: #d4edda; color: #155724; border-color: #c3e6cb; }
        .message.error { background-color: #f8d7da; color: #721c24; border-color: #f5c6cb; }
        .message.info { background-color: #d1ecf1; color: #0c5460; border-color: #bee5eb; }
        .message.warning { background-color: #fff3cd; color: #856404; border-color: #ffeeba; }
    </style>
</head>
<body>
    <div class="container">

        <nav>
            <ul>
                <li><a href="index.php">Return to Hirely Dashboard</a></li>
            </ul>
        </nav>

        <h2>Resume Builder</h2>

        <?php echo $message; // Display messages here ?>

        {/* Update form method and action */}
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="full_name">Full Name</label>
            {/* Add value attribute to make form "sticky" */}
            <input type="text" id="full_name" name="full_name" placeholder="Enter your full name" value="<?php echo htmlspecialchars($full_name); ?>" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($email); ?>" required>

            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" placeholder="Enter your phone number" value="<?php echo htmlspecialchars($phone); ?>" required>

            <label for="skills">Skills</label>
            {/* Add content inside textarea tags to make it sticky */}
            <textarea id="skills" name="skills" placeholder="List your skills (e.g., PHP, Project Management, Communication)" required><?php echo htmlspecialchars($skills); ?></textarea>

            <label for="experience">Experience</label>
            <textarea id="experience" name="experience" placeholder="Describe your work experience (Job Title, Company, Dates, Responsibilities)" required><?php echo htmlspecialchars($experience); ?></textarea>

            <label for="education">Education</label>
            <textarea id="education" name="education" placeholder="Enter your education details (Degree, University, Dates)" required><?php echo htmlspecialchars($education); ?></textarea>

            {/* Changed button text slightly for clarity */}
            <button type="submit">Save Resume Data</button>
        </form>
    </div>
</body>
</html>