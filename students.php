<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>placeholder Students</title>
        <link href="css/normalize.css" rel="stylesheet" />
        <link href="css/stylesheet.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
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
            <!-- right start -->
            <div class="rightgrid">
            </div>
            <!-- right end -->
            <!-- Body start -->
            <div class="bodygrid">
                <h1 class="pagetitle">- Students -</h1>
                <ol class="cards">
                    <li class="card">
                        <div class="card-content">
                            <a href="studentdata/timamis/studentpage.html">
                                <img src="studentdata/timamis/profile.jpg" alt="placeholder1 Profile Picture">
                                <p>Tim Amis</p>
                            </a>
                        </div>
                    </li>
                    <li class="card">
                        <div class="card-content">
                            <a href="studentdata/andreadelphra/studentpage.html">
                                <img src="studentdata/andreadelphra/profile.jpg" alt="placeholder2 Profile Picture">
                                <p>Andrea Dhelpra</p>
                            </a>
                        </div>
                    </li>
                    <li class="card">
                        <div class="card-content">
                            <a href="studentdata/shakirreadhead/studentpage.html">
                                <img src="studentdata/shakirreadhead/profile.jpg" alt="placeholder3 Profile Picture">
                                <p>Shakir Readhead</p>
                            </a>
                        </div>
                    </li>
                    <li class="card">
                        <div class="card-content">
                            <a href="studentdata/adhamsayed/studentpage.html">
                                <img src="studentdata/adhamsayed/profile.jpg" alt="placeholder3 Profile Picture">
                                <p>Adham Sayed</p>
                            </a>
                        </div>
                    </li>
                    <li class="card">
                        <div class="card-content">
                            <a href="studentdata/adnantakriti/studentpage.html">
                                <img src="studentdata/adnantakriti/profile.jpg" alt="placeholder3 Profile Picture">
                                <p>Adnan Takriti</p>
                            </a>
                        </div>
                    </li>
                </ol>
            </div>
            <!-- Body end -->
            <!-- Footer start -->
            <?php include 'footer.php' ?>
            <!-- Footer end -->
        </div>
    </body>
</html>