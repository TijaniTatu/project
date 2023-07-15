<?php
require_once("database.php");

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the prescription ID and quantity from the form data
    $prescriptionId = $_POST["prescriptionId"];
    $quantity = $_POST["quantity"];

    // Retrieve the drug ID from the prescription
    $query = "SELECT DRUG_ID FROM prescription WHERE PRESCRIPTION_ID = '$prescriptionId'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $drugId = $row["DRUG_ID"];

        // Check if the drug exists in the inventory
        $inventoryQuery = "SELECT QUANTITY FROM inventory WHERE DRUG_ID = '$drugId'";
        $inventoryResult = mysqli_query($conn, $inventoryQuery);

        if (mysqli_num_rows($inventoryResult) === 1) {
            $inventoryRow = mysqli_fetch_assoc($inventoryResult);
            $currentQuantity = $inventoryRow["QUANTITY"];

            if ($currentQuantity >= $quantity) {
                // Update the quantity in the inventory
                $updatedQuantity = $currentQuantity - $quantity;
                $updateQuery = "UPDATE inventory SET QUANTITY = '$updatedQuantity' WHERE DRUG_ID = '$drugId'";
                $updateResult = mysqli_query($conn, $updateQuery);

                if ($updateResult) {
                    // Insert the dispense record into dispensed_drugs table
                    $insertQuery = "INSERT INTO dispensed_drugs (PRESCRIPTION_ID, DRUG_ID, QUANTITY, DATE_DISPENSED)
                                    VALUES ('$prescriptionId', '$drugId', '$quantity', CURDATE())";
                    $insertResult = mysqli_query($conn, $insertQuery);

                    if ($insertResult) {
                        echo "<p>Dispensed $quantity units of drug $drugId successfully.</p>";
                        echo "<br>";
                        echo "<a href='patient_drug.php'>Go back to patient prescription</a>";
                    } else {
                        echo "Error inserting the dispense record.";
                        echo "<br>";
                        echo "<a href='patient_drug.php'>Go back to patient prescription</a>";
                    }
                } else {
                    echo "Error updating the inventory.";
                    echo "<br>";
                    echo "<a href='patient_drug.php'>Go back to patient prescription</a>";
                }
            } else {
                echo "Insufficient quantity in the inventory.";
                echo "<br>";
                echo "<a href='patient_drug.php'>Go back to patient prescription</a>";
            }
        } else {
            echo "Drug not found in the inventory.";
            echo "<br>";
            echo "<a href='patient_drug.php'>Go back to patient prescription</a>";
        }
    } else {
        echo "Prescription not found.";
        echo "<br>";
        echo "<a href='patient_drug.php'>Go back to patient prescription</a>";
    }
}



// Retrieve dispense history from the dispensed_drugs table
$query = "SELECT dd.PRESCRIPTION_ID, dd.DRUG_ID, d.CHEMICAL_NAME, dd.QUANTITY, dd.DATE_DISPENSED
          FROM dispensed_drugs dd
          INNER JOIN drugs d ON dd.DRUG_ID = d.DRUG_ID
          ORDER BY dd.DATE_DISPENSED DESC";
$result = mysqli_query($conn, $query);

// Check if there are any dispense records
if (mysqli_num_rows($result) > 0) {
    echo "<h2>Dispense History</h2>"; // Title for the table

    echo "<table>";
    echo "<tr><th>Prescription ID</th><th>Drug ID</th><th>Chemical Name</th><th>Quantity</th><th>Date Dispensed</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["PRESCRIPTION_ID"] . "</td>";
        echo "<td>" . $row["DRUG_ID"] . "</td>";
        echo "<td>" . $row["CHEMICAL_NAME"] . "</td>";
        echo "<td>" . $row["QUANTITY"] . "</td>";
        echo "<td>" . $row["DATE_DISPENSED"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No dispense history found.</p>";
}

// Close the database connection
mysqli_close($conn);
?>


