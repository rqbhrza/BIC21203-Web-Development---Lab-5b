<?php
include 'database.php';
include 'user.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve the matric value from the GET request
    $matric = $_GET['matric'];

    // Create an instance of the Database class and get the connection
    $database = new Database();
    $db = $database->getConnection();

    // Create an instance of the User class
    $user = new User($db);

    // Perform the delete operation
    if ($user->deleteUser($matric)) {
        // Redirect back to the updated user list
        header("Location: display.php");
        exit(); // Stop further execution
    } else {
        // Handle failure (optional)
        echo "Failed to delete user.";
        echo "<br><a href='display.php'>Back to User List</a>";
    }

    // Close the connection
    $db->close();
}
?>