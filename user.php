<?php
class User
{
    private $conn;

    // Constructor to initialize the database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function updateUserWithMatric($originalMatric, $newMatric, $name, $role) {
        $query = "UPDATE users SET matric = ?, name = ?, role = ? WHERE matric = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $newMatric, $name, $role, $originalMatric);
    
        return $stmt->execute();
    }
    

    // Create a new user
    public function createUser($matric, $name, $password, $role)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (matric, name, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssss", $matric, $name, $password, $role);
            return $stmt->execute();
        }
        return false;
    }

    // Read all users
    public function getUsers()
    {
        $sql = "SELECT matric, name, role FROM users";
        return $this->conn->query($sql);
    }

    // Read a single user by matric
    public function getUser($matric)
    {
        $sql = "SELECT * FROM users WHERE matric = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $matric);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Delete a user by matric
    public function deleteUser($matric)
    {
        $sql = "DELETE FROM users WHERE matric = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $matric);
        return $stmt->execute();
    }
}
?>