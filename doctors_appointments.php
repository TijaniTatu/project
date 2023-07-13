<!DOCTYPE html>
<html>
<head>
    <title>Doctor Appointments</title>
</head>
<body>
    <?php
 require_once("database.php");
    // Start the session
    session_start();

    // Check if the doctor is logged in
    if (!isset($_SESSION["user_name"])) {
        header("Location: login.php"); // Redirect to the login page if not logged in
        exit();
    }

    $doctorUsername = $_SESSION["user_name"];

    // Retrieve the appointments for the specific doctor from the appointments table
    $appointmentsQuery = // Retrieve the appointments for the specific doctor from the appointments table
    $appointmentsQuery = "SELECT appointments.*, patients.* FROM appointments INNER JOIN patients ON appointments.PATIENT_USERNAME = patients.USER_NAME WHERE appointments.DOCTORS_USERNAME = '$doctorUsername'";
    
    $appointmentsResult = mysqli_query($conn, $appointmentsQuery);

    if (!$appointmentsResult) {
        die("Error: " . mysqli_error($conn));
    }
    ?>

    <h1>Doctor Appointments</h1>

    <table>
        <tr>
            <th>Appointment ID</th>
            <th>Patient Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>More Information</th>
        </tr>
        <?php
        // Loop through the appointments and display the information in a table
        while ($row = mysqli_fetch_assoc($appointmentsResult)) {
            $appointmentId = $row['APPOINTMENT_ID'];
            $patientName = $row['PATIENT_USERNAME'];
            $date = $row['DATE'];
            $time = $row['TIME'];

            echo "<tr>";
            echo "<td>$appointmentId</td>";
            echo "<td>$patientName</td>";
            echo "<td>$date</td>";
            echo "<td>$time</td>";
            echo "<td><a href='patient_info.php?username=$patientName'>View Details</a></td>";
            echo "<td><button onclick='confirmAttendance($appointmentId, this)'>Confirm Attendance</button></td>";
            echo "</tr>";
            
        }
        ?>
      <script>
function confirmAttendance(appointmentId, button) {
 button.style.backgroundColor = "green";
  button.style.color = "white";
  button.disabled = true; // Disable the button to prevent multiple clicks
}
</script>


    </table>

    <?php
    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>
