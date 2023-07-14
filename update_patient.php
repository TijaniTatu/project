
<!DOCTYPE html>
<html>
<head>
  <title>User Details Update</title>
</head>
<body>

  <h2>Patient Details Update</h2>
  <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
  <label for="USER_NAME">Patient User Name</label>
    <input type="text" name="USER_NAME" placeholder="unchanged" required><br> 
  
  <label for="NAME">First Name</label>
    <input type="text" name="NAME" required><br>


    <label for="AGE">Age:</label>
    <input type="text" name="AGE" required><br>

    <label for="ADDRESS">Address:</label>
    <textarea name="ADDRESS" rows="4" cols="30" required></textarea><br>

    <label for="EMAIL_ADDRESS">Email Address:</label>
    <input type="email" name="EMAIL_ADDRESS" required><br>


    <label for="PHONE_NUMBER">Phone Number</label>
    <input type="text" name="PHONE_NUMBER" required><br>


    <label for="PASSWORD">Password:</label>
    <input type="password" name="PASSWORD" required><br>


    <input type="submit" name="submit" value="Update">
    <?php
  // Check if the form is submitted
 
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $username = $_POST['USER_NAME'];
    $first_name = $_POST['NAME'];
  
    $age = $_POST['AGE'];
    $address=$_POST['ADDRESS'];
    $email_address = $_POST['EMAIL_ADDRESS'];
    $phone_number = $_POST['PHONE_NUMBER'];
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
     $stmt = $conn->prepare("UPDATE add_patients SET NAME=?,AGE=?,ADDRESS =?, EMAIL_ADDRESS=?, PHONE_NUMBER=?,PASSWORD=? WHERE USER_NAME=? ");
    $stmt->bind_param("sisssss",$first_name,$age,$address,$email_address,$phone_number,$password,$username);
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
