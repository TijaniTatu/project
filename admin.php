<?php
session_start();

// Check if the user is logged in as admin
if (isset($_SESSION["user_name"]) && $_SESSION["user_name"] && $_SESSION["user_name"] != "admin") {
    // Redirect to the appropriate page based on user type
    header("Location: index.php");
    exit();
}

// Retrieve the admin's information from the session
$adminUserName = $_SESSION["user_name"];
// You can retrieve additional information from the database if needed

// Display the admin's information
echo "Welcome, Admin " . $adminUserName . "!"; // Replace this with your desired display format

// Additional content for the admin home page

?>
