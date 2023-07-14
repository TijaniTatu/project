<!DOCTYPE html>
<html>
<head>
    <title>View Prescribed Drugs</title>
</head>
<body>
    <h1>View Prescribed Drugs</h1>

    <?php
    require_once("database.php");

    session_start();

    // Check if the username is set in the session
    if (isset($_SESSION["user_name"])) {
        // Retrieve the patient's username from the URL parameter
        $patientUsername = $_GET["patientUsername"];

        // Query to retrieve the prescribed drugs for the specific patient
        $query = "SELECT p.PATIENT_USERNAME, d.DRUG_ID, p.PRESCRIPTION_DATE, p.DOSAGE, p.INSTRUCTION
        FROM prescription p
        INNER JOIN drugs d ON p.DRUG_ID = d.DRUG_ID
        WHERE p.PATIENT_USERNAME = '$patientUsername'";
        
        $result = mysqli_query($conn, $query);

        // Check if there are any prescribed drugs for the patient
        if (mysqli_num_rows($result) > 0) {
            echo "<h2>Prescribed Drugs for Patient: " . $patientUsername . "</h2>";
            echo "<table>";
            echo "<tr><th>Drug ID</th><th>Prescription date</th><th>Dosage</th><th>Instruction</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["DRUG_ID"] . "</td>";
                echo "<td>" . $row["PRESCRIPTION_DATE"] . "</td>";
                echo "<td>" . $row["DOSAGE"] . "</td>";
                echo "<td>" . $row["INSTRUCTION"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No prescribed drugs found for the patient: " . $patientUsername;
        }
    } else {
        echo "Session not found. Please login again.";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>
