
<!DOCTYPE html>
<html>
<head>
  <title>Doctors Details Update</title>
</head>
<body>

  <h2>Patient Details Update</h2>
  <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
  <label for="USER_NAME"> User Name</label>
    <input type="text" name="USER_NAME" required><br> 
  
  <label for="FIRST_NAME"> Name</label>
    <input type="text" name="FIRST_NAME" required><br>

   

    <label for="SPECIALITY">Speciality:</label>
    <input type="text" name="SPECIALITY" required><br>

    <label for="EXPERIENCE">Years of Experience</label>
    <input type="number" name="EXPERIENCE" required></textarea><br>

    <label for="PASSWORD">Password</label>
    <input type="password" name="PASSWORD" required><br>


    <input type="submit" name="submit" value="Update">
    <?php
  // Check if the form is submitted
 
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $username = $_POST['USER_NAME'];
    $first_name = $_POST['FIRST_NAME'];
    $speciality = $_POST['SPECIALITY'];
    $experience=$_POST['EXPERIENCE'];
    $password = $_POST['PASSWORD'];
  

    // Connect to the database
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $database = "wad_ddt_adan_150655";

    $conn = new mysqli($servername, $db_username, $db_password, $database);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the update query
     $stmt = $conn->prepare("UPDATE doctors_login SET NAME=?,SPECIALITY=?,YRS_OF_EXPERIENCE =?, PASSWORD=? WHERE USER_NAME=? ");
    $stmt->bind_param("ssiss",$first_name,$speciality,$experience,$password,$username);
    if ($stmt->execute()) {
      echo "User details updated successfully.";
    } else {
      echo "Error updating user details: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
  }
  ?>

  </form>

</body>
</html>
