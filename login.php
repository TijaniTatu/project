<?php
require_once("database.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted ID and password
    $user_name = $_POST["user_name"];
    $password = $_POST["password"];

    // Further validation or sanitization can be applied if necessary

    // Prepare the query
    $stmt = $conn->prepare("SELECT user_name FROM Patients WHERE user_name = ? AND password = ?");
    $stmt->bind_Param("is", $user_name,$password);
    
    // Execute the query
    $stmt->execute();

    // Bind the result
    $stmt->bind_result( $user_name);

    // Check if a matching record is found
    if ($stmt->fetch()) {
        // Successful login, grant access
        echo "<br>"."Welcome patient " . $user_name;
    } else {
        // Invalid credentials, deny access
        echo "Invalid credentials. Please try again.";
    }

    // Close the database connection
    $conn = null;
}
?>
