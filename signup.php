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
    </div>
    <!-- Left end -->
    <!-- right start -->
    <div class="rightgrid">
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
                            <label>
                                <p>Full Name</p>
                                <input id="username" type="text" name="uid" placeholder="Full Name">
                            </label>
                        </fieldset>
                        <fieldset>
                            <label>
                                <p>Student Number</p>
                                <input id="username" type="text" name="studentNo" placeholder="Student Number">
                            </label>
                        </fieldset>
                        <fieldset>
                            <label>
                                <p>E-mail</p>
                                <input id="username" type="text" name="email" placeholder="E-mail">
                            </label>
                        </fieldset>
                        <fieldset>
                            <label>
                                <p>Password</p>
                                <input id="password" type="text" name="pwd"  placeholder="Password">
                            </label>
                        </fieldset>
                        <fieldset>
                            <label>
                                <p>Repeat Password</p>
                                <input id="password" type="text" name="pwd-repeat" placeholder="Repeat Password">
                            </label>
                        </fieldset>
                        <br>
                        <fieldset>
                            <input type="submit" name="signup-submit" value="Submit"></input>
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