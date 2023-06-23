<?php
require_once("functions.php");
require_once("database.php");

// Check if the user is logged in and their username is set in the session
session_start();
if (isset($_SESSION["user_name"])) {
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the updated user details from the form submission
        $user_name = $_POST["user_name"];
        $first_name =$_POST["first_name"];
        $second_name =$_POST["second_name"];
        $age = $_POST["age"];
        $address = $_POST["address"];
        $email_address = $_POST["email_address"];
        $phone_number = $_POST["phone_number"];
        $password = $_POST['pass'];

     
        // Update the user details in the database
        $username = $_SESSION["user_name"];
        $updateResult = updateUserData("localhost", "root", "", "db_tijani_tatu_150397");

        if ($updateResult) {
            // Redirect to the desired page after updating
            header("Location: user_management.php");
            exit();
        } else {
            // Handle update failure
            echo "Failed to update user details.";
        }
    } else {
        // Display the edit form
        // Retrieve the user details from the database
        $username = $_SESSION["user_name"];
        $user = selectDataFromDatabase("localhost", "root", "", "db_tijani_tatu_150397", "Patients", "user_name", $username);

        if (!empty($user)) {
            echo '
            <h2>Edit User Details</h2>
            <form method="post" action="update.php">
                
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
            </form>';
        } else {
            echo 'No user found.';
        }
    }
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}
?>
