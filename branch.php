<?php
include_once 'database.php';

// Get all branches
function getBranches() {
    $conn = getDbConnection();
    $query = "SELECT * FROM branches";
    
    $result = $conn->query($query);

    if ($result) {
        $branches = $result->fetch_all(MYSQLI_ASSOC); // Fetch branches as associative array
        $result->free(); // Free the result set
    } else {
        error_log("Database error: " . $conn->error); // Log the error
        $branches = []; // Return an empty array on failure
    }

    $conn->close();
    return $branches;
}
?>
