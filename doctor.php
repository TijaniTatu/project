<!DOCTYPE html>
<html>
<head>
    <title>Doctor Dashboard</title>
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
        <li><a href="doctors_appointments.php">Appointments</a></li>
        <li><a href="doctors_patients.php">Patients</a></li>
        <li style="float: right;"><a href="#">Logout</a></li>
    </ul>

    <h1>Welcome, Doctor!</h1>

    <div class="top-right">
        <?php
        session_start();

        // Check if the username is set in the session
        if (isset($_SESSION["user_name"])) {
            echo "Username: " . $_SESSION["user_name"];
        }
        ?>
    </div>
    

</body>
</html>
