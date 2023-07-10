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
                  
                  <label for="User_name">User_name:</label>
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
               // Get the logged-in user's details from the database
        $username = $_SESSION["user_name"];
        $user = selectDataFromDatabase("localhost", "root", "", "db_tijani_tatu_150397", "Patients", "user_name", $username);

        if (!empty($user)) {
            echo '<table>';
            echo '<tr><th>user_name</th><th>first_name</th><th>second_name</th><th>age</th><th>address</th><th>email_address</th><th>phone_number</th><th>password</th><th>Action</th></tr>';

            echo '<tr>';
            echo '<td>' . $user[0]['USER_NAME'] . '</td>';
            echo '<td>' . $user[0]['FIRST_NAME'] . '</td>';
            echo '<td>' . $user[0]['SECOND_NAME'] . '</td>';
            echo '<td>' . $user[0]['AGE'] . '</td>';
            echo '<td>' . $user[0]['ADDRESS'] . '</td>';
            echo '<td>' . $user[0]['EMAIL_ADDRESS'] . '</td>';
            echo '<td>' . $user[0]['PHONE_NUMBER'] . '</td>';
            echo '<td>' . $user[0]['PASSWORD'] . '</td>';
            echo '<td><button class="btn btn-primary"><a href="update.php?updateid=1" class="text-light">Update</a></button></td>';
            echo '<td><button class="btn btn-danger"><a href="delete.php?deleteid=1"  class="text-light">Delete</a></button></td>';
            echo '</tr>';
        

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

        </script>
        
    </div>
</body>
</html>