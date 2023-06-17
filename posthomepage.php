<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_name"])) {
    // User is not logged in, redirect to login page
    header("Location: login.html");
    exit();
}

// User is logged in, retrieve the username from session
$user_name = $_SESSION["user_name"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
 
</head>
<body>
    <h1>Welcome, <?php echo $user_name; ?></h1>
   
</body>
</html>
