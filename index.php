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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src ="js/searchBar.js"></script>
        <script src ="js/marketplace-newprod.js"></script>
    </head>
    <body>
        <div class="marketplaceContainer">
            <!-- Header start -->
            <?php include 'header.php' ?>
            <!-- Header end -->
            <!-- Left start -->
            <div class="leftgrid">
                <div class="sidenavContainer">
                    <div class = "sidenav">
                         <div id="searchWrapper">
                        <input type="text" 
                         name="searchBar"
                         id="searchBar" 
                         placeholder="Search">
                    <button class="searchBtn"><i class="fa fa-search"></i></button>
                    </div>
                    <form class="portalbutton" action="" method="post">
                        <input type="submit" value="New Listing" name="newlisting-submit" id="newlisting-submit">
                    </form>
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
                        <button onclick="myFunction()" class="dropbtn">Price: low to high</button>
                        <div id="myDropdown" class="dropdown-content">
                            <a href="#">Price: low to high</a>
                            <a href="#">Price: high to low</a>
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
                        <input type="checkbox" class="preventUncheck" id="all" name="all" checked></a></li>
                        <li><a href="#"><label for "vehicle">Gryffindor</label>
                        <input type="checkbox" class="preventUncheck" id="vehicle" name="vehicle"></a></li>
                        <li><a href="#"><label for "clothing">Slytherin</label>
                        <input type="checkbox" class="preventUncheck" id="clothing" name="clothing"></a></li>
                        <li><a href="#"><label for "electronics">Hufflepuff</label>
                        <input type="checkbox" class="preventUncheck" id="electronics" name="electronics"></a></li>
                        <li><a href="#"><label for "books">Ravenclaw</label>
                        <input type="checkbox" class="preventUncheck" id="books" name="books"></a></li>
                    </ul>
                    
                  </div>
                    </div>
                   
            </div>
            <!-- Left end -->
            <!-- right start -->
           
            <!-- Body start -->
            <div class="bodygrid">
                <?php
                $connection = mysqli_connect('localhost', 'root', ''); //The Blank string is the password
                mysqli_select_db($connection, 'db');
                $query = "SELECT * FROM marketplace";
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