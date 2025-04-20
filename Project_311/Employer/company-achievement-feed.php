<?php
include("../Server/connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $details = htmlspecialchars($_POST['details']);

    if (!empty($title) && !empty($details)) {
        $stmt = $conn->prepare("INSERT INTO achievement (title, details) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $details);
        $stmt->execute();
        $stmt->close();
    }
}

$achievements = [];
$result = $conn->query("SELECT title, details FROM achievement ORDER BY id DESC");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $achievements[] = $row['title'] . " - " . $row['details'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Achievement Feed - Job Portal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container achievement-feed-container">
        <h2>Company Achievement Feed</h2>
        <form method="POST" action="">
            <input type="text" name="title" placeholder="Achievement Title" required>
            <textarea name="details" placeholder="Details about the achievement" required></textarea>
            <button type="submit">Post Achievement</button>
        </form>
        <div class="feed">
            <h3>Recent Achievements</h3>
            <ul>
                <?php foreach ($achievements as $achievement): ?>
                    <li><?php echo $achievement; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</body>
</html>


