<?php
function getDbConnection() {
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'janklipord';
    
    // Create connection
    $conn = new mysqli($host, $user, $password, $database);

    // Check connection and handle errors
    if ($conn->connect_error) {
        error_log("Connection failed: " . $conn->connect_error); // Log the error for security
        die("Unable to connect to the database. Please try again later.");
    }

    return $conn;
}
?>
