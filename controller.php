<?php
include 'stock.php';
include 'branch.php';

// Add Stock Handler
if (isset($_POST['action']) && $_POST['action'] == 'add_stock') {
    $branch_id = $_POST['branch_id'];
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];

    $success = addStock($branch_id, $item_name, $quantity);
    if ($success) {
        header("Location: index.php?message=Stock added successfully");
    } else {
        header("Location: index.php?message=Failed to add stock");
    }
}

// Transfer Stock Handler
if (isset($_POST['action']) && $_POST['action'] == 'transfer_stock') {
    $stock_id = $_POST['stock_id'];
    $new_branch_id = $_POST['new_branch_id'];

    $success = transferStock($stock_id, $new_branch_id);
    if ($success) {
        header("Location: index.php?message=Stock transferred successfully");
    } else {
        header("Location: index.php?message=Failed to transfer stock");
    }
}
?>
