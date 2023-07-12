<?php
// search_doctors.php

// Make sure the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve the selected specialty from the form data
    $selectedSpecialty = $_GET['specialty'];

    // Perform your database query to retrieve doctors with the selected specialty
    require_once("database.php");

    $sql = "SELECT * FROM doctors WHERE SPECIALITY = '$selectedSpecialty'";
    $result = $conn->query($sql);

    // Display the search results
    if ($result->num_rows > 0) {
        echo "<h3>Doctors with specialty: $selectedSpecialty</h3>";
        echo "<table>";
        echo "<tr><th>Username</th><th>Name</th><th>Speciality</th><th>Years of Experience</th><th>Email Address</th><th>Action</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['USER_NAME'] . "</td>";
            echo "<td>" . $row['NAME'] . "</td>";
            echo "<td>" . $row['SPECIALITY'] . "</td>";
            echo "<td>" . $row['YRS_OF_EXPERIENCE'] . "</td>";
            echo "<td>" . $row['EMAIL_ADDRESS'] . "</td>";
            echo "<td><a href='appointment_request.php?doctor_id=" . $row['USER_NAME'] . "'>Request Appointment</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No doctors found with specialty: $selectedSpecialty</p>";
    }

    // Free the result set
    $result->free();

    // Close the database connection
    $conn->close();
}
?>
