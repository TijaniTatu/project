<?php
require("connection.php");
        echo "
        <form method='POST' action=''>
            <label for='username'>User Name:</label>
            <input type='text' id='username' name='username' required><br>
            <label for='first_name'>First Name:</label>
            <input type='text' id='first_name' name='first_name' required><br>
            <label for='last_name'>Last Name:</label>
            <input type='text' id='last_name' name='last_name' required><br>
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
        $firstname = $_POST['first_name'];
        $lastname = $_POST['last_name'];
        $speciality = $_POST['speciality'];
        $experience = $_POST['experience'];
        $password = $_POST['password'];

        // Prepare and bind the statement
        $stmt = $conn->prepare("INSERT INTO doctors_login (USER_NAME, FIRST_NAME, LAST_NAME, SPECIALITY, YRS_OF_EXPERIENCE, PASSWORD) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $username, $firstname, $lastname, $speciality, $experience,$password);

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
