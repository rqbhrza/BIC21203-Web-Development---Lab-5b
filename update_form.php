<?php
session_start(); // Start session

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

include 'database.php';
include 'user.php';

// Check if matric is provided in the GET request
if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];

    // Create database connection
    $database = new Database();
    $db = $database->getConnection();

    // Fetch user details
    $user = new User($db);
    $userDetails = $user->getUser($matric);

    // Check if user exists
    if (!$userDetails) {
        echo "User not found!";
        exit();
    }
} else {
    echo "No matric provided!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>
<body>
    <h1>Update User</h1>
    <form action="update.php" method="post">
        <input type="hidden" name="original_matric" value="<?= htmlspecialchars($userDetails['matric']) ?>">
        <label for="matric">Matric Number:</label>
        <input type="text" id="matric" name="matric" value="<?= htmlspecialchars($userDetails['matric']) ?>" required><br>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($userDetails['name']) ?>" required><br>
        <label for="role">Role:</label>
        <select name="role" id="role" required>
            <option value="">Please select</option>
            <option value="lecturer" <?= $userDetails['role'] === 'lecturer' ? 'selected' : '' ?>>Lecturer</option>
            <option value="student" <?= $userDetails['role'] === 'student' ? 'selected' : '' ?>>Student</option>
        </select><br>
        <input type="submit" value="Update">
        <button type="button" onclick="window.location.href='display.php'">Cancel</button>
    </form>
</body>
</html>