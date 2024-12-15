<?php
session_start();
// Check if the login status is set in the query string
$loginStatus = isset($_GET['status']) ? $_GET['status'] : 'failed';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $loginStatus === 'success' ? 'Login Successful' : 'Login Failed'; ?></title>
</head>
<body>
    <?php if ($loginStatus === 'success'): ?>
        <h1>Login Successful</h1>
        <p>Welcome back! You are now logged in.</p>
    <?php else: ?>
        <h1>Login Unsuccessful</h1>
        <p>Invalid matric number or password. Please <a href="login.php">Login</a> again.</p>
        <p>Don't have an account? <a href="register.php">Register</a> here.</p>
    <?php endif; ?>
</body>
</html>