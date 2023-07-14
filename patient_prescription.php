<!DOCTYPE html>
<html>
<head>
    <title>Prescription History</title>
</head>
<body>
    <h1>Prescription History</h1>

    <?php
    require_once("database.php");

    session_start();

    // Check if the patient username is set in the session
    if (isset($_SESSION["user_name"])) {
        $patientUsername = $_SESSION["user_name"];

        // Query to retrieve the prescriptions for the specific patient
        $query = "SELECT * FROM prescription WHERE PATIENT_USERNAME = '$patientUsername'";
        $result = mysqli_query($conn, $query);

        // Check if there are any prescriptions
        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr><th>Prescription ID</th><th>Doctor Username</th><th>Drug ID</th><th>Prescription Date</th><th>Dosage</th><th>Instruction</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["PRESCRIPTION_ID"] . "</td>";
                echo "<td>" . $row["DOCTOR_USERNAME"] . "</td>";
                echo "<td>" . $row["DRUG_ID"] . "</td>";
                echo "<td>" . $row["PRESCRIPTION_DATE"] . "</td>";
                echo "<td>" . $row["DOSAGE"] . "</td>";
                echo "<td>" . $row["INSTRUCTION"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No prescriptions found for the patient.";
        }
    } else {
        echo "Patient session not found. Please login again.";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>
