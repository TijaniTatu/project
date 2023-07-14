<!DOCTYPE html>
<html>
<head>
    <title>Patient Prescriptions</title>
</head>
<body>
    <h1>Patient Prescriptions</h1>

    <?php
    require_once("database.php");

    // Check if the patient username is provided in the query parameter
    if (isset($_GET["patientUsername"])) {
        $patientUsername = $_GET["patientUsername"];

        // Query to retrieve prescriptions of the specific patient
        $query = "SELECT * FROM prescription WHERE PATIENT_USERNAME = '$patientUsername'";
        $result = mysqli_query($conn, $query);

        // Check if there are any prescriptions
        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr><th>Prescription ID</th><th>Patient Username</th><th>Drug ID</th><th>Prescription Date</th><th>Dosage</th><th>Action</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["PRESCRIPTION_ID"] . "</td>";
                echo "<td>" . $row["PATIENT_USERNAME"] . "</td>";
                echo "<td>" . $row["DRUG_ID"] . "</td>";
                echo "<td>" . $row["PRESCRIPTION_DATE"] . "</td>";
                echo "<td>" . $row["DOSAGE"] . "</td>";
                echo "<td><a href='dispense_drugs.php?prescriptionId=" . $row["PRESCRIPTION_ID"] . "'>Dispense Drugs</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No prescriptions found for the patient.";
        }
    } else {
        echo "Patient username not provided.";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>
