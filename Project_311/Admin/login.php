<?php
include("../Server/connection.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $pass = "";

    $sql = "SELECT password,name FROM admin WHERE email='$email' ";
    $db_pass = $conn->query($sql);
    if ($db_pass->num_rows > 0) {
        while ($row = $db_pass->fetch_assoc()) {
            $pass = $row["password"];
            $name = $row["name"];
            $pass = trim($pass);

        }
        if ($password == $pass) {
            header("Location: dashboard.php?name=$name");
        } else {
            echo '<h1 style="text-align: center;" >Invalid Password</h1>';
            // echo $password;
        }
    } else {
        echo '<h1 style="text-align: center;" >No Such Admin Found</h1>';

    }



}


?>