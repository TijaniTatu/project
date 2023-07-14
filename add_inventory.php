<!DOCTYPE html>
<html>
<head>
    <title>Add Inventory</title>
    <style>
        /* ... CSS styling ... */
    </style>
</head>
<body>
    <h1>Add Inventory</h1>

    <!-- Add Inventory Form -->
    <div class="form-container">
        <h2>Add Inventory</h2>
        <form action="process_inventory.php" method="post">
            <label for="drugId">Drug ID:</label>
            <input type="text" id="drugId" name="drugId" required>
            <label for="companyId">Company ID:</label>
            <input type="text" id="companyId" name="companyId" required>
            <label for="chemicalName">Chemical Name:</label>
            <input type="text" id="chemicalName" name="chemicalName" required>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>
            <label for="purchaseDate">Purchase Date:</label>
            <input type="date" id="purchaseDate" name="purchaseDate" required>
            <label for="invoice">Invoice:</label>
            <input type="text" id="invoice" name="invoice" required>

            <div>
                <input type="submit" value="Add Inventory">
                <button type="button" onclick="location.href='inventory.php'">Cancel</button>
            </div>
        </form>
    </div>
</body>
</html>
