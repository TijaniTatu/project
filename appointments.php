<!DOCTYPE html>
<html>
<head>
    <title>Patients Dashboard - Appointments</title>
    <!-- Add your CSS styling here -->
    <style>
        /* Add your custom CSS styles for the appointments page */
    </style>
</head>
<body>
    <ul class="navbar">
        <!-- Include the navigation links for other sections of the dashboard -->
    </ul>

    <h1>Welcome, Patient!</h1>

    <div class="top-right">
        
    </div>

    <h2>Find a Doctor</h2>

    <form action="search_doctors.php" method="GET">
    <label for="specialty">Select Specialty:</label>
        
        <?php
        require_once("database.php");
        $combo = "<select name='specialty' id='speciality'>"; // Add the name attribute to the select element

        $sql = "SELECT DISTINCT SPECIALITY FROM doctors"; // Use DISTINCT to get unique specialties

        if ($result = $conn->query($sql)) {
            if ($result->num_rows) {
                while ($row = $result->fetch_object()) {
                    $combo .= "<option>" . $row->SPECIALITY . "</option>";
                }
                $result->free();
            }
        }
        $combo .= "</select>";
        echo $combo;
        ?>

        <input type="submit" value="Search">
    </form>


</body>
</html>
