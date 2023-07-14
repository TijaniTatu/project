<!DOCTYPE html>
<html>
<head>
    <title>Prescription Orders</title>
</head>
<body>
    <h1>Prescription Orders</h1>

    <?php
    require_once("database.php");

    // Query to retrieve all prescriptions with patient usernames
    $query = "SELECT pr.PRESCRIPTION_ID, pr.PATIENT_USERNAME, pr.DOCTOR_USERNAME, pr.DRUG_ID, pr.PRESCRIPTION_DATE, pr.DOSAGE, pr.INSTRUCTION, pa.USER_NAME
              FROM prescription pr
              INNER JOIN patients pa ON pr.PATIENT_USERNAME = pa.USER_NAME";
    $result = mysqli_query($conn, $query);

    // Check if there are any prescriptions
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>Prescription ID</th><th>Patient Username</th><th>Doctor Username</th><th>Drug ID</th><th>Prescription Date</th><th>Dosage</th><th>Instruction</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["PRESCRIPTION_ID"] . "</td>";
            echo "<td><a href='patient_drug.php?patientUsername=" . $row["PATIENT_USERNAME"] . "'>" . $row["USER_NAME"] . "</a></td>";
            echo "<td>" . $row["DOCTOR_USERNAME"] . "</td>";
            echo "<td>" . $row["DRUG_ID"] . "</td>";
            echo "<td>" . $row["PRESCRIPTION_DATE"] . "</td>";
            echo "<td>" . $row["DOSAGE"] . "</td>";
            echo "<td>" . $row["INSTRUCTION"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No prescriptions found.";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>
