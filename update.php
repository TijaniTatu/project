<!DOCTYPE html>
<html>
<head>
  <title>User Details Update</title>
</head>
<body>
<form method="post" action="./update.php">
                
                <br>       
                <div>
                    <label for="user_name">user_name:</label>
                    <input type="text" id="user_name" 
                    name="user_name" placeholder="user_name" required
                    autocomplete="off">
                </div>
               <br>
               <br>       
                <div>
                    <label for="first_name">first_name:</label>
                    <input type="text" id="first_name" 
                    name="first_name" placeholder="first_name" required
                    autocomplete="off">
                </div>
               <br>
               <br>       
                <div>
                    <label for="second_name">second_name:</label>
                    <input type="text" id="second_name" 
                    name="second_name" 
                    placeholder="second_name" required
                    autocomplete="off">
                </div>
               <br>
                <div>
                    <label for="age">age:</label>
                    <input type="number" id="age" 
                    name="age" 
                    placeholder="your age" required
                    autocomplete="off">
                </div>
               
               <br>
                <div>
                    <label for="address">address:</label>
                    <input type="text" id="address" 
                     name="address"
                      placeholder="your address" required
                     autocomplete="off">
                </div>
               <br>
                <div>
                    <label for="email_address">email_address:</label>
                    <input type="email" id="email_address"
                     name="email_address"
                     placeholder="....@gmail/yahoo.com" required
                    autocomplete="off">
                </div>
               <br>
               <br>
                <div>
                    <label for="phone_number">phone number:</label>
                    <input type="tel" id="phone_number"  name="phone_number"placeholder="+254....." required
                    autocomplete="off">
                </div>
               <br>
                <div>
                    <label for="pass">password:</label>
                    <input type="password" id="pass" name="pass" placeholder="8-12 char" maxlength="12" required
                    autocomplete="off">
                </div>
               
                <br>
                     
                 <input type="submit" value="Update">
                

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the updated user details from the form submission
    $user_name = $_POST["user_name"];
    $first_name = $_POST["first_name"];
    $second_name = $_POST["second_name"];
    $age = $_POST["age"];
    $address = $_POST["address"];
    $email_address = $_POST["email_address"];
    $phone_number = $_POST["phone_number"];
    $password = $_POST['pass'];

    // Connect to the database
    require_once("./database.php");

   

    // Prepare and execute the update query
    $stmt = $conn->prepare("UPDATE patients SET FIRST_NAME=?, SECOND_NAME=?, AGE=?, ADDRESS=?, EMAIL_ADDRESS=?, PHONE_NUMBER=?, PASSWORD=? WHERE USER_NAME=? ");
    $stmt->bind_param("ssisssss", $first_name, $second_name, $age, $address, $email_address, $phone_number, $password, $user_name);

    if ($stmt->execute()) {
       
        echo "User details updated successfully.";
    } else {
       
        echo "Error updating user details: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
