<!DOCTYPE html>
<html>
<head>
    <title>Drug Management</title>
    <style>
        /* ... CSS styling ... */
    </style>
</head>
<body>
    <h1>Drug Management</h1>

    <?php
    require_once("database.php");

    // Function to delete a drug
    function deleteDrug($conn, $drugId) {
        $query = "DELETE FROM drugs WHERE DRUG_ID = '$drugId'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "Drug deleted successfully.";
        } else {
            echo "Error deleting drug: " . mysqli_error($conn);
        }
    }

    // Handle drug deletion
    if (isset($_GET['deleteDrugId'])) {
        $deleteDrugId = $_GET['deleteDrugId'];
        deleteDrug($conn, $deleteDrugId);
    }

    // Retrieve drugs data from the database
    $query = "SELECT * FROM drugs";
    $result = mysqli_query($conn, $query);

    // Check if there are any drugs
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>Drug ID</th><th>Chemical Name</th><th>Price</th><th>Actions</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["DRUG_ID"] . "</td>";
            echo "<td>" . $row["CHEMICAL_NAME"] . "</td>";
            echo "<td>" . $row["PRICE"] . "</td>";
            echo "<td>
                      <a href='inventory.php?drugId=" . $row["DRUG_ID"] . "'>Add to Inventory</a> |
                      <a href='?editDrugId=" . $row["DRUG_ID"] . "'>Edit</a> |
                      <a href='?deleteDrugId=" . $row["DRUG_ID"] . "' onclick='return confirm(\"Are you sure you want to delete this drug?\")'>Delete</a>
                  </td>";
            echo "</tr>";

            // Check if the current drug is being edited
            if (isset($_GET['editDrugId']) && $_GET['editDrugId'] == $row["DRUG_ID"]) {
                echo "<tr>";
                echo "<td colspan='4'>";
                echo "<form id='editForm' action='process_edit.php' method='post'>";
                echo "<input type='hidden' name='editDrugId' value='" . $row["DRUG_ID"] . "'>";
                echo "<label for='editChemicalName'>Chemical Name:</label>";
                echo "<input type='text' id='editChemicalName' name='editChemicalName' value='" . $row["CHEMICAL_NAME"] . "'>";
                echo "<label for='editPrice'>Price:</label>";
                echo "<input type='number' id='editPrice' name='editPrice' step='0.01' value='" . $row["PRICE"] . "'>";
                echo "<input type='submit' value='Save'>";
                echo "<button type='button' onclick='cancelEdit()'>Cancel</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
    } else {
        echo "<p>No drugs found.</p>";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <!-- Add Drugs Button -->
    <div>
        <button onclick="location.href='add_drug.php'">Add Drugs</button>
    </div>

    <script>
        function cancelEdit() {
            window.location.href = 'drug_management.php';
        }
    </script>
</body>
</html>
