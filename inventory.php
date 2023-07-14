<!-- Display Inventory Table -->
<?php
require_once("database.php");

// Retrieve inventory data from the database
$query = "SELECT * FROM inventory";
$result = mysqli_query($conn, $query);

// Check if there are any inventory records
if (mysqli_num_rows($result) > 0) {
    echo "<h2>Inventory List</h2>"; // Title for the table

    echo "<table>";
    echo "<tr><th>Inventory ID</th><th>Drug ID</th><th>Company ID</th><th>Chemical Name</th><th>Price</th><th>Quantity</th><th>Purchase Date</th><th>Invoice</th><th>Actions</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td id='inventoryId_" . $row["INVENTORY_ID"] . "'>" . $row["INVENTORY_ID"] . "</td>";
        echo "<td id='drugId_" . $row["INVENTORY_ID"] . "'>" . $row["DRUG_ID"] . "</td>";
        echo "<td id='companyId_" . $row["INVENTORY_ID"] . "'>" . $row["COMPANY_ID"] . "</td>";
        echo "<td id='chemicalName_" . $row["INVENTORY_ID"] . "'>" . $row["CHEMICAL_NAME"] . "</td>";
        echo "<td id='price_" . $row["INVENTORY_ID"] . "'>" . $row["PRICE"] . "</td>";
        echo "<td id='quantity_" . $row["INVENTORY_ID"] . "'>" . $row["QUANTITY"] . "</td>";
        echo "<td id='purchaseDate_" . $row["INVENTORY_ID"] . "'>" . $row["PURCHASE_DATE"] . "</td>";
        echo "<td id='invoice_" . $row["INVENTORY_ID"] . "'>" . $row["INVOICE"] . "</td>";
        echo "<td id='actionButtons_" . $row["INVENTORY_ID"] . "' class='action-buttons'>
            <button onclick='editRecord(" . $row["INVENTORY_ID"] . ")'>Edit</button>
            <button onclick='deleteRecord(" . $row["INVENTORY_ID"] . ")'>Delete</button>
        </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No inventory records found.</p>";
}

// Close the database connection
mysqli_close($conn);
?>

<!-- Add Button -->
<div class="add-button-container">
    <button onclick="location.href='add_inventory.php'">Add Inventory</button>
</div>

<script>
    function editRecord(inventoryId) {
        // Get the current field values
        var chemicalName = document.getElementById("chemicalName_" + inventoryId).textContent;
        var price = document.getElementById("price_" + inventoryId).textContent;
        var quantity = document.getElementById("quantity_" + inventoryId).textContent;
        var purchaseDate = document.getElementById("purchaseDate_" + inventoryId).textContent;
        var invoice = document.getElementById("invoice_" + inventoryId).textContent;

        // Create input fields for editing
        var chemicalNameInput = document.createElement("input");
        chemicalNameInput.type = "text";
        chemicalNameInput.value = chemicalName;

        var priceInput = document.createElement("input");
        priceInput.type = "number";
        priceInput.step = "0.01";
        priceInput.value = price;

        var quantityInput = document.createElement("input");
        quantityInput.type = "number";
        quantityInput.value = quantity;

        var purchaseDateInput = document.createElement("input");
        purchaseDateInput.type = "date";
        purchaseDateInput.value = purchaseDate;

        var invoiceInput = document.createElement("input");
        invoiceInput.type = "text";
        invoiceInput.value = invoice;

        // Create the save button
        var saveButton = document.createElement("button");
        saveButton.innerHTML = "Save";
        saveButton.onclick = function() {
            saveChanges(inventoryId);
        };

        // Create the cancel button
        var cancelButton = document.createElement("button");
        cancelButton.innerHTML = "Cancel";
        cancelButton.onclick = function() {
            // Restore the original field values
            document.getElementById("chemicalName_" + inventoryId).innerHTML = chemicalName;
            document.getElementById("price_" + inventoryId).innerHTML = price;
            document.getElementById("quantity_" + inventoryId).innerHTML = quantity;
            document.getElementById("purchaseDate_" + inventoryId).innerHTML = purchaseDate;
            document.getElementById("invoice_" + inventoryId).innerHTML = invoice;

            // Restore the edit button
            restoreEditButton(inventoryId);
        };

        // Replace the cell contents with the input fields
        document.getElementById("chemicalName_" + inventoryId).innerHTML = "";
        document.getElementById("chemicalName_" + inventoryId).appendChild(chemicalNameInput);

        document.getElementById("price_" + inventoryId).innerHTML = "";
        document.getElementById("price_" + inventoryId).appendChild(priceInput);

document.getElementById("quantity_" + inventoryId).innerHTML = "";
document.getElementById("quantity_" + inventoryId).appendChild(quantityInput);

document.getElementById("purchaseDate_" + inventoryId).innerHTML = "";
document.getElementById("purchaseDate_" + inventoryId).appendChild(purchaseDateInput);

document.getElementById("invoice_" + inventoryId).innerHTML = "";
document.getElementById("invoice_" + inventoryId).appendChild(invoiceInput);

// Replace the edit button with save and cancel buttons
document.getElementById("actionButtons_" + inventoryId).innerHTML = "";
document.getElementById("actionButtons_" + inventoryId).appendChild(saveButton);
document.getElementById("actionButtons_" + inventoryId).appendChild(cancelButton);
}

function restoreEditButton(inventoryId) {
// Restore the edit button
var editButton = document.createElement("button");
editButton.innerHTML = "Edit";
editButton.onclick = function() {
    editRecord(inventoryId);
};

// Replace the save and cancel buttons with the edit button
document.getElementById("actionButtons_" + inventoryId).innerHTML = "";
document.getElementById("actionButtons_" + inventoryId).appendChild(editButton);
}

function deleteRecord(inventoryId) {
if (confirm("Are you sure you want to delete this record?")) {
    window.location.href = "process_delete_inventory.php?inventoryId=" + inventoryId;
}
}

function saveChanges(inventoryId) {
// Get the updated field values
var updatedChemicalName = document.getElementById("chemicalNameInput_" + inventoryId).value;
var updatedPrice = document.getElementById("priceInput_" + inventoryId).value;
var updatedQuantity = document.getElementById("quantityInput_" + inventoryId).value;
var updatedPurchaseDate = document.getElementById("purchaseDateInput_" + inventoryId).value;
var updatedInvoice = document.getElementById("invoiceInput_" + inventoryId).value;

// Create an AJAX request
var xhttp = new XMLHttpRequest();

// Define the request parameters
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        // Update the display with the new values
        document.getElementById("chemicalName_" + inventoryId).innerHTML = updatedChemicalName;
        document.getElementById("price_" + inventoryId).innerHTML = updatedPrice;
        document.getElementById("quantity_" + inventoryId).innerHTML = updatedQuantity;
        document.getElementById("purchaseDate_" + inventoryId).innerHTML = updatedPurchaseDate;
        document.getElementById("invoice_" + inventoryId).innerHTML = updatedInvoice;

        // Restore the edit button
        restoreEditButton(inventoryId);
    }
};

// Set the request URL and method
xhttp.open("POST", "process_edit_inventory.php", true);

// Set the request headers (if needed)
xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

// Construct the request body
var requestBody = "inventoryId=" + inventoryId +
    "&chemicalName=" + encodeURIComponent(updatedChemicalName) +
    "&price=" + encodeURIComponent(updatedPrice) +
    "&quantity=" + encodeURIComponent(updatedQuantity) +
    "&purchaseDate=" + encodeURIComponent(updatedPurchaseDate) +
    "&invoice=" + encodeURIComponent(updatedInvoice);

// Send the request
xhttp.send(requestBody);
}
</script>

