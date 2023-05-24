<?php

?>
<html>

<head>
    <title>E-Commerce</title>
    <link rel='stylesheet' href='css/style.css'>
</head>

<body>
    <!-- top header -->
    <header>
        <!-- heading space -->
        <div id='topBanner'>
            <?php include 'topHeader.php' ?>
        </div>
        <hr />
        <!-- navigation bar -->
        <div id='bottomBanner'>
            <?php include 'bottomHeader.php' ?>
        </div>
    </header>

    <!-- shows the main content upon selecting the apt choice -->
    <div class="content">
    <?php
            $clicked = 0;
            if (array_key_exists('clicked', $_GET) && $clicked = $_GET['clicked']) {
                switch ($clicked) {
                    case 0:
                        include 'home.php';
                        break;
                    case 1:
                        include 'product.php';
                        break;
                    case 2:
                        include 'category.php';
                        break;
                    case 3:
                        include 'customer.php';
                        break;
                    case 4:
                        include 'order.php';
                        break;
                    default:
                        include 'home.php';
                        break;
                }
            }
            else if (array_key_exists('custid', $_GET) || array_key_exists('qty', $_GET)){
                include 'order.php';
            }
            // default to be shown on page load
            else echo "<p class='snack'>Select one of the options to proceed!</p>";
            ?>
    </div>
    
</body>

</html>