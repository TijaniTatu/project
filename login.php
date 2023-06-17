<?php

require_once("database.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted ID and password
    $user_name = $_POST["user_name"];
    $password = $_POST["password"];
    $selectedTable= $_POST["firstComboBox"];
    // Further validation or sanitization can be applied if necessary
 
    // Prepare the query based on the selected table
  switch ($selectedTable) {
    case "patient":
        $tableName = "Patients";
        break;
    case "doctor":
        $tableName = "Doctors";
        break;
    case "pharmacy":
        $tableName = "Pharmacy";
        break;
    default:
        $tableName = "";
        break;
}
    // Prepare the query
    if (!empty($tableName)) {
        // Prepare the query
        $stmt = $conn->prepare("SELECT user_name FROM $tableName WHERE user_name = ? AND password = ?");
        $stmt->bind_param("ss", $user_name, $password);
        
    
    // Execute the query
    $stmt->execute();

    // Bind the result
    $stmt->bind_result( $user_name);

    // Check if a matching record is found
    if ($stmt->fetch()) {
        // Successful login, grant access
        echo "<br>" . "Welcome $selectedTable " . $user_name;
    } else {
        // Invalid credentials, deny access
        echo "<br>" . "Invalid credentials. Please try again.";
    }
} else {
    // No table selected, display an error message
    echo "<br>" . "Please select a valid option.";
}
} else {
// Fields not submitted, display an error message
echo "<br>" . "Please fill in all the required fields.";
}


?>