<?php
require_once("functions.php");
require_once("database.php");
require_once("login.php");
// Check if the user is logged in and their username is set in the session
session_start();
if (isset($_SESSION["user_name"])) {
    // Check if the user ID is provided in the URL
    if (isset($_GET["id"])) {
        $userID = $_GET["id"];

        // Delete the user from the database
        if (deleteDataFromDatabase("localhost", "root", "", "db_tijani_tatu_150397", $tableName, $userID)) {
            echo "User deleted successfully.";
        } else {
            echo "Failed to delete user.";
        }
    } else {
        echo "User ID not provided.";
    }
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}
?>
