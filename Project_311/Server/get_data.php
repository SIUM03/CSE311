<?php
include('connection.php');

$sql = "SELECT * FROM jobs WHERE status = 'pending'";
$pending_jobs = $conn->query($sql);


$sql2 = "SELECT * FROM jobs WHERE status = 'varified'";
$varified_jobs = $conn->query($sql2);

$sql3 = "SELECT * FROM advertisements";
$ads = $conn->query($sql3);

$sql4 = "SELECT * FROM users WHERE status = 'inactive'";
$inactive_users = $conn->query($sql4);






?>