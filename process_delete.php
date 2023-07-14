<?php
require_once("database.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['drugId'])) {
    $drugId = $_GET['drugId'];

    // Delete the drug record
    $query = "DELETE FROM drugs WHERE DRUG_ID = '$drugId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Drug deleted successfully.";
        echo "<br>";
            echo "<a href='drug_management.php'>Go back to drug management</a>";

        
    } else {
        echo "Error deleting drug: " . mysqli_error($conn);
        echo "<br>";
            echo "<a href='drug_management.php'>Go back to drug management</a>";
       
    }
}

// Close the database connection
mysqli_close($conn);
?>
