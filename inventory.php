<!DOCTYPE html>
<html>
<head>
    <title>Inventory Management</title>
    <style>
        /* ... CSS styling ... */
    </style>
</head>
<body>
    <h1>Inventory Management</h1>

    <?php
    require_once("database.php");

    // Function to delete an inventory record
    function deleteInventory($conn, $inventoryId) {
        $query = "DELETE FROM inventory WHERE INVENTORY_ID = '$inventoryId'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "Inventory record deleted successfully.";
        } else {
            echo "Error deleting inventory record: " . mysqli_error($conn);
        }
    }

    // Handle inventory record deletion
    if (isset($_GET['deleteInventoryId'])) {
        $deleteInventoryId = $_GET['deleteInventoryId'];
        deleteInventory($conn, $deleteInventoryId);
    }

    // Retrieve inventory data from the database
    $query = "SELECT * FROM inventory";
    $result = mysqli_query($conn, $query);

    // Check if there are any inventory records
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>Inventory ID</th><th>Drug ID</th><th>Company ID</th><th>Chemical Name</th><th>Price</th><th>Quantity</th><th>Purchase Date</th><th>Invoice</th><th>Actions</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["INVENTORY_ID"] . "</td>";
            echo "<td>" . $row["DRUG_ID"] . "</td>";
            echo "<td>" . $row["COMPANY_ID"] . "</td>";
            echo "<td>" . $row["CHEMICAL_NAME"] . "</td>";
            echo "<td>" . $row["PRICE"] . "</td>";
            echo "<td>" . $row["QUANTITY"] . "</td>";
            echo "<td>" . $row["PURCHASE_DATE"] . "</td>";
            echo "<td>" . $row["INVOICE"] . "</td>";
            echo "<td>
                      <a href='?editInventoryId=" . $row["INVENTORY_ID"] . "'>Edit</a> |
                      <a href='?deleteInventoryId=" . $row["INVENTORY_ID"] . "' onclick='return confirm(\"Are you sure you want to delete this inventory record?\")'>Delete</a>
                  </td>";
            echo "</tr>";

            // Check if the current inventory record is being edited
            if (isset($_GET['editInventoryId']) && $_GET['editInventoryId'] == $row["INVENTORY_ID"]) {
                echo "<tr>";
                echo "<td colspan='9'>";
                echo "<form id='editForm' action='process_edit_inventory.php' method='post'>";
                echo "<input type='hidden' name='editInventoryId' value='" . $row["INVENTORY_ID"] . "'>";
                echo "<label for='editChemicalName'>Chemical Name:</label>";
                echo "<input type='text' id='editChemicalName' name='editChemicalName' value='" . $row["CHEMICAL_NAME"] . "'>";
                echo "<label for='editPrice'>Price:</label>";
                echo "<input type='number' id='editPrice' name='editPrice' step='0.01' value='" . $row["PRICE"] . "'>";
                echo "<label for='editQuantity'>Quantity:</label>";
                echo "<input type='number' id='editQuantity' name='editQuantity' value='" . $row["QUANTITY"] . "'>";
                echo "<label for='editPurchaseDate'>Purchase Date:</label>";
                echo "<input type='date' id='editPurchaseDate' name='editPurchaseDate' value='" . $row["PURCHASE_DATE"] . "'>";
                echo "<label for='editInvoice'>Invoice:</label>";
                echo "<input type='text' id='editInvoice' name='editInvoice' value='" . $row["INVOICE"] . "'>";
                echo "<input type='submit' value='Save'>";
                echo "<button type='button' onclick='cancelEdit()'>Cancel</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
    } else {
        echo "<p>No inventory records found.</p>";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <!-- Add Inventory Button -->
    <div>
        <button onclick="location.href='add_inventory.php'">Add Inventory</button>
    </div>

    <script>
        function cancelEdit() {
            window.location.href = 'inventory.php';
        }
    </script>
</body>
</html>
