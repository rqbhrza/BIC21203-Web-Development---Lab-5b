<?php
include 'database.php';
include 'user.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize inputs
    $originalMatric = $_POST['original_matric']; // Original matric to identify the user
    $newMatric = trim($_POST['matric']);        // New matric entered by the user
    $name = trim($_POST['name']);
    $role = trim($_POST['role']);

    // Validate inputs
    if (empty($newMatric) || empty($name) || empty($role)) {
        echo "All fields are required!";
        exit();
    }

    // Create database connection
    $database = new Database();
    $db = $database->getConnection();

    // Update user details
    $user = new User($db);
    $isUpdated = $user->updateUserWithMatric($originalMatric, $newMatric, $name, $role);

    if ($isUpdated) {
        echo "User updated successfully!";
        echo "<a href='display.php'>Back to User List</a>";
    } else {
        echo "Failed to update user!";
    }
} else {
    echo "Invalid request!";
}
?>