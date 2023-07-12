<?php
// appointment_request.php
 // Display the appointment request form


// Make sure the doctor ID is provided
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['doctor_id'])) {
    // Retrieve the doctor ID from the URL parameter
    $doctorId = $_GET['doctor_id'];

     // Display the appointment request form
 echo "<h3>Request Appointment</h3>";
 echo "<form method='POST' action='appointment_request.php?doctor_id=$doctorId'>";
 echo "<label for='patient_name'>Your Name:</label>";
 echo "<input type='text' id='patient_name' name='patient_name' required><br>";
 echo "<label for='patient_email'>Your Email:</label>";
 echo "<input type='email' id='patient_email' name='patient_email' required><br>";
 echo "<label for='appointment_date'>Preferred Date:</label>";
 echo "<input type='date' id='appointment_date' name='appointment_date' required><br>";
 echo "<label for='appointment_time'>Preferred Time:</label>";
 echo "<input type='time' id='appointment_time' name='appointment_time' required><br>";
 echo "<input type='submit' value='Submit'>";
    // Retrieve the patient's details and appointment information from the form data
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve and sanitize the patient's details and appointment information
        $patientName = $_POST['patient_name'];
        $patientEmail = $_POST['patient_email'];
        $appointmentDate = $_POST['appointment_date'];
        $appointmentTime = $_POST['appointment_time'];

        // Perform your database query to insert the appointment details
        require_once("database.php");

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO appointments (DOCTOR_ID, PATIENT_NAME, PATIENT_EMAIL, DATE, TIME) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $doctorId, $patientName, $patientEmail, $appointmentDate, $appointmentTime);

        // Execute the statement
        if ($stmt->execute()) {
            // Display a success message
            echo "<h3>Appointment Request Sent</h3>";
            echo "<p>Thank you, $patientName! Your appointment request with doctor $doctorId for $appointmentDate at $appointmentTime has been sent. We will get back to you shortly.</p>";
            echo "<p><a href='search_doctors.php'>Go back to search</a></p>";
        } else {
            // Display an error message
            echo "<h3>Error</h3>";
            echo "<p>There was an error processing your appointment request. Please try again later.</p>";
            echo "<p><a href='search_doctors.php'>Go back to search</a></p>";
        }

        // Close the statement and the database connection
        $stmt->close();
        $conn->close();
        exit();
    }

   
} else {
    // Redirect to the search_doctors.php page if the doctor ID is not provided
    header("Location: search_doctors.php");
    exit();
}
?>