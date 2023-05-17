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
    <?php
        $product = array();

        function openfile()
        {
            global $product;
            $data = file("Product.txt");
            for ($i = 2; $i < sizeof($data); $i++) {
                $result = preg_split('/\s+/', trim($data[$i]));
                array_push($product, $result);
            }
        }

        $pID=rand(1,10);

        function addProduct()
        {

            if(isset($_POST["pName"])){
                global $product, $pID;
                $pName = $_POST["pName"];
                while (strlen($pName) > 20) {
                    echo "The PName must not be greater than 20 characters\n";
                    $pName = readline("Enter the updated name: ");
                }
                $pPrice = $_POST["pPrice"];
                array_push($product, array("P" . $pID, $pName, $pPrice));
    
                $fileLine = "P" . $pID . " " . $pName . " " . $pPrice . "\n";
                file_put_contents("Product.txt", $fileLine, FILE_APPEND);
                $pID += 1;
            }

        }

        function displayProduct()
        {
            global $product;
            if (empty($product)) {
                echo "No products to display.\n";
                return;
            }
            echo "PID PName" . str_repeat(" ", 15) . "Price\n";
            foreach ($product as $p) {
                $space = str_repeat(" ", 20 - strlen($p[1]));
                echo $p[0] . "  " . $p[1] . $space . $p[2] . "\n";
            }
        }

        function searchProduct($pID)
        {
            global $product;
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
            if (empty($product)) {
                echo "No products to delete.\n";
                return;
            }
            $index = searchProduct($pID);
            if ($index != -1) {
                array_splice($product, $index, 1);
                echo "After deletion:\n";

                $fileLines = file("Product.txt");
                unset($fileLines[$index + 2]); // Skip the first two lines
                file_put_contents("Product.txt", implode("", $fileLines));
                displayProduct($product);
            }
        }

        function updateProduct($pID)
        {
            global $product;
            if (empty($product)) {
                echo "No products to update.\n";
                return;
            }
            $index = searchProduct($pID);
            if ($index != -1) {
                $pName = $_POST["pName"];
                while (strlen($pName) > 20) {
                    echo "The PName must not be greater than 20 characters:";
                    $pName = readline("Enter the updated name: ");
                }
                $pPrice = $_POST["pPrice"];
                $product[$index] = array($pID, $pName, $pPrice);
                echo "After Updation:\n";
                displayProduct();
                $fileLines = file("Product.txt");
                $fileLines[$index + 2] = "P" . $pID . " " . $pName . " " . $pPrice . "\n";
                file_put_contents("Product.txt", implode("", $fileLines));
            }
        }

        function test(){
            echo "Testing";
        }

        if(isset($_POST["choice"])){
            $choice=$_POST["choice"];
            openfile();
            for ($i = 0; $i < count($product); $i++) {
                if($product[$i][0]==$pID){
                    $pID=rand(1,10);
                }
            }
            switch ($choice) {
                case '1':
                    echo '
                    <div id="productFields" style="display: none;">
                        <label for="pName">Product Name:</label>
                        <input type="text" name="pName" id="pName" required><br><br>
                    
                        <label for="pPrice">Product Price:</label>
                        <input type="number" name="pPrice" id="pPrice" required><br><br>
                    </div>
                    ';
                    // addProduct();
                    break;
                case '2':
                    // updateProduct($_POST["pID"]);
                    echo "Update Products";
                    break;
                case '3':
                    // deleteProduct($_POST["pID"]);
                    echo "Delete Products";
                    break;
                case '4':
                    // $index = searchProduct($_POST["pID"]);
                    // if ($index != -1) {
                    //     displayProduct(array($product[$index]));
                    // }
                    echo "Search Products";
                    break;
                case '5':
                    // displayProduct($product);
                    echo "Display Products";
                    break;
                default:
                    echo "Invalid Choice";
                    break;
            }
        }
?>
</body>
</html>
