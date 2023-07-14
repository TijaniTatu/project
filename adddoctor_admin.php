<?php
require("connection.php");
        echo "
        <form method='POST' action=''>
            <label for='username'>User Name:</label>
            <input type='text' id='username' name='username' required><br>
            <label for='name'>Name:</label>
            <input type='text' id='name' name='name' required><br>
            <label for='speciality'>Speciality</label>
            <input type='text' id='speciality' name='speciality' required><br>
            <label for='experience'>Years of experience:</label>
            <input type='number' id='experience' name='experience' required><br>
            <label for='password'>Password:</label>
            <input type='password' id='password' name='password' required><br>
            <input type='submit' value='Submit'>
        </form>
        ";

    // Handle the form submission and insert the new patient
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = $_POST['username'];
        $name = $_POST['name'];
        $speciality = $_POST['speciality'];
        $experience = $_POST['experience'];
        $password = $_POST['password'];

        // Prepare and bind the statement
        $stmt = $conn->prepare("INSERT INTO doctors_login (USER_NAME, FIRST_NAME, LAST_NAME, SPECIALITY, YRS_OF_EXPERIENCE, PASSWORD) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $name, $speciality, $experience,$password);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Data inserted successfully!";
        } else {
            echo "Error: Unable to insert data.";
        }

        // Close the statement
        $stmt->close();
    }

    

    ?>
