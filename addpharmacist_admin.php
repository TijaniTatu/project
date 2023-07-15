<?php
require("database.php");
        echo "
        <form method='POST' action=''>
            <label for='username'>User Name:</label>
            <input type='text' id='username' name='username' required><br>
            <label for='name'>Name:</label>
            <input type='text' id='name' name='name' required><br>
            <label for='address'>Address:</label>
            <input type='text' id='address' name='address' required><br>
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
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];

        // Prepare and bind the statement
        $stmt = $conn->prepare("INSERT INTO pharmacists_login(USER_NAME, NAME,ADDRESS,PHONE_NUMBER, PASSWORD) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $name, $address, $phone, $password);

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
