<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>placeholder Marketplace</title>
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
            <div class="leftgrid">
                <?php include 'sidebar.php'?>
                   
            </div>
            <!-- Left end -->
            <!-- right start -->
           
            <!-- Body start -->
            <div class="bodygrid">
                <?php
                $connection = mysqli_connect('localhost', 'root', ''); //The Blank string is the password
                mysqli_select_db($connection, 'db');
                $query = "SELECT * FROM ad900_marketplace";
                $result = mysqli_query($connection, $query);
                $array = array();
                while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
                    $array[] = $row;
                }
    
                $fp = fopen('products.json', 'w');
                fwrite($fp, print_r(json_encode($array), TRUE));
                fclose($fp);
                
                mysqli_close($connection); //Make sure to close out the database connection
                    ?>
                <ul class = cards id="charactersList"></ul>
                <!-- Footer start -->
            <?php include 'footer.php' ?>
            <!-- Footer end -->
            </div>
            <!-- Body end -->
            
        </div>
    </body>
</html>