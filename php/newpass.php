<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>placeholder Students Login</title>
        <link href="../css/normalize.css" rel="stylesheet" />
        <link href="../css/stylesheet.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
        <script src="../js/fadein.js"></script>
        <script src="../js/login.js"></script>
        <script src="../js/newpass.js"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
    <body>
        <div class="container">
            <!-- Header start -->
            <?php include 'header.php' ?>
            <!-- Header end -->
            <!-- Left start -->
            <div class="leftgrid">
                <img id="placeholder-logo-left" src="../images/placeholder-logo-left.jpg" alt="placeholder Logo Left" />
            </div>
            <!-- Left end -->
            <!-- right start -->
            <div class="rightgrid">
                <img id="placeholder-logo-right" src="../images/placeholder-logo-right.jpg" alt="placeholder Logo Right" />
            </div>
            <!-- right end -->
            <!-- Body start -->
            <div class="bodygrid">
                
                <?php
                    if ($_GET['newpwd'] == "passwordupdated") {
                       echo "<h1>Password updated!<br>Keep it secret, keep it safe.</h1>";
                    }else{
                        $selector = $_GET['selector'];
                        $validator = $_GET['validator'];
                        if (empty($selector) || empty($validator)) {
                            echo "<h1>Could not validate your request!</h1>";
                        }else{
                            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                ?>
                                <div class="formcontainer">
                                    <form id="form" name="form" action="newpass.inc.php" method="post">
                                        <fieldset>
                                            <input type="hidden" name="selector" value="<?php echo $selector ?>">
                                            <input type="hidden" name="validator" value="<?php echo $validator ?>">
                                            <legend>Password</legend>
                                            <input type="password" id="password" name="pwd" placeholder="Your new password here...">
                                            <span class="password_error"></span>
                                            <legend>Repeat Password</legend>
                                            <input type="password" id="passwordrepeat" name="pwd-repeat" placeholder="Repeat your new password here...">
                                            <span class="passwordrepeat_error"></span>
                                        </fieldset>
                                        <input type="submit" name="newpass-submit" id="newpass-submit" value="SUBMIT">
                                    </form>
                                </div>
                <?php
                            }
                        }
                    }
                ?>
            </div>
            <!-- Body end -->
            <!-- Footer start -->
            <?php include 'footer.php' ?>
            <!-- Footer end -->
        </div>
    </body>
</html>
