<?php

$db_server = "127.0.0.1:3308";
$db_user = "root";
$password = "";
$db_name = "hirely";

$conn = mysqli_connect(
    $db_server,
    $db_user,
    $password,
    $db_name
);

if (!$conn)
    echo "Failed to connect to the database";
else
    // echo "Connected to the database";
// mysqli_select_db($conn, $db_name);

?>