<?php

include '../Server/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';

    // Validate inputs
    if (empty($title) || empty($description)) {
        die("Title and Description are required.");
    }

    // Prepare and execute SQL statement
    $sql = "INSERT INTO advertisements (ad_image, description) VALUES (?,?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $title, $description);
        if ($stmt->execute()) {
            echo "Ad successfully added!";
            header("Location: ../Admin/ads.php");
        } 
        $stmt->close();
    } else {
        echo "Error in preparing statement.";
    }

    // Close database connection
    $conn->close();
} else {
    echo "Invalid request.";
}
?>