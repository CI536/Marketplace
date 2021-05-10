<div class="sidenavContainer">
    <div class = "sidenav">
         <div id="searchWrapper">
        <input type="text" 
         name="searchBar"
         id="searchBar" 
         placeholder="Search">
    <button class="searchBtn"><i class="fa fa-search"></i></button>
    </div>
    <!-- Home link -->
    <a href="index.php">Home</a>
    
    <!-- Log in/ Profile link -->
    <?php
        if (isset($_SESSION['studentID'])) {
            echo '<a href="studentportal.php">Profile</a>';
            //new listing button appearing when user is logged in
            echo '<form class="portalbutton" id = "sidebar_button" action="" method="post">
                    <input type="submit" value="New Listing" name="newlisting-submit" id="newlisting-submit"> 
                 </form>';
        }else{
            echo '<a href="studentportal.php">Log in</a>';
        }
    ?>
    
   
   
    
    <!--<h3>Order by</h3>-->
    <!--<ul>-->
    <!--    <li><div class="dropdown">-->
    <!--    <button onclick="myFunction()" class="dropbtn">Publish date: latest</button>-->
    <!--    <div id="myDropdown" class="dropdown-content">-->
    <!--        <a href="#">Publish date: latest</a>-->
    <!--        <a href="#">Publish date: oldest</a>-->
    <!--    </div>-->
    <!--</div></li>-->
    <!--    <li> <div class="dropdown">-->
    <!--    <button onclick="myFunction()" class="dropbtn">Price: low to high</button>-->
    <!--    <div id="myDropdown" class="dropdown-content">-->
    <!--        <a href="#">Price: low to high</a>-->
    <!--        <a href="#">Price: high to low</a>-->
    <!--    </div>-->
    <!--</div></li>-->
            
    <!--</ul>-->
    
    <h3>Filter by</h3>
    
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