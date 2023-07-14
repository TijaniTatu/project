
<!DOCTYPE html>
<html>
<head>
  <title>Pharmacists Details Update</title>
</head>
<body>

  <h2>Pharmacists Details Update</h2>
  <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
  <label for="USER_NAME"> User Name</label>
    <input type="text" name="USER_NAME" required><br> 
  
  <label for="NAME">Name</label>
    <input type="text" name="NAME" required><br>

    <label for="ADDRESS">Address</label>
    <input type="text" name="ADDRESS" required><br>

    <label for="PHONE">Phone Number</label>
    <input type="text" name="PHONE" required><br>

    <label for="PASSWORD">Password</label>
    <input type="password" name="PASSWORD" required><br>


    <input type="submit" name="submit" value="Update">
    <?php
  // Check if the form is submitted
 
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $username = $_POST['USER_NAME'];
    $name = $_POST['NAME'];
    $address = $_POST['ADDRESS'];
    $phone = $_POST['PHONE'];
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
     $stmt = $conn->prepare("UPDATE pharmacists_login SET NAME=?,ADDRESS=?,PHONE_NUMBER=?,PASSWORD=? WHERE USER_NAME=? ");
    $stmt->bind_param("sssss",$name,$address,$phone,$password,$username);
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
