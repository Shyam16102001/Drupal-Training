
<div id="productFields" class="container">
    <h1>Add Product</h1>
    <form method="POST" action="">
        <label for="pName">Product Name:</label>
        <input type="text" name="pName" id="pName" required>
        <label for="pPrice">Product Price:</label>
        <input type="number" name="pPrice" id="pPrice" required>
        <label for="pCategory">Product Category:</label>
        <select name="pCategory">
            <option value='' disabled selected>Select the category</option>
            <?php
            $servername = "localhost";
            $database = "mybasket";
            $username = "root";
            $password = "";
            $conn = mysqli_connect($servername, $username, $password, $database);
            if (!$conn) {
                die("<br>Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT * FROM category";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $categoryId = $row['CID'];
                $categoryName = $row['CNAME'];
                echo "<option value='$categoryId'>$categoryName</option>";
            }
            ?>
        </select><br>
        <input type="submit" value="Add Product" name="addProduct">
    </form>

    <?php

    if (isset($_POST['addProduct'])) {
        addProduct();
    }


    function addProduct()
    {
        if (isset($_POST["pName"]) && isset($_POST["pPrice"]) && isset($_POST["pCategory"])) {
            if($_POST['pPrice']<=0)
            {
                echo '<p class="warning">*Price must be greater than 0</p><br />';
                return;
            }
            $pName = $_POST["pName"];
            $pPrice = $_POST["pPrice"];
            $pCategory = $_POST["pCategory"];
            addtoDB($pName, $pPrice, $pCategory);
        } else {
            if (!isset($_POST["pName"]))
                echo '<p class="warning">*Select Name</p><br />';
            if (!isset($_POST["pPrice"]))
                echo '<p class="warning">*Select Price </p><br />';
            if (!isset($_POST["pCategory"]))
                echo '<p class="warning">*Select Category</p><br />';
        }
    }

    function addtoDB($PName, $PPrice, $CId)
    {
        $servername = "localhost";
        $database = "mybasket";
        $username = "root";
        $password = "";
        $conn = mysqli_connect($servername, $username, $password, $database);
        if (!$conn) {
            die("<br>Connection failed: " . mysqli_connect_error());
        }

        // Check Product already exsist.
        $sqlProduct = "SELECT PNAME FROM product";
        $result = $conn->query($sqlProduct);
        // echo "->".$result;
        while ($row = mysqli_fetch_assoc($result)) {
            foreach ($row as $v){
                if(strtolower($v)==strtolower($PName)){
                    echo "<p class='warning'>Product already exsists</p>";
                    return;
                }
            }
        }

        // echo "<br> DB Connected successfully.<br>";
        $pName = mysqli_real_escape_string($conn, $PName);
        $pPrice = mysqli_real_escape_string($conn, $PPrice);
        $cId = mysqli_real_escape_string($conn, $CId);
        $sql = "INSERT INTO product (PNAME, PPRICE, CID) VALUES ('$pName', '$pPrice', '$cId')";
        if (mysqli_query($conn, $sql)) {
            echo "<h3>New product added successfully.<h3>";
        } else {
            echo "<br>Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }

    ?>
</div>

