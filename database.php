<?php
class Database
{
    private $host = "localhost";
    private $db_name = "Lab_5b";
    private $username = "root"; // Update this if needed
    private $password = "";
    public $conn;

    // Method to get the database connection
    public function getConnection()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        // Check the connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        return $this->conn;
    }
}
?>