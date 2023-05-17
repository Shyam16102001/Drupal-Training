<?php
$product=array();
function openfile(){
    global $product;
    $data=file("Product.txt");
    $product = array();
    for($i=0;$i<sizeof($data);$i++){
        $result = preg_split('/\s+/', trim($data[$i]));
        array_push($product, $result);
    }
}
$pID=rand(1,10);

function addProduct(){
    global $product, $pID;
    $pName = readline("Enter Product name: ");
    while(strlen($pName)>20){
        echo "The PName must not be greater than 20 characters\n";
        $pName = readline("Enter the updated name: ");
    }
    $pPrice = readline("Enter Product price: ");
    array_push($product, array("P".$pID, $pName, $pPrice));
    file_put_contents("Product.txt", '');
    foreach ($product as $p){
        file_put_contents("Product.txt",implode(" ",$p)."\n",FILE_APPEND);
    }
    $pID += 1;
}

function displayProduct($product){
    if (empty($product)) {
        echo "No products to display.\n";
        return;
    }
    echo "PID PName".str_repeat(" ", 15)."Price\n";
   for ($i = 0; $i < count($product); $i++) {
    $space = str_repeat(" ", 20 - strlen($product[$i][1]));
    echo $product[$i][0] . "  " . $product[$i][1] . $space . $product[$i][2] . "\n";
}

}


function searchProduct($pID){
    global $product;
    if (empty($product)) {
        echo "No products to search.\n";
        return -1;
    }
    for ($i = 0; $i < count($product); $i++) {
        if($product[$i][0]==$pID){
            return $i;
        }
    }
    echo "No Product found for this ID.\n";
    return -1;
}

function deleteProduct($pID){
    global $product;
    if (empty($product)) {
        echo "No products to delete.\n";
        return;
    }
    $index = searchProduct($pID);
    if($index!=-1){
        array_splice($product, $index, 1);
        echo "After deletion:\n";
        
        file_put_contents("Product.txt", '');
        foreach ($product as $p){
            file_put_contents("Product.txt",implode(" ",$p)."\n",FILE_APPEND);
        }
        displayProduct($product);
    }
}

function updateProduct($pID){
    global $product;
    if (empty($product)) {
        echo "No products to update.\n";
        return;
    }
    $index = searchProduct($pID);
    if($index!=-1){
        $pName = readline("Enter Updated Product name: ");
        while(strlen($pName)>20){
            echo "The PName must not be greater than 20 characters:";
            $pName = readline("Enter the updated name: ");
        }
        $pPrice = readline("Enter Updated Product price: ");
        $product[$index] = array($pID, $pName, $pPrice);
        
        file_put_contents("Product.txt", '');
        foreach ($product as $p){
            file_put_contents("Product.txt",implode(" ",$p)."\n",FILE_APPEND);
        }
        
        echo "After Updation:\n";
        displayProduct($product);
        
    }
}
do{
    openfile();
    for ($i = 0; $i < count($product); $i++) {
        if($product[$i][0]==$pID){
            $pID=rand(1,10);
        }
    }
    echo "\n-------------------------------------------\nOptions:\n1. Add Product\n2.Update Product\n3.Delete Product\n4.Search Product\n5.Display Products\n6.Exit.\n";
    $choice = readline("Enter the Choice: ");
    switch ($choice) {
        case '1':
            addProduct();
            break;
        
        case '2':
            updateProduct(readline("Enter the PID of the product to be updated: "));
            break;
        
        case '3':
            deleteProduct(readline("Enter the PID of the product to be deleted: "));
            break;
        
        case '4':
            $index = searchProduct(readline("Enter the PID of the product to be searched: "));
            if($index !=-1){
                displayProduct(array($product[$index]));
            }
            break;
        
        case '5':
            displayProduct($product);
            break;
            
        case '6':
            break;
        
        default:
            echo "Invalid Choice";
            break;
    }
}while($choice!=6);
