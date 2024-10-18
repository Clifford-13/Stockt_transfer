<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
        }

        h2 {
            color: #333;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
        }

        p {
            text-align: center;
            color: #d9534f; /* Red for error/success messages */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h1>Stock Management</h1>

    <?php if (isset($_GET['message'])) { ?>
        <p><?php echo htmlspecialchars($_GET['message']); ?></p> <!-- XSS prevention -->
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
            <td><?php echo htmlspecialchars($stock['item_name']); ?></td> <!-- XSS prevention -->
            <td><?php echo htmlspecialchars($stock['quantity']); ?></td> <!-- XSS prevention -->
            <td><?php echo htmlspecialchars($stock['branch_name']); ?></td> <!-- XSS prevention -->
        </tr>
        <?php } ?>
    </table>

    <h2>Add Stock</h2>
    <form action="controller.php" method="post">
        <input type="hidden" name="action" value="add_stock">
        
        <label for="branch_id">Branch:</label>
        <select name="branch_id" required>
            <?php foreach ($branches as $branch) { ?>
            <option value="<?php echo htmlspecialchars($branch['id']); ?>"><?php echo htmlspecialchars($branch['name']); ?></option> <!-- XSS prevention -->
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
            <option value="<?php echo htmlspecialchars($branch['id']); ?>"><?php echo htmlspecialchars($branch['name']); ?></option> <!-- XSS prevention -->
            <?php } ?>
        </select>

        <input type="submit" value="Transfer Stock">
    </form>

</body>
</html>