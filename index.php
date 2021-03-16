<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>placeholder</title>
        <link href="css/normalize.css" rel="stylesheet" />
        <link href="css/stylesheet.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
        <script src="js/fadein.js"></script>
    </head>
    <body>
        <div class="container">
            <!-- Header start -->
            <?php include 'header.php' ?>
            <!-- Header end -->
            <!-- Left start -->
            <div class="leftgrid">
                <img id="placeholder-logo-left" src="images/placeholder-logo-left.png" alt="placeholder Logo Left" />
            </div>
            <!-- Left end -->
            <!-- right start -->
            <div class="rightgrid">
                <img id="placeholder-logo-right" src="images/placeholder-logo-right.png" alt="placeholder Logo Right" />
            </div>
            <!-- right end -->
            <!-- Body start -->
            <div class="bodygrid">
                <div id="wrapper">
                    <img class="indexlogo" src="images/placeholder-text.png" alt="placeholder Text">
                </div>
            </div>
            <!-- Body end -->
            <!-- Footer start -->
            <?php include 'footer.php' ?>
            <!-- Footer end -->
        </div>
    </body>
</html>