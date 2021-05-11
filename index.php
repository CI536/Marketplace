<?php session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Student Marketplace</title>
        <link href="css/normalize.css" rel="stylesheet" />
        <link href="css/stylesheet.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
        <script src ="js/searchBar.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src ="js/marketplace-newprod.js"></script>
    </head>
    <body>
        <div class="marketplaceContainer">
            <!-- Header start -->
                <?php include 'header.php' ?>
            <!-- Header end -->
            <!-- Left start -->
            <div id="sidebar">
                <?php include 'sidebar.php'?>
            </div>
            <!-- Left end -->
            <!-- right start -->
           
            <!-- Body start -->
            <div class="bodygrid">
                <?php
                require 'php/dbh.inc.php';
                if (isset($conn)) {
                    $stmt = mysqli_stmt_init($conn);
                }else{
                    header("../index.php?error=mysqlerror");
                    exit();
                }
                $query = "SELECT * FROM marketplace";
                if (!mysqli_stmt_prepare($stmt, $query)) {
                    header("location: ../login.php?error=sqlerror");
                    exit();
                }else{
                    $result = mysqli_query($conn, $query);
                    $array = array();
                    while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
                        $array[] = $row;
                    }
                    $fp = fopen('products.json', 'w');
                    fwrite($fp, print_r(json_encode($array), TRUE));
                    fclose($fp);

                    mysqli_close($conn); //Make sure to close out the database connection
                }
                    ?>
                <ul class="cards" id="productsList"></ul>
            </div>
            <!-- Body end -->
            <!-- Footer start -->
            <?php include 'footer.php' ?>
            <!-- Footer end -->
        </div>
    </body>
</html>