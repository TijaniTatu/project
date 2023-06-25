<?php
require_once("functions.php");
require_once("database.php");

// Check if the user is logged in and their username is set in the session
session_start();
if (isset($_SESSION["user_name"])) {
    // Check if the delete ID is provided in the URL
    if (isset($_GET["deleteid"])) {
        $deleteID = $_GET["deleteid"];

        // Delete the user from the database
        if (deleteDataFromDatabase("localhost", "root", "", "db_tijani_tatu_150397", "Patients", $deleteID)) {
            echo "User deleted successfully.";
        } else {
            echo "Failed to delete user.";
        }
    } else {
        echo "Delete ID not provided.";
    }
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}
?>
