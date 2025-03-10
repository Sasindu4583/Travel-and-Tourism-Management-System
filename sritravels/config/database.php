<?php
// config/database.php
// Define a class for handling database connections
class Database {
    // Private properties for database connection details
    private $host = 'localhost'; // Database host (server location)
    private $username = 'root'; // Database username
    private $password = ''; // Database password no
    private $database = 'tourism_management'; // Database name
    public $conn; // Variable to hold the connection object

    // Constructor to initialize database connection when an object is created
    public function __construct() {
        // Create a new MySQLi connection using the provided credentials
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        // Check if the connection failed
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error); // Stop execution if connection fails
        }
    }

    // Function to return the database connection object
    public function getConnection() {
        return $this->conn;
    }

    // Function to close the database connection
    public function closeConnection() {
        $this->conn->close();
    }
}
?>