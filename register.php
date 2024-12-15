<?php
include 'database.php';
include 'user.php';

$database = new Database();
$db = $database-> getConnection();
$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (!empty($matric) && !empty($name) && !empty($password) && !empty($role)) {
        if ($user->createUser($matric, $name, $password, $role)) {
            echo "<p>Registration successful!</p>";
        } else {
            echo "<p>Failed to register. Please try again.</p>";
        }
    } else {
        echo "<p>All fields are required!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Register User</h1>
    <form method="POST">
        <label>Matric:</label>
        <input type="text" name="matric" required><br>
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <label>Role:</label>
        <select name="role" required>
            <option value="">Please Select</option>
            <option value="lecturer">Lecturer</option>
            <option value="student">Student</option>
        </select><br>
        <button type="submit">Register</button>
        <p>Have an account? <a href="login.php">Login</a> here.</p>
    </form>
</body>
</html>