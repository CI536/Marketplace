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

    
    <h3>Filter by</h3>
    
    <h4>Price</h4>
    <input type="range" id="amount">
    
    <h4>Category</h4>
    <ul>
        <li><a href="#"><label for "all">Show all</label>
        <input type="checkbox" class="preventUncheck" id="all" name="all" checked></a></li>
        <li><a href="#"><label for "vehicle">Vehicles</label>
        <input type="checkbox" class="preventUncheck" id="vehicle" name="vehicle"></a></li>
        <li><a href="#"><label for "clothing">Clothes</label>
        <input type="checkbox" class="preventUncheck" id="clothing" name="clothing"></a></li>
        <li><a href="#"><label for "electronics">Electronics</label>
        <input type="checkbox" class="preventUncheck" id="electronics" name="electronics"></a></li>
        <li><a href="#"><label for "books">Books</label>
        <input type="checkbox" class="preventUncheck" id="books" name="books"></a></li>
          <li><a href="#"><label for "books">Accessories</label>
        <input type="checkbox" class="preventUncheck" id="accessories" name="accessories"></a></li>
    </ul>
    
  </div>
</div>