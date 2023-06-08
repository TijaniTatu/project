<?php


function selectDataFromDatabase($servername, $username, $password, $database, $tableName)
{
    require_once("database.php");

    // SQL query to select data
    $sql = "SELECT * FROM  .Patients";

    // Execute the query   
    $result = $conn->query($sql);

    // Check if any rows are returned
    if ($result->num_rows > 0) {
        // Create an array to hold the data
        $data = array();

        // Loop through each row
        while ($row = $result->fetch_assoc()) {
            // Add the row to the data array
            $data[] = $row;
        }

        // Close the connection
        $conn->close();

        // Return the retrieved data
        return $data;
    } else {
        // Close the connection
        $conn->close();

        // Return an empty array if no data found
        return array();
    }
}
// Call the function and assign the returned data to a variable
$data = selectDataFromDatabase("localhost", "root", "","db_tijani_tatu_150397", "Patients");

// Display or process the retrieved data
foreach ($data as $row) {
    print_r($row);
}
?>
