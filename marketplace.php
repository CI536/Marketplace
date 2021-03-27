<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>placeholder Marketplace</title>
        <link href="css/normalize.css" rel="stylesheet" />
        <link href="css/stylesheet.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
        <script src ="js/searchBar.js"></script>
    </head>
    <body>
        <div class="container">
            <!-- Header start -->
            <?php include 'header.php' ?>
            <!-- Header end -->
            <!-- Left start -->
            <div class="leftgrid">
                <div class="sidenav">
                    <div id="searchWrapper">
                        <input type="text" 
                         name="searchBar"
                         id="searchBar" 
                         placeholder="Search">
                    </div>
                    <a href="#">Browse all</a>
                    <a href="#">Notifications</a>
                    <a href="#">Basket</a>
                    <a href="#">+ Create New Listing</a>
                    <a href="#">Filters</a>
                    <a href="#">Vehicles</a>
                    <a href="#">Clothing</a>
                    <a href="#">Electronics</a>
                    <a href="#">University Material</a>
                  </div>
            </div>
            <!-- Left end -->
            <!-- right start -->
           
            <!-- Body start -->
            <div class="bodygrid">
                <ul class = cards id="charactersList"></ul> <!--it will be populated in js/searchBar.js-->
            </div>
            <!-- Body end -->
            <!-- Footer start -->
            <?php include 'footer.php' ?>
            <!-- Footer end -->
        </div>
    </body>
</html>