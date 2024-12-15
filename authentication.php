<?php
// Start session
session_start();

include 'database.php';
include 'user.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matric = trim($_POST['matric']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (!empty($matric) && !empty($password)) {
        // Create database connection
        $database = new Database();
        $db = $database->getConnection();

        // Fetch user details
        $user = new User($db);
        $userDetails = $user->getUser($matric);

        // Validate user credentials
        if ($userDetails && password_verify($password, $userDetails['password'])) {
            // Login successful - set session
            $_SESSION['user'] = $userDetails;
            header("Location: login_status.php?status=success");
        } else {
            // Login failed
            header("Location: login_status.php?status=failed");
        }
    } else {
        // Missing matric or password
        header("Location: login_status.php?status=failed");
    }
} else {
    // Redirect to login page if accessed directly
    header("Location: login.php");
}