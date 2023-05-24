<!-- <!DOCTYPE html>
<html>
<head>
    <title>Add Customer</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body> -->
    <div class="container">
    <h1>Add Customer</h1>
        <form action="" method="POST">
            <label for="custname">Name:</label>
            <input type="text" name="custname" required>

            <label for="custemail">Email:</label>
            <input type="text" name="custemail" required>
            <label for="custphone">Phone:</label>
            <input type="text" name="custphone" required>
            <label for="custpassword">Password:</label>
            <input type="text" name="custpass" required><br>

            <input type="submit" value="Add Customer">
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
                $custname = mysqli_real_escape_string($connection, $_POST["custname"]);
                $custemail = mysqli_real_escape_string($connection, $_POST["custemail"]);
                $custphone = mysqli_real_escape_string($connection, $_POST["custphone"]);
                $custpassword = mysqli_real_escape_string($connection, $_POST["custpass"]);
                $sql = "INSERT INTO customer(custname,custemail,custphone,custpass)
                        VALUES ( '$custname', '$custemail', '$custphone', '$custpassword')";

                if (mysqli_query($connection, $sql)) {
                    $query='SELECT custID from customer where custemail='.$custemail;
                    echo "customer added successfully. ";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
                }
            }

            $sql = "SELECT * FROM customer";
            $result = mysqli_query($connection, $sql);

        ?>

    </div>
<!-- </body>
</html> -->

<?php
// Close the database connection
mysqli_close($connection);

?>