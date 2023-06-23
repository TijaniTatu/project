<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
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

        /* CSS for the content area */
        .content {
            padding: 20px;
        }

        /* CSS for the edit pencil icon */
        .edit-icon {
            cursor: pointer;
            display: inline-block;
            width: 16px;
            height: 16px;
            background-image: url('edit_icon.png');
            background-size: cover;
        }
    </style>
</head>
<body>
    <ul class="navbar">
        <li><a href="patient.php">Home</a></li>
        <li><a href="#">Appointments</a></li>
        <li><a href="#">Medical Records</a></li>
        <li><a href="#">Prescriptions</a></li>
        <li><a href="user_management.php">User Management</a></li>
        <li style="float: right;"><a href="#">Logout</a></li>
    </ul>

    <div class="content">
        <h1>User Management</h1>

        <?php
      require_once("functions.php");
      require_once("database.php");
      
      // Check if the user is logged in and their username is set in the session
      session_start();
      if (isset($_SESSION["user_name"])) {
          echo "Welcome, " . $_SESSION["user_name"] . "!";
      
          // Display user details or form for updating details
          // Add your code here for displaying user details or the update form
          if (isset($_GET['edit'])) {
              // Display the update form
              echo '
              <h2>Edit User Details</h2>
              <form method="post" action="update_user.php">
                  <!-- Add your form fields here -->
                  <!-- For example:
                  <label for="name">Name:</label>
                  <input type="text" id="name" name="name" value="">
      
                  <label for="email">Email:</label>
                  <input type="email" id="email" name="email" value="">
      
                  <label for="age">Age:</label>
                  <input type="number" id="age" name="age" value="">
      
                  <input type="submit" value="Update">
                  -->
              </form>';
          } else {
              // Display user details
              // Add your code here for displaying user details
              $patients = selectDataFromDatabase("localhost", "root", "", "db_tijani_tatu_150397", "Patients");
      
                if (!empty($patients)) {
                    echo '<table>';
                    echo '<tr><th>Name</th><th>Email</th><th>Age</th><th>Action</th></tr>';

                    foreach ($patients as $patient) {
                        if (isset($patient['user_name']) && isset($patient['first_name']) && isset($patient['second_name']) && isset($patient['age']) && isset($patient['address']) && isset($patient['email_address']) && isset($patient['phone_number']) && isset($patient['password'])) {
                        echo '<tr>';
                        echo '<td>' . $patient['user_name'] . '</td>';
                        echo '<td>' . $patient['first_name'] . '</td>';
                        echo '<td>' . $patient['second_name'] . '</td>';
                        echo '<td>' . $patient['age'] . '</td>';
                        echo '<td>' . $patient['address'] . '</td>';
                        echo '<td>' . $patient['email_address'] . '</td>';
                        echo '<td>' . $patient['phone_number'] . '</td>';
                        echo '<td>' . $patient['password'] . '</td>';
                        echo '<td><span class="edit-icon" onclick="editPatient(' . $patient['id'] . ')"></span></td>';
                        echo '</tr>';
                    }
                }
                    echo '</table>';
                } else {
                    echo 'No patients found.';
                }
            }
        } else {
            // Redirect to the login page if the user is not logged in
            header("Location: login.php");
            exit();
        }
        ?>

        <!-- JavaScript function to handle edit operation -->
        <script>
            function editPatient(patientId) {
                // Redirect to the user_management.php page with the edit parameter
                window.location.href = 'user_management.php?edit=' + patientId;
            }
        </script>
    </div>
</body>
</html>

