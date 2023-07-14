<!DOCTYPE html>
<html>
<head>
    <title>Doctor Dashboard - Patients</title>
</head>
<body>
    <h1>Doctor Dashboard - Patients</h1>

    <?php
    require_once("database.php");

    session_start();

    // Check if the username is set in the session
    if (isset($_SESSION["user_name"])) {
        $doctorUsername = $_SESSION["user_name"];

        // Retrieve patients for the specific doctor from the database
        $query = "SELECT p.USER_NAME, p.NAME, p.AGE, p.EMAIL_ADDRESS, p.PHONE_NUMBER 
                  FROM patients p
                  INNER JOIN appointments a ON p.USER_NAME = a.PATIENT_USERNAME
                  WHERE a.DOCTORS_USERNAME = '$doctorUsername'";
        $result = mysqli_query($conn, $query);

        // Check if there are any patients
        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr><th>Username</th><th>Name</th><th>Age</th><th>Email Address</th><th>Phone Number</th><th>Action</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["USER_NAME"] . "</td>";
                echo "<td>" . $row["NAME"] . "</td>";
                echo "<td>" . $row["AGE"] . "</td>";
                echo "<td>" . $row["EMAIL_ADDRESS"] . "</td>";
                echo "<td>" . $row["PHONE_NUMBER"] . "</td>";
                echo "<td><a href='write_prescription.php?patientUsername=" . $row["USER_NAME"] . "'>Write Prescription</a></td>";
                echo "<td><a href='view_prescribed_history.php?patientUsername=" . $row["USER_NAME"] . "'>View Prescribed History</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No patients found.";
        }
    } else {
        echo "Session not found. Please login again.";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>
