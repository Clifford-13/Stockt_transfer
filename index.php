<?php
include 'stock.php';
include 'branch.php';

$stocks = getStocks();
$branches = getBranches();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto 20px auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        p {
            text-align: center;
            color: #d9534f; /* For error/success messages */
        }
    </style>
</head>
<body>

    <h1>Stock Management</h1>

    <?php if (isset($_GET['message'])) { ?>
        <p><?php echo htmlspecialchars($_GET['message']); ?></p>
    <?php } ?>

    <h2>Current Stocks</h2>
    <table>
        <tr>
            <th>Item Name</th>
            <th>Quantity</th>
            <th>Branch</th>
        </tr>
        <?php foreach ($stocks as $stock) { ?>
        <tr>
            <td><?php echo htmlspecialchars($stock['item_name']); ?></td>
            <td><?php echo htmlspecialchars($stock['quantity']); ?></td>
            <td><?php echo htmlspecialchars($stock['branch_name']); ?></td>
        </tr>
        <?php } ?>
    </table>

    <h2>Add Stock</h2>
    <form action="controller.php" method="post">
        <input type="hidden" name="action" value="add_stock">
        
        <label for="branch_id">Branch:</label>
        <select name="branch_id" required>
            <?php foreach ($branches as $branch) { ?>
            <option value="<?php echo htmlspecialchars($branch['id']); ?>"><?php echo htmlspecialchars($branch['name']); ?></option>
            <?php } ?>
        </select>

        <label for="item_name">Item Name:</label>
        <input type="text" name="item_name" required>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" required>

        <input type="submit" value="Add Stock">
    </form>

    <h2>Transfer Stock</h2>
    <form action="controller.php" method="post">
        <input type="hidden" name="action" value="transfer_stock">

        <label for="stock_id">Stock ID:</label>
        <input type="number" name="stock_id" required>

        <label for="new_branch_id">New Branch:</label>
        <select name="new_branch_id" required>
            <?php foreach ($branches as $branch) { ?>
            <option value="<?php echo htmlspecialchars($branch['id']); ?>"><?php echo htmlspecialchars($branch['name']); ?></option>
            <?php } ?>
        </select>

        <input type="submit" value="Transfer Stock">
    </form>

</body>
</html>
