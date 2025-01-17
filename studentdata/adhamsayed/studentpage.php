<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>student Template</title>
        <link href="../../css/normalize.css" rel="stylesheet" />
        <link href="../../css/stylesheet.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
        <script src="../../js/slideshow.js"></script>
    </head>
    <body>
        <div class="container">
            <!-- Header start -->
            <div class="headergrid">
                <header>
                    <nav>
                        <a href="../../index.php" class="nav">PLACEHOLDER</a>
                        <div class="fltrt">
                            <a href="../../students.php" class="headernav">STUDENTS</a>
                            <p class="navbreak">.</p>
                            <a href="../../marketplace.php" class="headernav">MARKETPLACE</a>
                            <p class="navbreak">.</p>
                            <a href="../../php/studentportal.php" class="headernav">LOGIN</a>
                            <div class="socialblock">
                                <a href="">
                                    <img class="navsocial" src="../../images/icons/youtube-icon.png" alt="Youtube Icon" />
                                </a>
                                <a href="">
                                    <img class="navsocial" src="../../images/icons/facebook-icon.png"  alt="Facebook Icon" />
                                </a>
                                <a href="">
                                    <img class="navsocial" src="../../images/icons/soundcloud-icon.png"  alt="Soundcloud Icon" />
                                </a>
                                <div class="dropdown">
                                    <img class="navmenu" src="../../images/icons/menu-icon.png" alt="Menu Icon" />
                                    <div class="dropdown-content">
                                        <a href="../../students.php">STUDENTS</a>
                                        <br />
                                        <a href="../../marketplace.php">MARKETPLACE</a>
                                        <br />
                                        <a href="../../php/studentportal.php">LOGIN</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                </header>
            </div>
            <!-- Header end -->
            <!-- Left start -->
            <div class="leftgrid">
            </div>
            <!-- Left end -->
            <!-- right start -->
            <div class="rightgrid">
            </div>
            <!-- right end -->
            <!-- Body start -->
            <div class="bodygrid">
                <div class="student-content">
                    <h1 class="student-content-name">- students Name -</h1>
                    <img class="student-content-img" src="../../studentdata/placeholder/profile.jpg"  alt="student Profile Picture">
                    <p class="student-content-blurb">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus lacinia imperdiet magna, eget faucibus ex pretium nec. Nullam non metus egestas, vulputate arcu ut, molestie lacus. Nunc porttitor porttitor lacus, eget vulputate justo congue in. Maecenas lorem metus, egestas at augue quis, mattis congue massa. Vestibulum consectetur nibh sed enim lacinia, in hendrerit lorem pellentesque. Donec at facilisis metus. Donec ultricies interdum mauris, non posuere elit luctus at. Praesent eu leo a nibh eleifend imperdiet id ut magna. Etiam ornare consequat scelerisque. Proin mollis malesuada quam id feugiat. In luctus lectus et tortor consectetur dignissim. Aenean mattis lectus in purus finibus, ac ultrices turpis hendrerit. </p>
                    <h1 class="student-content-stitle">- Social Media -</h1>
                    <ul class="student-content-scontent">
                        <li>
                            <a href="">
                                <img class="fltlt" src="../../images/icons/soundcloud-icon.png"  alt="Soundcloud Icon">
                                <p>Soundcloud</p>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img class="fltlt" src="../../images/icons/bandcamp-icon.png" alt="Bandcamp Icon">
                                <p>Bandcamp</p>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img class="fltlt" src="../../images/icons/facebook-icon.png" alt="Facebook Icon">
                                <p>Facebook</p>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img class="fltlt" src="../../images/icons/instagram-icon.png" alt="Instagram Icon">
                                <p>Instagram</p>
                            </a>
                        </li>
                    </ul>
                    <h1 class="student-content-rtitle">- marketplace -</h1>
                    <div class="student-content-rcontent">
                         <!-- Slideshow container -->
                        <div class="slideshow-container">

                          <!-- Full-width images with number and caption text -->
                          <div class="mySlides fade">
                            <a href="">
                                <img class="slideIMG" src="../../studentdata/placeholder/marketplace/artwork.jpg" alt="listing Artwork 1">
                            </a>
                          </div>

                          <div class="mySlides fade">
                            <a href="">
                                <img class="slideIMG" src="../../studentdata/placeholder/marketplace/artwork.jpg" alt="listing Artwork 2">
                            </a>
                          </div>

                          <div class="mySlides fade">
                            <a href="">
                                <img class="slideIMG" src="../../studentdata/placeholder/marketplace/artwork.jpg" alt="listing Artwork 3">
                            </a>
                          </div>

                          <!-- Next and previous buttons -->
                          <a class="prev">&#10094;</a>
                          <a class="next">&#10095;</a>
                        </div>
                        <br>

                        <!-- The dots/circles -->
                        <div class="centeralign">
                          <span class="dot"></span>
                          <span class="dot"></span>
                          <span class="dot"></span>
                        </div> 
                    </div>
                </div>
            </div>
            <!-- Body end -->
            <!-- Footer start -->
            <div class="footergrid">
                <footer>
                    <a href="../../index.php">Home</a>
                    <p class="navbreak">.</p>
                    <a href="../../students.php">Students</a>
                    <p class="navbreak">.</p>
                    <a href="../../marketplace.php">Marketplace</a>
                    <p class="navbreak">.</p>
                    <a href="studentportal.php">Login</a>
                    <p class="navbreak">.</p>
                    <a href="../../privacy.php">Privacy Policy</a>
                    <p class="navbreak">.</p>
                    <a href="../../termsconditions.php">Terms & Conditions</a>
                    <p class="navbreak">.</p>
                    <a href="../../contact.php">Contact Us</a>
                    <p class="navbreak">.</p>
                    <a href="../../about.php">About Us</a>
                    <p>© 2021 placeholder</p>
                </footer>
            </div>
            <!-- Footer end -->
        </div>
    </body>
</html>