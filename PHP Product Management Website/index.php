<?php
namespace web;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product Management System</title>
</head>
<body style="text-align: center;">
    <h1>Product Management System</h1>
    <form method="POST" action="">
        <label for="choice">Options:</label> 
        <select name="choice" onchange="this.form.submit()">
            <option value='' disabled selected>Select the option</option>
            <option value="1">Add Product</option>
            <option value="2">Update Product</option>
            <option value="3">Delete Product</option>
            <option value="4">Search Product</option>
            <option value="5">Display Products</option>
        </select>
    </form>
    <br>
    <hr>
    <div id="productFields" style="display: none;">
        <h1>Add Product</h1>
        <form method="POST" action="">
            <label for="pName">Product Name:</label>
            <input type="text" name="pName" id="pName" required><br><br>
            <label for="pPrice">Product Price:</label>
            <input type="number" name="pPrice" id="pPrice" required><br><br>
            <input type="submit" value="Submit" name="addProduct"> 
        </form>
    </div>

    <div id="updateProductId" style="display: none;">
        <h1>Update Product</h1>
        <form method="POST" action="">
            <label for="pID">Product ID:</label>
            <input type="text" name="pID" id="pID" required><br><br>
            <label for="pName">Product Name:</label>
            <input type="text" name="pName" id="pName" required><br><br>
            <label for="pPrice">Product Price:</label>
            <input type="number" name="pPrice" id="pPrice" required><br><br>
            <input type="submit" value="Submit" name="updateProduct">
        </form>

    </div>

    <div id="deleteProductId" style="display: none;">
        <h1>Delete Product</h1>
        <form method="POST" action="">
            <label for="pID">Product ID:</label>
            <input type="text" name="pID" id="pID" required><br><br>
            <input type="submit" value="Submit" name="deleteProduct">
        </form>
    </div>

    <div id="searchProductId" style="display: none;">
        <h1>Search Product</h1>
        <form method="POST" action="">
            <label for="pID">Product ID:</label>
            <input type="text" name="pID" id="pID" required><br><br>
            <input type="submit" value="Submit" name="searchProduct">
        </form>
    </div>


    <?php
        $product = array();

        function openfile()
        {
            global $product;
            $product = array();
            $data = file("Product.txt");
            for ($i = 0; $i < sizeof($data); $i++) {
                $result = preg_split('/\s+/', trim($data[$i]));
                array_push($product, $result);
            }
            return $product;
        }

        $pID = rand(1, 10000);

        do {
            $isUnique = true;
            $pID = rand(1, 10000);
            foreach ($product as $p) {
                if ($p[0] == "P" . $pID) {
                    $isUnique = false;
                    break;
                }
            }
        } while (!$isUnique);

        if (isset($_POST['addProduct'])) {
            addProduct();
        } 
        
        function addProduct()
        {
            if (isset($_POST["pName"]) && isset($_POST["pPrice"])) {
                global $product, $pID;
                $product = openfile();
                $pName = $_POST["pName"];
                $pPrice = $_POST["pPrice"];
                do {
                    $isUnique = true;
                    $pID = rand(1, 10000);
                    foreach ($product as $p) {
                        if ($p[0] == "P" . $pID) {
                            $isUnique = false;
                            break;
                        }
                    }
                } while (!$isUnique);
                array_push($product, array("P" . $pID, $pName, $pPrice));
                file_put_contents("Product.txt", "");
                foreach ($product as $p) {
                    file_put_contents("Product.txt", implode(" ", $p) . "\n", FILE_APPEND);
                }
                $pID += 1;
            }
        }

        function displayProduct($products = null)
        {
            $product = openfile();
            if ($products === null) {
                $products = $product;
            }
            if (empty($products)) {
                echo "No products to display.\n";
                return;
            }
        
            echo "<div style='text-align: center;'>";
            echo "<table style='margin: 0 auto; border-collapse: collapse;'>";
            echo "<tr><th style='border: 1px solid black; padding: 8px;'>PID</th><th style='border: 1px solid black; padding: 8px;'>PName</th><th style='border: 1px solid black; padding: 8px;'>Price</th></tr>";
            foreach ($products as $p) {
                echo "<tr>";
                echo "<td style='border: 1px solid black; padding: 8px;'>" . $p[0] . "</td>";
                echo "<td style='border: 1px solid black; padding: 8px;'>" . $p[1] . "</td>";
                echo "<td style='border: 1px solid black; padding: 8px;'>" . $p[2] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "</div>";
        }              

        function searchProduct($pID)
        {
            global $product;
            $product=openfile();
            if (empty($product)) {
                echo "No products to search.\n";
                return -1;
            }
            for ($i = 0; $i < count($product); $i++) {
                if ($product[$i][0] == $pID) {
                    return $i;
                }
            }
            echo "No Product found for this ID.\n";
            return -1;
        }

        function deleteProduct($pID)
        {
            global $product;
            $product = openfile();
            if (empty($product)) {
                echo "No products to delete.\n";
                return;
            }
            $index = searchProduct($pID);
            if ($index != -1) {
                array_splice($product, $index, 1);
                echo "After deletion:\n";

                file_put_contents("Product.txt", '');
                foreach ($product as $p) {
                    file_put_contents("Product.txt", implode(" ", $p) . "\n", FILE_APPEND);
                }
                displayProduct();
            }
        }

        function updateProduct($pID)
        {
            global $product;
            $product = openfile();
            if (empty($product)) {
                echo "No products to update.\n";
                return;
            }
            $index = searchProduct($pID);
            if ($index != -1) {
                $pName = $_POST["pName"];
                $pPrice = $_POST["pPrice"];
                $product[$index] = array($pID, $pName, $pPrice);
                file_put_contents("Product.txt", '');
                foreach ($product as $p) {
                    file_put_contents("Product.txt", implode(" ", $p) . "\n", FILE_APPEND);
                }
                echo "After Updation:\n";
                displayProduct();
            }
        }

        if (isset($_POST["searchProduct"])) {
            if (isset($_POST["pID"])) {
                $index = searchProduct($_POST["pID"]);
                if ($index != -1) {
                    displayProduct(array($product[$index]));
                }
            }
        }

        if (isset($_POST["updateProduct"])) {
            if (isset($_POST["pID"])) {
                updateProduct($_POST["pID"]);
            }
        }

        if (isset($_POST["deleteProduct"])) {
            if (isset($_POST["pID"])) {
                deleteProduct($_POST["pID"]);
            }
        }

        if (isset($_POST["choice"])) {
            $choice = $_POST["choice"];
            $product = openfile();
            for ($i = 0; $i < count($product); $i++) {
                if ($product[$i][0] == $pID) {
                    $pID = rand(1, 10000);
                }
            }
            switch ($choice) {
                case '1':
                    ?>
                    <script>
                        document.getElementById("productFields").style.display = "block";
                    </script>
                    <?php
                    break;
                case '2':
                    ?>
                    <script>
                        document.getElementById("updateProductId").style.display = "block";
                    </script>
                    <?php
                    break;
                case '3':
                        ?>
                        <script>
                            document.getElementById("deleteProductId").style.display = "block";
                        </script>
                        <?php
                    break;
                    case '4':
                            ?>
                            <script>
                                document.getElementById("searchProductId").style.display = "block";
                            </script>
                            <?php
                        break;                    
                case '5':
                    displayProduct();
                    break;
                default:
                    echo "Invalid Choice";
                    break;
            }
        }
    ?>

</body>
</html>
