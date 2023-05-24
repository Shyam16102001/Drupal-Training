<!-- <!DOCTYPE html>
<html>
<head>
    <title>Category List</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body> -->
    <div class="container">
    <h1>Add Category</h1>
        <form action="" method="POST">

            <label for="CNAME">Category Name:</label>
            <input type="text" name="CNAME" required>

            <label for="CDESCRIPTION">Category Description:</label>
            <textarea name="CDESCRIPTION" required></textarea><br>

            <input type="submit" value="Add Category">
        </form>
        <?php

        $hostname = "localhost"; 
        $username = "root"; 
        $password = "";  
        $database = "mybasket"; 

        $connection = mysqli_connect($hostname, $username, $password, $database);

        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $CNAME = mysqli_real_escape_string($connection, $_POST["CNAME"]);
            $CDESCRIPTION = mysqli_real_escape_string($connection, $_POST["CDESCRIPTION"]);

            $sql = "INSERT INTO category (CNAME, CDESCRIPTION)
                    VALUES ( '$CNAME', '$CDESCRIPTION')";

            if (mysqli_query($connection, $sql)) {
                echo "Category added successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connection);
            }
        }

        $sql = "SELECT * FROM category";
        $result = mysqli_query($connection, $sql);
        ?>

    </div>

<?php
mysqli_close($connection);
?>
