<!DOCTYPE html>
<html>
<head>
    <title>Add Drug</title>
    <style>
        /* ... CSS styling ... */
    </style>
</head>
<body>
    <h1>Add Drug</h1>

    <?php
    require_once("database.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the new drug data from the form
        $drugId = $_POST['drugId'];
        $chemicalName = $_POST['chemicalName'];
        $price = $_POST['price'];

        // Insert the new drug record into the database
        $query = "INSERT INTO drugs (DRUG_ID, CHEMICAL_NAME, PRICE) VALUES ('$drugId', '$chemicalName', '$price')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Drug added successfully, display success message
            echo "Drug added successfully. <a href='drug_management.php'>Return to Drug Management</a>";
            exit(); // Terminate the current script
        } else {
            echo "Error adding drug: " . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <!-- Add Drug Form -->
    <div class="form-container">
        <h2>Add Drug</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="drugId">Drug ID:</label>
            <input type="text" id="drugId" name="drugId" required>
            <label for="chemicalName">Chemical Name:</label>
            <input type="text" id="chemicalName" name="chemicalName" required>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <div>
                <input type="submit" value="Add Drug">
                <button type="button" onclick="location.href='drug_management.php'">Cancel</button>
            </div>
        </form>
    </div>
</body>
</html>
