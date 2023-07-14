<!DOCTYPE html>
<html>
<head>
    <title>Patient Information</title>
</head>
<body>
    <?php
    require_once("database.php");

    // Retrieve the patient username from the URL parameter
    $patientUsername = $_GET['username'];

    // Query to retrieve the patient information based on the provided username
    $patientQuery = "SELECT * FROM patients WHERE USER_NAME = '$patientUsername'";
    $patientResult = mysqli_query($conn, $patientQuery);

    if (!$patientResult) {
        die("Error: " . mysqli_error($conn));
    }

    // Check if the patient exists
    if (mysqli_num_rows($patientResult) > 0) {
        $patientData = mysqli_fetch_assoc($patientResult);
        $patientName = $patientData['NAME'];
        $patientAge = $patientData['AGE'];
        $patientAddress = $patientData['ADDRESS'];
        $patientEmail = $patientData['EMAIL_ADDRESS'];
        $patientPhone = $patientData['PHONE_NUMBER'];
       
        // Display the patient information
        echo "<h1>Patient Information</h1>";
        echo "<p><strong>Username:</strong> $patientUsername</p>";
        echo "<p><strong>Name:</strong> $patientName</p>";
        echo "<p><strong>Age:</strong> $patientAge</p>";
        echo "<p><strong>Address:</strong> $patientAddress</p>";
        echo "<p><strong>Email:</strong> $patientEmail</p>";
        echo "<p><strong>Phone number:</strong> $patientPhone</p>";

        // Add the "Write Prescription" button
        echo "<form action='write_prescription.php' method='post'>";
        echo "<input type='hidden' name='patientUsername' value='$patientUsername'>";
        echo "<input type='submit' value='Write Prescription'>";
        echo "</form>";
    } else {
        echo "<p>Patient not found.</p>";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>
