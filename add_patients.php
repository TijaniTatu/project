<?php
// Database configuration
require_once("database.php");

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
   
    $user_name = $_POST["user_name"];
    $NAME =$_POST["NAME"];
    $age = $_POST["age"];
    $address = $_POST["address"];
    $email_address = $_POST["email_address"];
    $phone_number = $_POST["phone_number"];
    $password = $_POST['pass'];


    // Prepare the SQL statement
    
    $sql = "INSERT INTO Patients (USER_NAME,NAME, AGE, ADDRESS,EMAIL_ADDRESS,PHONE_NUMBER,PASSWORD) VALUES (?, ?, ?, ?, ? ,? ,? )";


    // Prepare and bind the parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssissss', $user_name,$NAME ,$age, $address,$email_address,$phone_number,$password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Data inserted successfully.";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

