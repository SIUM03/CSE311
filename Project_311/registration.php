<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"> 
    <title>Registration</title>
</head>
<body>
    <div class="login-container">
        <h2>Create an Account</h2>
        <form id="registration-form">
            <div class="input-container">
                <input type="text" placeholder="Name" required>
            </div>
            <div class="input-container">
                <input type="email" placeholder="Email ID" required>
            </div>
            <div class="input-container">
                <input type="password" placeholder="Password" required>
            </div>
            <div class="input-container">
                <input type="password" placeholder="Confirm Password" required>
            </div>

            <div class="account-type">
                <h4>Account Type:</h4>
                <div class="checkbox-container">
                    <label><input type="radio" name="account-type" value="employer"> Employer</label>
                    <label><input type="radio" name="account-type" value="job-seeker"> Job Seeker</label>
                </div>
            </div>

            <button type="submit" class="btn">Register</button>
            <p class="register">Already have an account? <a href="index.php">Login here</a></p>
        </form>
    </div>
</body>
</html>