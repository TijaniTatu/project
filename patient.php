<!DOCTYPE html>
<html>
<head>
    <title>Patients Dashboard</title>
    <style>
        /* CSS for the navigation bar */
        ul.navbar {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        ul.navbar li {
            float: left;
        }

        ul.navbar li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        ul.navbar li a:hover {
            background-color: #111;
        }

        /* CSS for the top right corner */
        .top-right {
            position: absolute;
            top: 0;
            right: 0;
            padding: 10px;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <ul class="navbar">
        <li><a href="#">Home</a></li>
        <li><a href="appointments.php">Appointments</a></li>
        <li><a href="#">Prescriptions</a></li>
        <li><a href="user_management.php">user management</a></li>
        <li style="float: center;"><a href="#">Logout</a></li>
    </ul>

    <h1>Welcome, Patient!</h1>

    <div class="top-right">
        <?php
    // Check if the user is logged in and their username is set in the session
    session_start();
    if (isset($_SESSION["user_name"])) {
        echo "Welcome, " . $_SESSION["user_name"] . "!";

        // Display user details or form for updating details
        // Add your code here for displaying user details or the update form
    } else {
        // Redirect to the login page if the user is not logged in
        header("Location: login.php");
        exit();
    }
        ?>
    </div>

    <!-- Add your content here -->

</body>
</html>
