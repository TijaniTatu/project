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
<<<<<<< HEAD

        /* CSS for the top right corner */
        .top-right {
            position: absolute;
            top: 0;
            right: 0;
            padding: 10px;
            color: white;
            font-weight: bold;
        }
=======
>>>>>>> 681260b8d57902d8503b40ae96ec227ba98a3011
    </style>
</head>
<body>
    <ul class="navbar">
        <li><a href="#">Home</a></li>
        <li><a href="#">Appointments</a></li>
        <li><a href="#">Medical Records</a></li>
        <li><a href="#">Prescriptions</a></li>
<<<<<<< HEAD
        <li style="float: centre;"><a href="#">Logout</a></li>
=======
        <li style="float: right;"><a href="#">Logout</a></li>
>>>>>>> 681260b8d57902d8503b40ae96ec227ba98a3011
    </ul>

    <h1>Welcome, Patient!</h1>

<<<<<<< HEAD
    <div class="top-right">
        <?php
        session_start();

        // Check if the username is set in the session
        if (isset($_SESSION["user_name"])) {
            echo "Username: " . $_SESSION["user_name"];
        }
        ?>
    </div>

=======
>>>>>>> 681260b8d57902d8503b40ae96ec227ba98a3011
    <!-- Add your content here -->

</body>
</html>
