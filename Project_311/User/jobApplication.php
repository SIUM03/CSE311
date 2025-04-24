<?php





if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- Input Sanitization and Retrieval ---
    $full_name = isset($_POST['full_name']) ? trim(htmlspecialchars($_POST['full_name'])) : '';
    $email = isset($_POST['email']) ? trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)) : '';
    $phone = isset($_POST['phone']) ? trim(htmlspecialchars($_POST['phone'])) : ''; // Basic sanitization, consider regex for format
    $cover_letter = isset($_POST['cover_letter']) ? trim(htmlspecialchars($_POST['cover_letter'])) : '';
    $user_id = $_SESSION['user_id']; // Get user ID from session

    $job_id = isset($_POST['job_id']) ? (int)$_POST['job_id'] : 0; // Example: Get from a hidden field

    // Basic Validation (Add more robust validation as needed)
    if (empty($full_name) || empty($email) || empty($phone) || empty($cover_letter) || $job_id <= 0) {
        $form_error = "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $form_error = "Invalid email format.";
    } elseif (!isset($_FILES['resume']) || $_FILES['resume']['error'] == UPLOAD_ERR_NO_FILE) {
         $form_error = "Resume upload is required.";
    }

    // --- File Upload Handling ---
    $resume_path_for_db = null; // Will store the path/filename for the database
    if (empty($form_error) && isset($_FILES['resume']) && $_FILES['resume']['error'] == UPLOAD_ERR_OK) {

        $upload_dir = 'uploads/resumes/'; // Create this directory if it doesn't exist and ensure it's writable
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Create recursively with permissive permissions (adjust if needed)
        }

        $allowed_types = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']; // Allowed MIME types (PDF, DOC, DOCX)
        $max_file_size = 5 * 1024 * 1024; // 5 MB limit

        $file_tmp_path = $_FILES['resume']['tmp_name'];
        $file_name = basename($_FILES['resume']['name']); // Get original filename
        $file_size = $_FILES['resume']['size'];
        $file_type = mime_content_type($file_tmp_path); // More reliable than $_FILES['resume']['type']

        // Validate file type and size
        if (!in_array($file_type, $allowed_types)) {
            $form_error = "Invalid file type. Only PDF, DOC, and DOCX are allowed.";
        } elseif ($file_size > $max_file_size) {
            $form_error = "File is too large. Maximum size is 5MB.";
        } else {
            // Generate a unique filename to prevent overwriting
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $unique_filename = uniqid('resume_', true) . '.' . $file_extension; // e.g., resume_65f1a2b3c4d5e.pdf
            $destination_path = $upload_dir . $unique_filename;

            // Move the uploaded file
            if (move_uploaded_file($file_tmp_path, $destination_path)) {
                $resume_path_for_db = $destination_path; // Store the full path or just $unique_filename depending on preference
            } else {
                $form_error = "Error uploading resume. Please try again.";
                // Log detailed error: error_log("Resume upload failed for user $user_id: " . $_FILES['resume']['error']);
            }
        }
    } elseif (empty($form_error) && $_FILES['resume']['error'] != UPLOAD_ERR_OK && $_FILES['resume']['error'] != UPLOAD_ERR_NO_FILE) {
        // Handle other upload errors (e.g., UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE)
         $form_error = "An error occurred during file upload (Code: " . $_FILES['resume']['error'] . ").";
    }


    // --- Database Insertion (if no errors) ---
    if (empty($form_error) && $resume_path_for_db !== null) {
        try {
           
            $_SESSION['message'] = "Application submitted successfully! (DB Placeholder)";
            // Log simulated data: error_log("Simulated App Save: User $user_id, Job $job_id, Name $full_name, File $resume_path_for_db");
             header("Location: index.php"); // Redirect on success
             exit;
            // --- End Placeholder ---

        } catch (PDOException $e) {
            $form_error = "Database connection error: " . $e->getMessage(); // Show generic error to user
            // Log detailed error: error_log("PDO Exception in jobApplication.php: " . $e->getMessage());
             // Optionally: Delete the uploaded file if DB insert fails
             if ($resume_path_for_db && file_exists($resume_path_for_db)) { unlink($resume_path_for_db); }
        }
    }
    // If there was a form error after processing, set it to the main message variable
    if (!empty($form_error)) {
        $message = "<div class='message error'>" . htmlspecialchars($form_error) . "</div>";
         // Don't unset session message here if it was an error, let it be redisplayed below
    }
} // End of POST request processing

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hirely - Job Application</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Basic styling for messages */
        .message {
            padding: 10px 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid transparent;
            text-align: center;
        }
        .message { /* Default/Success */
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }
        .message.error { /* Error */
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <nav>
            <ul>
         
                <li><a href="index.php">Return to Hirely Dashboard</a></li>
            </ul>
        </nav>
        <h2>Job Application</h2>


    

      
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">

           
             <input type="hidden" name="job_id" value="<?php echo isset($_GET['job_id']) ? (int)$_GET['job_id'] : ''; ?>">
             
             <label for="job_id"> Job ID </label>
             <input type="number" id="job_id" name="job_id" placeholder="Enter Job ID applying for" value="<?php echo isset($_GET['job_id']) ? (int)$_GET['job_id'] : ''; ?>" required>
          


            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" placeholder="Enter your full name" value="<?php echo isset($full_name) ? $full_name : ''; ?>" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" value="<?php echo isset($email) ? $email : ''; ?>" required>

            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" placeholder="Enter your phone number" value="<?php echo isset($phone) ? $phone : ''; ?>" required>

            <label for="resume">Upload Resume (PDF, DOC, DOCX - Max 5MB)</label>
            <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" required>

            <label for="cover_letter">Cover Letter</label>
            <textarea id="cover_letter" name="cover_letter" placeholder="Write your cover letter here" required><?php echo isset($cover_letter) ? $cover_letter : ''; ?></textarea>

            <button type="submit">Apply Now</button>
        </form>
    </div>
</body>
</html>