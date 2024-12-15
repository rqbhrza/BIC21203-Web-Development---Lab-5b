<?php
session_start(); // Start session

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

include 'database.php';
include 'user.php';

// Create database connection
$database = new Database();
$db = $database->getConnection();

// Create User object
$user = new User($db);
$result = $user->getUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Users</title>
</head>
<body>
    <h1>User List</h1>
    <table border="1" cellpadding="10" cellspacing="3">
        <thead>
            <tr>
                <th>Matric</th>
                <th>Name</th>
                <th>Role</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['matric']) ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['role']) ?></td>
                        <td><a href="update_form.php?matric=<?= urlencode($row['matric']) ?>">Update</a></td>
                        <td><a href="delete.php?matric=<?= urlencode($row['matric']) ?>" onclick="return confirm('Are you sure?')">Delete</a></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5">No users found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</html>