<?php
require_once("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted data
    $inventoryId = $_POST["inventoryId"];
    $chemicalName = $_POST["chemicalName"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $purchaseDate = $_POST["purchaseDate"];
    $invoice = $_POST["invoice"];

    // Perform the update operation
    $query = "UPDATE inventory SET
        CHEMICAL_NAME = '$chemicalName',
        PRICE = '$price',
        QUANTITY = '$quantity',
        PURCHASE_DATE = '$purchaseDate',
        INVOICE = '$invoice'
        WHERE INVENTORY_ID = '$inventoryId'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        // The update was successful
        echo "Inventory record updated successfully.";
        echo "<br>";
        echo "<a href='inventory.php'>Go back to Inventory</a>";
    } else {
        // An error occurred during the update
        echo "Error updating inventory record: " . mysqli_error($conn);
        echo "<br>";
        echo "<a href='inventory.php'>Go back to Inventory</a>";
    }
}

// Close the database connection
mysqli_close($conn);
?>
