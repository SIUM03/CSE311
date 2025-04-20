<?php
include "../Server/connection.php";

if (isset($_GET['ad_id'])) {
    $ad_id = $_GET['ad_id'];
    $sql = "DELETE FROM advertisements WHERE id=$ad_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../admin/ads.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['varify_job_id'])) {
    $job_id = $_GET['varify_job_id'];
    $sql = "UPDATE Jobs SET status='varified' WHERE job_id=$job_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../admin/jobs.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];
    $sql = "DELETE FROM Jobs WHERE job_id=$job_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../admin/jobs.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['delete_varified_job_id'])) {
    $job_id = $_GET['delete_varified_job_id'];
    $sql = "DELETE FROM Jobs WHERE job_id=$job_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../admin/varified_jobs.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['active_user_id'])) {
    $id = $_GET['active_user_id'];
    $sql = "UPDATE users SET status='active' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../admin/user.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['dlt_id'])) {
    $id = $_GET['dlt_id'];
    $sql = "DELETE FROM users WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../admin/user.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$conn->close();
?>