<?php
include_once 'database.php';

// Get all stocks
function getStocks() {
    $conn = getDbConnection();
    $query = "SELECT stocks.id, branches.name AS branch_name, stocks.item_name, stocks.quantity 
              FROM stocks 
              JOIN branches ON stocks.branch_id = branches.id";
    
    $result = $conn->query($query);

    if ($result) {
        $stocks = $result->fetch_all(MYSQLI_ASSOC); // Fetch stocks as associative array
        $result->free(); // Free the result set
    } else {
        error_log("Database error: " . $conn->error); // Log the error
        $stocks = []; // Return an empty array on failure
    }

    $conn->close();
    return $stocks;
}

// Add a new stock
function addStock($branch_id, $item_name, $quantity) {
    $conn = getDbConnection();
    
    // Use prepared statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO stocks (branch_id, item_name, quantity) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $branch_id, $item_name, $quantity);
    
    $success = $stmt->execute(); // Execute the statement
    if (!$success) {
        error_log("Database error: " . $stmt->error); // Log the error
    }
    
    $stmt->close(); // Close the statement
    $conn->close();
    
    return $success; // Return true on success, false on failure
}

// Transfer stock between branches
function transferStock($stock_id, $new_branch_id) {
    $conn = getDbConnection();
    
    // Use prepared statement to avoid SQL injection
    $stmt = $conn->prepare("UPDATE stocks SET branch_id = ? WHERE id = ?");
    $stmt->bind_param("ii", $new_branch_id, $stock_id);
    
    $success = $stmt->execute(); // Execute the statement
    if (!$success) {
        error_log("Database error: " . $stmt->error); // Log the error
    }

    $stmt->close(); // Close the statement
    $conn->close();
    
    return $success; // Return true on success, false on failure
}
?>
