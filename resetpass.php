<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>placeholder Students Login</title>
        <link href="css/normalize.css" rel="stylesheet" />
        <link href="css/stylesheet.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
        <script src="js/login.js"></script>
        <script src="js/resetpass.js"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
                <div class="formcontainer">
                    <form id="form" name="form" action="php/resetpass.php" method="post">
                        <h3>- RESET PASSWORD -</h3>
                        <fieldset>
                            <legend>User Name</legend>
                            <input type="text" name="mailuid" id="username" placeholder="Your user name here">
                            <span class="email_error"></span>
                        </fieldset>
                        <input name="resetpass-submit" type="submit" id="resetpass-submit" value="RESET" />
                    </form>
                </div>
            </div>
            <!-- Body end -->
            <!-- Footer start -->
            <?php include 'footer.php' ?>
            <!-- Footer end -->
        </div>
    </body>
</html>