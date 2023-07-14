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
                    echo "<p>Dispensed $quantity units of drug $drugId successfully.</p>";
                    echo "<br>";
            echo "<a href='patient_drug.php'>Go back to patient prescription</a>";
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

// Close the database connection
mysqli_close($conn);
?>
