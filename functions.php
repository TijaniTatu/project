<?php

    function selectDataFromDatabase($servername, $username, $password, $database, $tableName)
    {
        require_once("database.php");
    
        // SQL query to select data
        $sql = "SELECT * FROM  Patients";
    
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
    
    function deleteDataFromDatabase($servername, $username, $password, $database, $tableName, $user_name)
    {
        require_once("database.php");
    
        // SQL query to delete a user with a specific ID
        $sql = "DELETE FROM $tableName WHERE id = $user_name";
    
        // Execute the query
        $result = $conn->query($sql);
    
        // Close the connection
        $conn->close();
    
        // Return true if the deletion was successful, or false otherwise
        return $result === TRUE;
    }
    
    function updateDataInDatabase($servername, $username, $password, $database, $tableName, $user_name, $newData)
    {
        require_once("database.php");
    
        // Generate the SET clause for updating the user data
        $setClause = '';
        foreach ($newData as $column => $value) {
            $setClause .= "$column = '$value',";
        }
        $setClause = rtrim($setClause, ',');
    
        // SQL query to update a user with a specific ID
        $sql = "UPDATE $tableName SET $setClause WHERE id = $user_name";
    
        // Execute the query
        $result = $conn->query($sql);
    
        // Close the connection
        $conn->close();
    
        // Return true if the update was successful, or false otherwise
        return $result === TRUE;
    }
    
  
    
    ?>
    
    
    

