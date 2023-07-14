<?php
require_once("database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the edited drug data from the form
    $editDrugId = $_POST['editDrugId'];
    $editChemicalName = $_POST['editChemicalName'];
    $editPrice = $_POST['editPrice'];

    // Update the drug record in the database
    $query = "UPDATE drugs SET CHEMICAL_NAME = '$editChemicalName', PRICE = '$editPrice' WHERE DRUG_ID = '$editDrugId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Drug updated successfully.";
        echo "<br>";
            echo "<a href='drug_management.php'>Go back to drug management</a>";
    } else {
        echo "Error updating drug: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
