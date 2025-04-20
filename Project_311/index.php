<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hirely, one stop for jobs</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <div class="login-container">
        <h2>Welcome to Hirely!</h2>
        <p>Login to get started</p>
        <form action="User/login.php" method="POST">
        <div class="input-container">
            <input type="text" placeholder="Username" required>
            <input type="password" placeholder="Password" required>
        </div>

        <div class="buttons">
            <a href="User/index.php" class="btn seeker">Login as a Job Seeker</a>
            <a href="Employer/dashboard.html" class="btn employer">Login as an Employer</a>
        </div>
        </form>
        <p class="register"><a href="registration.php">Create an account

            </a>

    </div>

    <div></div>
    <p class="admin-login"><a href="Admin/admin_login.php">Adminstrator login</a></p>
    </div>
</body>

</html>