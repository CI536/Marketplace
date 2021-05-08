<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>placeholder students Login</title>
        <link href="css/normalize.css" rel="stylesheet" />
        <link href="css/stylesheet.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
        <script src="js/fadein.js"></script>
        <script src="js/login.js"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
                <div class="formcontainer">
                    <form id="form" name="form" action="php/login.inc.php" method="post">
                        <h3>- LOG IN -</h3>
                        <fieldset>
                            <legend>Email address</legend>
                            <input type="text" name="mailuid" id="username" placeholder="Your email address here">
                            <span class="username_error"></span>
                        </fieldset>
                        <fieldset>
                            <legend>Password</legend>
                            <input type="password" name="pwd" id="password" placeholder="Your password here">
                            <span class="password_error"></span>
                        </fieldset>
                        <a href="signup.php">Create an Account</a>
                        <br>
                        <a href="resetpass.php">Forgot my password</a>
                        <fieldset>
                            <input name="login-submit" type="submit" id="login-submit" value="SIGN IN" />
                        </fieldset>
                        <div class="g-recaptcha" data-sitekey="6LfVNnQaAAAAADRv-Aje12JR733tVWudQNrHTxm1"></div>
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