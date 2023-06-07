<?php
require_once("database.php");
// Retrieve form data

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST["user_name"];
    $password = $_POST["password"];

    // Prepare the SQL statement
    $sql = "SELECT * FROM patients WHERE user_name = ?";

    // Prepare and bind the parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $user_name);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Fetch the row
        $row = $result->fetch_assoc();

        // Verify the password
        if (isset($row['password']) && password_verify($password, $row['password'])) {
            // Password is correct, login successful
            echo "Login successful!";
        } else {
            // Invalid password
            echo "Invalid password!";
        }
    } else {
        // User does not exist
        echo "User does not exist!";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

}
?>
