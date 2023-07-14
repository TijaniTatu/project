<!DOCTYPE html>
<html>
<head>
    <title>Write Prescription</title>
</head>
<body>
<h1>Write Prescription</h1>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input type="hidden" name="patientUsername" value="<?php echo $patientUsername; ?>">
    <label for="drugId">Drug ID:</label>
    <select name="drugId" id="drugId">
        <?php
        require_once("database.php");
        $combo = "";
        $sql = "SELECT DRUG_ID FROM drugs";

        if ($result = $conn->query($sql)) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $drugId = $row['DRUG_ID'];
                    $combo .= "<option value=\"$drugId\">$drugId</option>";
                }
            } else {
                echo "No drugs found.";
            }
            $result->free();
        }
            
        

        echo $combo;
        ?>
    </select>
    <br>
    <label for="dosage">Dosage:</label>
    <input type="text" name="dosage" id="dosage">
    <br>
    <label for="instruction">Instruction:</label>
    <textarea name="instruction" id="instruction" rows="4" cols="50"></textarea>
    <br>
    <input type="submit" value="Submit">
</form>

<?php
require_once("database.php");

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $patientUsername = $_POST["patientUsername"];

    session_start();
    $doctorUsername = $_SESSION["user_name"]; // Replace with your session variable or authentication mechanism

    $drugId = isset($_POST["drugId"]) ? $_POST["drugId"] : "";
    $prescriptionDate = date("Y-m-d");
    $dosage = isset($_POST["dosage"]) ? $_POST["dosage"] : "";
    $instruction = isset($_POST["instruction"]) ? $_POST["instruction"] : "";

    // Check if the drug ID exists in the drugs table
    $drugQuery = "SELECT * FROM drugs WHERE DRUG_ID = '$drugId'";
    $drugResult = mysqli_query($conn, $drugQuery);

    if (mysqli_num_rows($drugResult) > 0) {
        // Perform the prescription insertion query
        $insertQuery = "INSERT INTO prescription (PATIENT_USERNAME, DOCTOR_USERNAME, DRUG_ID, PRESCRIPTION_DATE, DOSAGE, INSTRUCTION) 
        VALUES ('$patientUsername', '$doctorUsername', '$drugId', '$prescriptionDate', '$dosage', '$instruction')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            echo "<p>Prescription written successfully!</p>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: Drug ID not found.";
    }
}
?>
<?php
// Close the database connection
mysqli_close($conn);
?>
</body>
</html>
