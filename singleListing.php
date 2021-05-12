<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>placeholder Single Listing</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link href="css/normalize.css" rel="stylesheet" />
        <link href="css/stylesheet.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
        <script src="js/slideshow.js"></script>
    </head>
    <body>
        <div class="container">
            <!-- Header start -->
            <?php include 'header.php' ?>
            <!-- Header end -->
            <!-- Left start -->
            <div class="leftgrid">
            </div>
           <!-- Left end -->
           <!-- Right start -->
           <div class="rightgrid">
           </div>
            <!-- Right end -->
            <!-- Body start -->
            <div class="bodygrid">
                <div class = profile-details>
                    <figure class="profileimg">
                        <img src="studentdata/placeholder/profile.jpg"  alt="student Profile Picture" height="70" width="70">
                    </figure>
                    <ul class="myDetails">
                    <?php
                        $string = file_get_contents("products.json");
                        $json_a = json_decode($string, true);
                        foreach ($json_a as $key => $jsons) {
                            foreach($jsons as $key => $value) {
                                if($key == 'listingID' && $value == $_GET['listingID']){
                                    $listingName =  $jsons['listingName'];
                                    $fileName =  $jsons['fileName'];
                                    $listingBio = $jsons['listingBio'];
                                    $listingPrice = $jsons['listingPrice'];
                                    }
                                }
                        }
                        ?>
                        <li class ="profileText">Name</li>
                        <li class ="profileText">Course</li>
                        <li class ="profileText">Year</li>
                        <li class ="profileText">Contact details</li>
                    </ul>
                </div>
                <div class="student-content">
                    
                    <h1 class="student-content-rtitle"><?php echo $listingName; ?></h1>
                    <div class="student-content-rcontent">
                        <!-- Slideshow container -->
                        <div class="slideshow-container">
                            <!-- Full-width images with number and caption text -->
                            <div class="mySlides fade">
                                <a href="">
                                <img class="profile-slideIMG" src="images/<?php echo $fileName; ?>" alt="listing Artwork 1">
                                </a>
                            </div>
                            <div class="mySlides fade">
                                <a href="">
                                    <img class="profile-slideIMG" src="images/<?php echo $fileName; ?>" alt="listing Artwork 2">
                                </a>
                            </div>
                            <div class="mySlides fade">
                                <a href="">
                                    <img class="profile-slideIMG" src="images/<?php echo $fileName; ?>" alt="listing Artwork 3">
                                </a>
                            </div>
                            <!-- Next and previous buttons -->
                            <a class="prev">&#10094;</a>
                            <a class="next">&#10095;</a>
                        </div>
                         <!-- The dots/circles -->
                        <div class="centeralign">
                            <span class="dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                        </div>
                    <div class = "item-details">
                        <h2>Price</h2>
                    <p>£ <?php echo $listingPrice; ?></p>
                    <h2>Details</h2>
                    <p><?php echo $listingBio; ?></p>
                    </div>
                    
                    </div>
               </div>
            </div>
            <!-- Body end -->
            <!-- Footer start -->
            <?php include 'footer.php' ?>
            <!-- Footer end -->
        </div>
    </body>
</html>