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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src ="js/searchBar.js"></script>
    </head>
    <body>
        <div class="marketplaceContainer">
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
                    <a href="#">Notifications</a>
                    <a href="#">Basket</a>
                    <a href="#">+ Create New Listing</a>
                    
                    <h3>Order by</h3>
                    <ul>
                        <li><div class="dropdown">
                        <button onclick="myFunction()" class="dropbtn">Publish date: latest</button>
                        <div id="myDropdown" class="dropdown-content">
                            <a href="#">Publish date: latest</a>
                            <a href="#">Publish date: oldest</a>
                        </div>
                    </div></li>
                        <li> <div class="dropdown">
                        <button onclick="myFunction()" class="dropbtn">Price: lower</button>
                        <div id="myDropdown" class="dropdown-content">
                            <a href="#">Price: lower</a>
                            <a href="#">Price: higher</a>
                        </div>
                    </div></li>
                            
                    </ul>
                    
                   
                
                    
                    <h3>Filter by</h3>
                    
                    <h4>Location</h4>
                    <input type="text" id="postcode" placeholder="Search by postcode">
                    
                    <h4>Price</h4>
                    <input type="range" id="amount">
                    
                    <h4>Category</h4>
                    <ul>
                        <li><a href="#"><label for "all">Show all</label>
                        <input type="checkbox" id="all" name="all" checked></a></li>
                        <li><a href="#"><label for "vehicle">Gryffindor</label>
                        <input type="checkbox" id="vehicle" name="vehicle"></a></li>
                        <li><a href="#"><label for "clothing">Slytherin</label>
                        <input type="checkbox" id="clothing" name="clothing"></a></li>
                        <li><a href="#"><label for "electronics">Hufflepuff</label>
                        <input type="checkbox" id="electronics" name="electronics"></a></li>
                        <li><a href="#"><label for "books">Ravenclaw</label>
                        <input type="checkbox" id="books" name="books"></a></li>
                    </ul>
                    
                  </div>
            </div>
            <!-- Left end -->
            <!-- right start -->
           
            <!-- Body start -->
            <div class="bodygrid">
                <ul class = cards id="charactersList"></ul>
            </div>
            <!-- Body end -->
            <!-- Footer start -->
            <?php include 'footer.php' ?>
            <!-- Footer end -->
        </div>
    </body>
</html>