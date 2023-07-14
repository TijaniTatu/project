<?php
require("connection.php");
        echo "
        <form method='POST' action=''>
            <label for='username'>User Name:</label>
            <input type='text' id='username' name='username' required><br>
            <label for='first_name'>First Name:</label>
            <input type='text' id='first_name' name='first_name' required><br>
            <label for='second_name'>Second Name:</label>
            <input type='text' id='second_name' name='second_name' required><br>
            <label for='age'>Age:</label>
            <input type='number' id='age' name='age' required><br>
            <label for='address'>Address:</label>
            <input type='text' id='address' name='address' required><br>
            <label for='email'>Email Address:</label>
            <input type='email' id='email' name='email' required><br>
            <label for='phone'>Phone Number:</label>
            <input type='number' id='phone' name='phone' required><br>
            <label for='password'>Password:</label>
            <input type='password' id='password' name='password' required><br>
            <input type='submit' value='Submit'>
        </form>
        ";

    // Handle the form submission and insert the new patient
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = $_POST['username'];
        $firstname = $_POST['first_name'];
        $secondname = $_POST['second_name'];
        $age = $_POST['age'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];

        // Prepare and bind the statement
        $stmt = $conn->prepare("INSERT INTO add_patients (USER_NAME, FIRST_NAME, SECOND_NAME, AGE, ADDRESS, EMAIL_ADDRESS, PHONE_NUMBER, PASSWORD) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssissss", $username, $firstname, $secondname, $age, $address, $email, $phone, $password);

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
