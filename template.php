<!doctype html>
<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
    <nav class="navbar navbar-expand-sm bg-success">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php" ><img rel="home logo" src="https://www.icegif.com/wp-content/uploads/icegif-1304.gif" height="100px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="contact.php">Contact us</a>
                    </li>
                    <?php
                    if (isset($_SESSION["firstName"])) {
                        echo '<li class="nav-item" ><a class="nav-link" href = "orderForm.php"> Order Form </a ></li >';
                        echo '<li class="nav-item" ><a class="nav-link" href = "invoice.php"> Invoice</a ></li >';
                    } else {
                        echo '<li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>';
                    }
                    if (isset($_SESSION["AccessLevel"])) {
                        if ($_SESSION["AccessLevel"] == 1) {
    //                        echo '123';
                            ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                    Product Management
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="addProduct.php">Add Products</a></li>
                                    <li><a class="dropdown-item" href="productList.php">Product List</a></li>
                                </ul>
                            </li>
                            <?php
                        }
                    }

                    ?>
                </ul>
            </div>
            <?php
            if ($_SESSION["AccessLevel"] == 2) {
           echo '<img src="images/user.png" height="150px">';
            }
            if ($_SESSION["AccessLevel"] == 1) {
                echo '<img src="images/admin.png" height="100px"><h>   </h>';
            }

            if (isset($_SESSION["firstName"])) {
                echo '<div class="bg-light">Welcome, ' . $_SESSION["firstName"] . '!<a class="nav-link" href="logout.php">Logout</a></div>';
            }

            ?>
        </div>
    </nav>
<?php
if (isset($_SESSION['flash_message'])) {
    $message = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
//    echo $message;
    ?>
    <div class="position-absolute bottom-0 end-0">
        <?= $message ?>

    </div>


    <?php
}
?>
<script src="js/bootstrap.bundle.min.js"></script>
<?php

//session_start();

$conn = new SQLite3("db") or die("unable to open database");

$productNames = array("product1"=>"Darth Vader Helmet", "product2"=>"Grogu Plush", "product3"=>"ROTJ Jigsaw", "product4"=>"Aftermath", "product5"=>"Alphabet Squadron");
$productPrices= array("product1"=>299.0, "product2"=>32.95, "product3"=>219.95, "product4"=>24.95, "product5"=>25.95);
function footer():string {
    date_default_timezone_set('Australia/Canberra');
    $filename = basename($_SERVER["SCRIPT_FILENAME"]);
    $footer = "This page was last modified: " . date( "F d Y H:i:s.", filemtime($filename));
    return $footer;
}

function sanitiseData($unsanitisedData) {
    $unsanitisedData = trim($unsanitisedData);
    $unsanitisedData = stripslashes($unsanitisedData);
    $sanitisedData = htmlspecialchars($unsanitisedData);
    return $sanitisedData;


}
?>
