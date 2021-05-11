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
    <script src="js/signup.js"></script>
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
            <section>
                <div class="formcontainer">
                    <form id="form" class="form-signup" action="php/signup.inc.php" method="post">
                        <h3>- SIGN UP FORM -</h3>
                        <fieldset>
                                <input id="name" type="text" name="uid" placeholder="Full Name">
                                <span class="name_error"></span>
                        </fieldset>
                        
                        <fieldset>
                                <input id="studentNO" type="text" name="studentNo" placeholder="Student Number">
                                <span class="studentNO_error"></span>
                        </fieldset>
                        
                        <fieldset>
                                <input id="username" type="text" name="email" placeholder="E-mail">
                                <span class="username_error"></span>
                        </fieldset>
                        
                        <fieldset>
                                <input id="password" type="text" name="pwd"  placeholder="Password">
                                <span class="password_error"></span>
                        </fieldset>
                        
                        <fieldset>
                                <input id="password2" type="text" name="pwd-repeat" placeholder="Repeat Password">
                                <span class="password2_error"></span>
                        </fieldset>
                        <br>
                        <fieldset>
                            <input id="signup-submit" type="submit" name="signup-submit" value="Submit"></input>
                        </fieldset>
                    </form>
                </div>
            </section>
        </div>
    </div>
    <!-- Body end -->
    <!-- Footer start -->
    <?php include 'footer.php' ?>
    <!-- Footer end -->
</div>
</body>
</html>