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
    <script src="js/register.js"></script>
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

            <div class="formsignup">
                
                <form id="form" action="php/signup.inc.php" method="post">
                    
                    <h3>- REGISTER -</h3>
                    
                    <fieldset>
                        <input type="text" name="uid" id="uid" placeholder="Full Name">
                    </fieldset>
                    
                    <fieldset>
                        <input  type="text" name="studentNo" id="studentNo" placeholder="Student Number">
                        <span class="studentNo_error"></span>
                    </fieldset>
                    
                    <fieldset>
                        <input type="text" name="email" id="email" placeholder="Student e-mail">
                        <span class="email_error"></span>
                    </fieldset>
                    
                    <fieldset>
                        <input type="text" name="pwd" id="pwd" placeholder="Password">
                        <span class="password_error"></span>
                    </fieldset>
                    
                    <fieldset>
                        <input type="text" name="pwd-repeat" id="pwd-repeat" placeholder="Repeat Password">
                         <span class="passwordRepeat_error"></span>
                    </fieldset>

                    <a href="login.php">Already registered? Log in here</a>
                    
                    <fieldset>
                            <input name="signup-submit" type="submit" id="signup-submit" value="SIGN UP" />
                    </fieldset>
                    
                </form>
                
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