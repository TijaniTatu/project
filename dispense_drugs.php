<!DOCTYPE html>
<html>
<head>
    <title>Dispense Drugs</title>
</head>
<body>
    <h1>Dispense Drugs</h1>

    <?php
    require_once("database.php");

    // Check if the prescription ID is provided in the query parameter
    if (isset($_GET["prescriptionId"])) {
        $prescriptionId = $_GET["prescriptionId"];

        // Retrieve prescription information
        $query = "SELECT * FROM prescription WHERE PRESCRIPTION_ID = '$prescriptionId'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) === 1) {
            $prescription = mysqli_fetch_assoc($result);

            // Display prescription details
            echo "<h2>Prescription Details</h2>";
            echo "<p><strong>Prescription ID:</strong> " . $prescription["PRESCRIPTION_ID"] . "</p>";
            echo "<p><strong>Patient Username:</strong> " . $prescription["PATIENT_USERNAME"] . "</p>";
            echo "<p><strong>Doctor Username:</strong> " . $prescription["DOCTOR_USERNAME"] . "</p>";
            echo "<p><strong>Drug ID:</strong> " . $prescription["DRUG_ID"] . "</p>";
            echo "<p><strong>Prescription Date:</strong> " . $prescription["PRESCRIPTION_DATE"] . "</p>";
            echo "<p><strong>Dosage:</strong> " . $prescription["DOSAGE"] . "</p>";
            echo "<p><strong>Instruction:</strong> " . $prescription["INSTRUCTION"] . "</p>";

            // Form to enter the quantity being dispatched
            echo "<h2>Dispense Drugs</h2>";
            echo "<form action='process_dispense.php' method='post'>";
            echo "<input type='hidden' name='prescriptionId' value='$prescriptionId'>";
            echo "<label for='quantity'>Quantity:</label>";
            echo "<input type='number' name='quantity' id='quantity' min='1' required>";
            echo "<input type='submit' value='Dispense'>";
            echo "</form>";
        } else {
            echo "Invalid prescription ID.";
        }
    } else {
        echo "Prescription ID not provided.";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>
