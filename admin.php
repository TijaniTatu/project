<?php
session_start();

// Check if the user is logged in as admin
if (isset($_SESSION["user_name"]) && $_SESSION["user_name"] && $_SESSION["user_name"] != "admin") {
    // Retrieve the admin's information from the session
    $adminUserName = $_SESSION["user_name"];
    // You can retrieve additional information from the database if needed
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Home Page</title>
    <style>
        .welcome-message {
            position: absolute;
            top: 10px;
            right: 10px;
            font-weight: bold;
        }
        
        .tabs-container {
            margin-top: 50px;
        }
        
        .tab {
            display: inline-block;
            padding: 10px;
            background-color: #f1f1f1;
            border: 1px solid #ccc;
            cursor: pointer;
        }
        
        .tab:hover {
            background-color: #e1e1e1;
        }
        
        .tab-content {
            display: none;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
        }
    </style>
    <script>
        function openTab(tabName) {
            var i, tabContent;
            tabContent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabContent.length; i++) {
                tabContent[i].style.display = "none";
            }
            document.getElementById(tabName).style.display = "block";
        }
    </script>
</head>
<body>
    <div class="welcome-message">
        Welcome, <?php echo $adminUserName; ?>!
    </div>
    
    <div class="tabs-container">
        <div class="tab" onclick="openTab('viewPatients')">View Patients</div>
        <div class="tab" onclick="openTab('viewDoctors')">View Doctors</div>
        <div class="tab" onclick="openTab('viewPharmacies')">View Pharmacies</div>
        <div class="tab" onclick="openTab('viewPharmaceuticalCompanies')">View Pharmaceutical Companies</div>
        <div class="tab" onclick="openTab('viewPrescriptions')">View Prescriptions</div>
        <div class="tab" onclick="openTab('viewDrugs')">View Drugs</div>
        <div class="tab" onclick="openTab('viewContracts')">View Contracts</div>
    </div>
    
    <div id="viewPatients" class="tab-content">
    <?php
    
require_once("database.php");

    // Fetch patients from the database
    $sql = "SELECT * FROM patients";
    
$result = $conn->query($sql);
    // Check if any patients were found
    if ($result) {
        if ($result->num_rows > 0) {
            // Output the patient data as a table
            echo "<table>
                    <tr>
                        <th>User Name</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Email Address</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                    </tr>";

            // Output each patient row as a table row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["USER_NAME"] . "</td>";
                echo "<td>" . $row["NAME"] . "</td>";
                echo "<td>" . $row["AGE"] . "</td>";
                echo "<td>" . $row["ADDRESS"] . "</td>";
                echo "<td>" . $row["EMAIL_ADDRESS"] . "</td>";
                echo "<td>" . $row["PHONE_NUMBER"] . "</td>";
                echo '<td><button class="btn btn-primary"><a href="update.php?updateid=1" class="text-light">Update</a></button></td>';
                echo '<td><button class="btn btn-danger"><a href="delete.php?deleteid=1"  class="text-light">Delete</a></button></td>';
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No patients found.";
        }
    } else {
        echo "Error retrieving patient data: " . $conn->error;
    }

   
    ?>
</div>

    
    <div id="viewDoctors" class="tab-content">
    <?php
    
    require_once("database.php");
    
        // Fetch patients from the database
        $sql = "SELECT * FROM doctors";
        $result = $conn->query($sql);
    
        // Check if any patients were found
        if ($result) {
            if ($result->num_rows > 0) {
                // Output the patient data as a table
                echo "<table>
                        <tr>
                            <th>User Name</th>
                            <th>Name</th>
                            <th>speciality</th>
                            <th>years of experience</th>
                            <th>email_address</th>
                            <th>Action</th>
                        </tr>";
    
                // Output each patient row as a table row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["USER_NAME"] . "</td>";
                    echo "<td>" . $row["NAME"] . "</td>";
                    echo "<td>" . $row["SPECIALITY"] . "</td>";
                    echo "<td>" . $row["YRS_OF_EXPERIENCE"] . "</td>";
                    echo "<td>" . $row["EMAIL_ADDRESS"] . "</td>";
                    echo '<td><button class="btn btn-primary"><a href="update.php?updateid=1" class="text-light">Update</a></button></td>';
                    echo '<td><button class="btn btn-danger"><a href="delete.php?deleteid=1"  class="text-light">Delete</a></button></td>';
                    echo "</tr>";
                }
    
                echo "</table>";
            } else {
                echo "No doctors found.";
            }
        } else {
            echo "Error retrieving doctors data: " . $conn->error;
        }
    
        // Close the database connection
        $conn->close();
        ?>
    </div>
    
    <div id="viewPharmacies" class="tab-content">
        <!-- Code to display the "View Pharmacies" content from the database -->
    </div>
    
    <div id="viewPharmaceuticalCompanies" class="tab-content">
        <!-- Code to display the "View Pharmaceutical Companies" content from the database -->
    </div>
    
    <div id="viewPrescriptions" class="tab-content">
        <!-- Code to display the "View Prescriptions" content from the database -->
    </div>
    
    <div id="viewDrugs" class="tab-content">
        <!-- Code to display the "View Drugs" content from the database -->
    </div>
    
    <div id="viewContracts" class="tab-content">
        <!-- Code to display the "View Contracts" content from the database -->
    </div>
</body>
</html>

<?php
}
?>
