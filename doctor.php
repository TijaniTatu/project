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
        <li><a href="#">Home</a></li>
        <li><a href="#">Appointments</a></li>
        <li><a href="#">Patients</a></li>
        <li><a href="#">Medical Records</a></li>
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

    <h2>Appointments</h2>

    <?php
    // Retrieve and display the appointments for the doctor
    require_once("database.php");

    // Retrieve the doctor's ID from the session or a query parameter
    $doctorId = $_SESSION["doctor_id"] ?? $_GET["doctor_id"] ?? null;

    if ($doctorId) {
        // Prepare and execute the SQL query to fetch the appointments
        $stmt = $conn->prepare("SELECT * FROM appointments WHERE doctor_id = ?");
        $stmt->bind_param("s", $doctorId);
        $stmt->execute();

        // Get the result set
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Patient Name</th><th>Date</th><th>Time</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["PATIENT_NAME"] . "</td>";
                echo "<td>" . $row["DATE"] . "</td>";
                echo "<td>" . $row["TIME"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No appointments found.</p>";
        }

        // Close the statement and the database connection
        $stmt->close();
        $conn->close();
    } else {
        echo "<p>Doctor ID not found.</p>";
    }
    
    ?>
    

</body>
</html>
